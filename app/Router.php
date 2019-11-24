<?php 
namespace App;

class Router { 

		 public static function changeDirectory()
		    {
		        $dirname = dirname($_SERVER['SCRIPT_NAME']);
		        $dirname = $dirname != '/' ? $dirname : null;
		        $basename = basename($_SERVER['SCRIPT_NAME']);
		        $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
		        return $request_uri;
		    }

		public static function run ($url , $callback , $method = 'get') {

       			 $method = explode('|', strtoupper($method));

			 if (in_array($_SERVER['REQUEST_METHOD'], $method)) {

			 		$data =  $method[0] === "GET" ? $_GET : $_POST; 

	 		        $patterns = [
		                '{url}' => '([0-9a-zA-Z]+)',
		                '{id}' => '([0-9]+)'
		            ];

		            $url = str_replace(array_keys($patterns), array_values($patterns), $url);

			 		$request_uri = self::changeDirectory();

			 		$request_uri = explode("?",$request_uri)[0];

			 		// or $_SERVER[PATH_INFO]

			 	 if(preg_match('@^'.$url.'$@', $request_uri , $matches )) {
					//  unset($matches[0]);
			

	 					if(is_callable($callback)) 
			 	 		{
			 	 			call_user_func($callback, $matches);					
			
			 	 		}
			 	 		else {
		
			 	 			   $controller = explode('@', $callback);
			 	 			   $className = explode('/', $controller[0]);
                   			   $className = end($className);
                   			   $controllerFile = strtolower(__NAMESPACE__). '/controller/' . $controller[0] . '.php';

						
                   			   if (file_exists($controllerFile)) {

			                        		$class = new \ReflectionClass(__NAMESPACE__. '\\controller\\'.$controller[0]);
											$args  = [];		// Object Constructor
			                        		$instance = $class->newInstanceArgs($args);

			                        		$function = $class->getMethod($controller[1]);

											$function->invokeArgs($instance , [ $data ] );

			                    }
			                    else {
			                    		http_response_code(500);
			                    		die();
			                    }

			 	 		}
				 }
	 	
				 		
			 }

	}
}