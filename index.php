<?php 
require "vendor/autoload.php";

use App\Router;

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


Router::run('/', "HardLinkController@show");

Router::run('/create' , 'HardLinkController@create', 'post');

Router::run('/search' , 'HardLinkController@search', 'post');

Router::run('/open' , 'HardLinkController@open' , 'get');

Router::run('/delete' , 'HardLinkController@delete' , 'get');

Router::run('/delete/tag' , 'HardLinkController@tagDelete' , 'post');

Router::run('/getmore' , 'HardLinkController@getMore'  , 'post');

Router::run('/errors/500', function($name) {
	
		$error = explode("/", $name[0]);

		$error = end($error);

		require "app/views/".$error.".php";

});

/*	

	For Linux : 

	//shell_exec("ln" .$path. "{$_ENV['HOMEDRIVE']}\keywords\\".$keyword); // hardlink olusturur.

	/* readlink -f "abc.txt"  // olusan hardlinkin pathi alınır.
	/c/abc.txt

	ls -i /c/abc.txt       // pathine göre inode numarası listelenir.
	24488322973942798 /c/abc.txt  // gelen deger parse


	find ./ -inum 2533274790487458 | head -n2  // dosyalarda inode göre aranır.
	./abc.txt
	./bb/mert.txt
	}
*/
 		
?>
 






