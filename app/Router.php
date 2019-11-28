<?php
namespace App;


/**
 * Class Router
 * @package App
 */
class Router {
    
    /**
     * @return string
     */
    public static function changeDirectory()
		    {
		        $dirname = dirname($_SERVER['SCRIPT_NAME']);
		        $dirname = $dirname != '/' ? $dirname : null;
		        $basename = basename($_SERVER['SCRIPT_NAME']);
                $requestUrl = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
		        return $requestUrl;
		    }
    
    /**
     * @param string $url
     * @param string $callback
     * @param string $method
     * @param array $controllerArg
     *
     * @throws \ReflectionException
     */
    public static function run ($url , $callback , $method = 'get' , $controllerArg = []) {

       			 $method = explode('|', strtoupper($method));

			 if (in_array($_SERVER['REQUEST_METHOD'], $method)) {

			 		$data =  $method[0] === "GET" ? $_GET : $_POST; 

	 		        $patterns = [
		                '{url}' => '([0-9a-zA-Z]+)',
		                '{id}' => '([0-9]+)'
		            ];

		            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
                
                     $requestUrl = self::changeDirectory();
                
                     $requestUrl = explode("?",$requestUrl)[0];

			 		// or $_SERVER[PATH_INFO]

			 	 if(preg_match('@^'.$url.'$@', $requestUrl , $matches )) {

	 					if(is_callable($callback)) 
			 	 		{
			 	 			call_user_func($callback, $matches);					
			
			 	 		}
			 	 		else {
		
			 	 			   $controller = explode('@', $callback);
			 	 			   
			 	 			   $classNameArr = explode('/', $controller[0]);
                               $className = end($classNameArr);
                               
                               $className = count($classNameArr) > 1  ? str_replace('/' , '\\', $controller[0]) : $className;
                      
                   			   $controllerFile = strtolower(__NAMESPACE__). '/controller/' . $controller[0] . '.php';

						
                   			   if (file_exists($controllerFile)) {

			                        		$class = new \ReflectionClass(__NAMESPACE__. '\\controller\\'.$className);
											
			                        		$instance = $class->newInstanceArgs($controllerArg);

			                        		$function = $class->getMethod($controller[1]);

											$function->invokeArgs($instance , [ $data ] );

			                    }
			                    else {
			                    		http_response_code(500);
			                    		header('Location:/errors/500');
			                    		die();
			                    }

			 	 		}
				 }
	 	
				 		
			 }

	}
}