<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">

	   <title>HardLink Creator</title>

       <link rel="stylesheet" href="/public/css/bootstrap.css">

 	   <link rel="stylesheet" href="/public/css/fontawesome.min.css">
       <link rel="stylesheet" href="/public/css/iziToast.min.css">

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
	
					       		 <input type="text" class="form-control creator" id="path" name="path" placeholder="Paste File Path" required">
						
						 </div>
					</div>

					<div class="col-2">

						    <input type="text" name="tag" class="form-control creator kenter" id="tag" placeholder="#tag" required>
					</div>

					<div class="col-1">
	
							<button type="submit"  class=" pl-5 pr-5 btn btn-green" id="Ready">Ready</button>
				
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
			<div class="d-flex flex-wrap mt-2" id="tags">
					
				<?php if (isset($arg)){
					$arrTags = array_column($arg, "tag");
				  foreach ($arrTags as $key => $value) { ?>

					<div class="p-2">
							<a href="#" class="badge badges badge-secondary p-2">

							<?= $value ?>
							 <button type="button" data-text="<?= $value ?>" class="close" aria-label="Close">
							 <span aria-hidden="true">&times;</span>
						</button>
						</a>
					</div>  
				<?php 	} } ?>

					<div class="p-2"><a href="#" class="badge badge-warning p-2" data-start="7" data-append="12"  id="more"> <u>Get More..</u> </a></div>
			</div>
		</div>
</div>





<div class="row justify-content-end ">
	<div class="col-4 input-group input-group-sm mt-4">
			   <input type="text" class="form-control kenter" placeholder="For Search.." name="search"  aria-label="Enter Tag Name" aria-describedby="basic-addon2" x-webkit-speech>
	 	 <div class="input-group-append">
	  		  <button class="btn btn-green" id="search" type="button"><i class="fas fa-search"></i></button>
	  	</div>
	</div>
</div>

		

<div class="row  p-3">
		<div class="table-wrapper-scroll-y my-custom-scrollbart">

			 <table class="table table-bordered table-striped table-sm mb-0 text-center" id="tagTable">
		 		 <thead>
				    <tr>
				      <th scope="col-1">Open</th>
				      <th scope="col-1">Run</th>
				      <th scope="col-6">File Path</th>
				      <th scope="col-2">Type</th>
				      <th scope="col-1">Size</th>
				      <th scope="col-1">Remove</th>	
				    </tr>
		 		  </thead>

				   <tbody>
									<!-- Content -->
				  </tbody>
	    	</table>
		</div>
</div>

		<div class="fixed-bottom text-right bg-gg">
			<div class="float-left">
				<div class="notfound-social">
					<a href="https://github.com/kmrtylmz"><i class="fab fa-github"></i></a>
					<a href="https://www.linkedin.com/in/mert-y%C4%B1lmaz-819629135/"><i class="fab fa-linkedin"></i></a>
					<a href="#Donate"><i class="fas fa-hand-holding-usd"></i></a>
				</div>
			</div>
		<div class="float-right">Copyright <i class="far fa-copyright"></i> <?=date('Y') ?></div>
	
	</div>

</div>



<script src="/public/js/jquery-3.4.1.min.js"></script>
<script src="/public/js/iziToast.min.js" type="text/javascript"></script>
		
		<script>
		var counter = 0;
		 var halfcheck = true; var quartercheck = true; var halfcheckreduce = true; var quartercheckreduce = true;
		$("input[type='text'].creator").on("change" , function(e){

			var name = e.target.name;
			var $proc = $(".progress");
			var $procbar = $(".progress-bar");
			var currentWidth = ($proc.width()*0.25);
			var check = $("input[name=" + e.target.name + "").val().length;
			

			if( check != 0 ){
				if(name === "path" && halfcheck) {
				$procbar.animate( { width : "+="+(currentWidth*2)+"px" } , 200 );
					halfcheck = false;
				}
				if(name === "tag" && quartercheck) {
				$procbar.animate( { width : "+="+currentWidth+"px" } , 200 );
				quartercheck = false;
				}
				
			}
			else if(check > 0 && $procbar.width() > 0) {

			}
			
			else {
					if(name === "path" && halfcheckreduce)  {
					$procbar.animate( { width : "-="+(currentWidth*2)+"px" } , 200 );
					halfcheckreduce = false;
					halfcheck = true;
					}
					if(name === "tag" && quartercheckreduce){
						$procbar.animate( { width : "-="+currentWidth+"px" } , 200 );
					quartercheckreduce = false;
					quartercheck = true;
					}
					
				}	           
			});
	
      
        </script>	

        <script>
        		 $(".kenter").keypress(function(event) {
					    var keycode = event.keyCode || event.which;
					    if(keycode == '13') {
					    	if(event.target.id !== "Ready")
					           $("#search").click();
					          else {
							   $("#Ready").click();
					          }
					    }
					    
					});
        </script>

        <script>
        	$( "#search" ).on("click", function(event) {
				var search = $("input[name='search']").val();
        		$.post('/search' , { search : search } ).done(function(data) {
        				if(data.trim()!== '' && data !== null && data !== "undefined" ) {	
    					var dataJsn = $.parseJSON(data);
    					 var content = '';
    					for (var i = 0; i < dataJsn.length; i++) {
						content +='<tr>'+
					 	'<td><button type="button" class="btn btn-light btn-sm btn-block open" data-url="file='+ dataJsn[i].filename + '&folder=ok">' +
					 	'<img src="/public/images/folder.ico" alt="ad"/></button></td>' + 
					 	'<td><button type="button" class="btn btn-light btn-block btn-sm open" data-url="file='+ dataJsn[i].filename + '">' +
					 	'<img src="/public/images/run.png" alt="ad"/></button></td>' + 
					 	'<td>'+ dataJsn[i].filename +'</td>'+
						'<td>'+ dataJsn[i].filetype +'</td>'+
						'<td>'+ dataJsn[i].filesize +'</td>'+
					 	'<td><button type="button" class="btn btn-light btn-sm btn-block delete" data-url="f_id='+ dataJsn[i].f_id + '">' +
					 	'<img src="/public/images/delete.ico" alt="ad"/></button></td>' + 
					    '</tr>';
						}
						 $("tbody").html(content); 
						}
						else {
							$("tbody").html('<tr><td colspan="6" style="padding:2rem!important;">Not Created File on This Tag ! </td></tr>');
						}
					console.log(data);
        		});

			});
        </script>

        <script> 

        		var conflict = false;

				$('#tagTable').on("click", ".open" ,  function(){
						var url = $(this).data("url");

						$.get('/open' , {  data : url }).done(function(data){
									//console.log(data);
					});
				});

				$('#more').on("click", function(){
						var append = $(this).data("append");
						var start = $(this).data("start");
						var qsa = { "start" : start , "append" : append };
						$.post('/getmore' , {  data : JSON.stringify(qsa) }).done(function(data){
								if(data.trim()!== '' && data !== null && data !== "undefined" && data.trim()!="[]") {
									var tags = $.parseJSON(data);
									var counter = append+5;
									$("#more").data("append" ,counter);
									$("#more").data("start", append);
									
									for (var i = 0; i < tags.length; i++) {
							
							$("#tags div.p-2:last").before('<div class="p-2">'+
								'<a href="#" class="badge badges badge-secondary p-2">'+  tags[i].tag + 
								'<button type="button" data-text="'+ tags[i].tag +'" class="close" aria-label="Close">'+
								 '<span aria-hidden="true">&times;</span>'+
								'</button>'+
								'</a>'+
								'</div>');

									}
								}
								else {
									$("#more").parent().remove();
								}
							//	console.log(data);
					});
				});
				$('#tagTable').on("click", ".delete" ,  function(){
					var $th =  $(this);
					var url = $(this).data("url");
					iziToast.show({
					    theme: 'dark',
					    icon: 'far fa-question-circle',
					    title: 'Information',
					    overlay : true,
					    closeOnEscape: true,
					    message: 'File tag will be deleted. Sure?',
					    position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
					    progressBarColor: 'rgb(0, 255, 184)',
					    buttons: [
					        ['<button>Yes</button>', function (instance, toast) {
					           		 instance.hide({ transitionOut: 'fadeOutUp' } , toast);
					           			$th.parent().parent().remove();
										$.get('/delete' , {  data : url }).done(function(data){
										  //console.log(data);
					           				});
					        
					        }, true], // true to focus
					        ['<button>No</button>', function (instance, toast) {
					            instance.hide({
					                transitionOut: 'fadeOutUp'
					        } , toast);
					          
					    	}]
					    	]					    		
				});
				});

				 $("#tags").on("click", 'button.close', function(){
				 	var $th =  $(this);
				 	var tag = $th.data("text");
				 	conflict = true;
				 iziToast.show({
					    theme: 'dark',
					    icon: 'far fa-question-circle',
					    title: 'Information',
					    overlay : true,
					    closeOnEscape: true,
					    message: 'Selected tag will be deleted. Sure?',
					    position: 'center', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
					    progressBarColor: 'rgb(0, 255, 184)',
					    buttons: [
					        ['<button>Yes</button>', function (instance, toast) {
					           		 instance.hide({ transitionOut: 'fadeOutUp' } , toast);
					           			$th.parent().parent().remove();
							 		$.post('/delete/tag', { data : tag }).done(function(data){
							 					console.log(data);
							 		});
					           	
					        }, true], // true to focus
					        ['<button>No</button>', function (instance, toast) {
					            instance.hide({
					                transitionOut: 'fadeOutUp'
					        } , toast);
					          
					    	}]
					    	],
					    	 onClosing: function(instance, toast, closedBy){
							        conflict = false;
							    }
					    	
					});
				 		
				 });

				 $("#tags").on("click", "a.badges" , function(){
				 	if(!conflict) {
				 	var text =$(this).text().match(/\w+/gi);
				 		$('input[name="search"]').val(text);
				 		$('#search').click();
				 		console.log("ok");
				 	}
				 	return;
				 });
        </script>

        <?php 
        	$messages = [ 
        				  'completed' => ['OK', 'Successfully', 'success'] ,
        				  'filefail'  => ['Error', 'File Not Created Tag', 'error'],
        				  'dbfail' => ['Error', 'Database Error' , 'warning'],
        				  'taggedError' => ['Message' , 'Tag on File Exists' , 'info'],
        				  'typefail' => ['Message' , 'File Type Inappropriate' , 'info']
        				];
				
        	if(!empty($_SESSION)) {

        				$content = "<script>";

        				foreach ($_SESSION as $key => $value) {

        						if(array_key_exists($key, $messages))
        						 {
        								
        						 	$content .= 'iziToast.'.$messages[$key][2].'({
												    title: "'.$messages[$key][0].'",
												    position: "topRight",
												    message: "'.$messages[$key][1].'",
												 });';

        						 		unset($_SESSION[$key]);
        					     }

        				}

        				$content.= "</script>";

        				echo $content;

        	}	
         	

         ?>
</body>
</html>


