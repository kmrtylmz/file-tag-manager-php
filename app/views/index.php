<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<title>HardLink Creator</title>
       <link rel="stylesheet" href="/public/css/bootstrap.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<link rel="stylesheet" href="/public/css/style.css">

<body>
	<div class="container-fluid">
	<div class="row">
			<form action="/create" class="mt-4"  method="POST">
				 <div class="form-row pl-3">
					<div class="custom-file col-9">
							      <div class="input-group">
							        <div class="input-group-prepend">
							          <span class="input-group-text">/</span>
							        </div>
							        <input type="text" class="form-control" id="path" name="path" placeholder="Paste File Path" required>
							      </div>
					</div>
					<div class="col-2">
						    <input type="text" name="tag" class="form-control" id="tag" placeholder="#tag" required>
					</div>

					<div class="col-1 ">
	
				<button type="submit"  class=" pl-5 pr-5 btn btn-green">Ready</button>
				
					</div>	
				</div>	
		</form>
		</div>



		<div class="row">
			<div class="col">
				<div class="progress mt-4">
				  <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
				  </div>
				</div>
			</div>
		</div>
		
			<div class="row pl-2 pt-4">
				<p class="text-secondary"><u> Your Tags :</u></p>
	<div class="table-wrapper-scroll-y my-custom-scrollbar" style="border:1px solid #ccc;">
				<div class="d-flex flex-wrap mt-2">
						
						<?php if (isset($arg))
						//print_r($arg);
							$arrTags = array_column($arg, "tag");
						 { foreach ($arrTags as $key => $value) { ?>

									<div class="p-2">
  									<a href="#" class="badge badge-secondary p-2">

  									<?= $value ?>
  									 <button type="button" class="close" aria-label="Close">
	 								 <span aria-hidden="true">&times;</span>
									</button>
									</a>
								</div>  
						<?php 	} } ?>
						
						
  						


					<div class="p-2"><a href="#" class="badge badge-warning p-2 "> <u>Get More..</u> </a></div>
</div>
			</div>


		</div>





		<div class="row justify-content-end ">
			<div class="col-4 input-group input-group-sm mt-4">
			   <input type="text" class="form-control" placeholder="For Search.." name="search"  aria-label="Enter Tag Name" aria-describedby="basic-addon2" x-webkit-speech>
			  <div class="input-group-append">
			    <button class="btn btn-green" id="search" type="button"><i class="fas fa-search"></i></button>
			  </div>
			</div>
		</div>

		

<div class="row  p-3 ">
	<div class="table-wrapper-scroll-y my-custom-scrollbart">

	 <table class="table table-bordered table-striped table-sm mb-0">
  <thead>
    <tr>
      <th scope="col-1">Open </th>
      <th scope="col-7">File Path</th>
      <th scope="col-2">Type</th>
      <th scope="col-1">Size</th>
      <th scope="col-1">Delete</th>
    </tr>
  </thead>
  <tbody>


  <tr>
 	<td><img src="/public/images/filem.ico" alt="ad"/></td>
 	<td>C:\xampp\htdocs\phpdesktop-chrome-57.0-rc-php-7.1.3</td>
	<td>Database Base File</td>
	<td>12334</td>
 	<td><img src="/public/images/delete.ico" title="Remove Group Tag" alt=""></td>
 </tr>
 <tr>
 	<td><img src="/public/images/filem.ico" alt=""></td>
 	<td>C:\xampp\htdocs\phpdesktop-chrome-57.0-rc-php-7.1.3</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="/public/images/delete.ico" alt=""></td>

 </tr>
  <tr>
 	<td><img src="/public/images/filem.ico" alt=""></td>
 	<td>C:\Riot Games\Riot Client\RiotClientServices.exe</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="/public/images/delete.ico" alt=""></td>

 </tr>
   <tr>
 	<td><img src="/public/images/filem.ico" alt=""></td>
 	<td>C:\Riot Games\Riot Client\RiotClientServices.exe</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="/public/images/delete.ico" alt=""></td>

 </tr>
  <tr>
 	<td><img src="/public/images/filem.ico" alt=""></td>
 	<td>C:\Riot Games\Riot Client\RiotClientServices.exe</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="/public/images/delete.ico" alt=""></td>

 </tr>  <tr>
 	<td><img src="/public/images/filem.ico" alt=""></td>
 	<td>C:\Riot Games\Riot Client\RiotClientServices.exe</td>
 	<td>2</td>
 	<td>3</td>
 	<td><img src="/public/images/delete.ico" alt=""></td>

 </tr>
  </tbody>
</table>
</div>
</div>

<div class="fixed-bottom text-right bg-gg">
	<div class="float-left"><div class="notfound-social">
				<a href="https://github.com/kmrtylmz"><i class="fab fa-github"></i></a>
				<a href="https://www.linkedin.com/in/mert-y%C4%B1lmaz-819629135/"><i class="fab fa-linkedin"></i></a>
				<a href="#Donate"><i class="fas fa-hand-holding-usd"></i></a>
			</div></div>
	<div class="float-right">Copyright <i class="far fa-copyright"></i> <?=date('Y') ?></div>
	
</div>

</div>



<script src="/public/js/jquery-3.4.1.min.js"></script>

		<script>


			$("input[type='text']").on("change" , function(e){
				$(".progress-bar").width("50%");               
			});
	
      
        </script>	

        <script>
        	$( "#search" ).on("click", function(event) {
				var search = $("input[name='search']").val();
        		$.post('/search' , { search : search } ).done(function(data) {

        					//var dat = $.parseJSON(data);

        					console.log(data)
        					//$("tbody").append()
        		});

			});
        </script>

        <?php 

        	if(isset($_GET['success'])) {
        		echo "<script> alert('Created ! Perfect '); </script>";
        	}
         	if(isset($_GET['fail'])) {
         		echo "<script> alert('Not Create Tag.');</script>";
         	}
         	   	if(isset($_GET['wpath'])) {
         		echo "<script> alert('Wrong Path');</script>";
         	}
         ?>
</body>
</html>


