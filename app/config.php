<?php 
namespace App;

/**
 * Trait config
 * @package App
 */
 	trait config  {
 	    use helper;
    
 				protected $sqlitePath = 'database/taglog.db';
 				protected $folder = "\\tags";
 				
    }
    
    trait helper {
 	    
        /**
         * @return string
         */
 				public function getFolder() {
 					return "{$_ENV['HOMEDRIVE']}\\tags";
 				}
       
        /**
         * @return string
         */
 				public function homeDrive() {
 					return "{$_ENV['HOMEDRIVE']}";
 				}

 			    public function getExplorerExe(){
 				    return  $_ENV["SYSTEMROOT"] . '\\explorer.exe';
                }
        /**
         * @param null $session
         * @param string $location
         */
                public function  redirect( $session = null, $location = "/" ) {
                    header("Location:{$location}");
                    if(!is_null($session))
                    $_SESSION[$session] = 1;
                }
    }