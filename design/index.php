<?php
if(isset($_POST["ourl"])&&isset($_POST["hurl"])&&isset($_POST["token"])&&isset($_POST["id"])&&isset($_POST["origin"])&&isset($_POST["hash"])&&isset($_POST["base"])&&isset($_COOKIE["ourl"])&&isset($_COOKIE["hurl"])&&isset($_COOKIE["token"])&&isset($_COOKIE["id"])&&isset($_COOKIE["origin"])&&isset($_COOKIE["hash"])&&isset($_COOKIE["base"]))
{
	if(trim($_COOKIE["ourl"])==trim($_POST["ourl"])&&trim($_COOKIE["hurl"])==trim($_POST["hurl"])&&trim($_COOKIE["token"])==trim($_POST["token"])&&trim($_COOKIE["id"])==trim($_POST["id"])&&trim($_COOKIE["origin"])==trim($_POST["origin"])&&trim($_COOKIE["hash"])==trim($_POST["hash"])&&trim($_COOKIE["base"])==trim($_POST["base"]))
			
			{

				// print_r($_POST);
				if (isset($_SERVER['HTTP_COOKIE'])) 
				{
				    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				    foreach($cookies as $cookie) 
				    {
				        $parts = explode('=', $cookie);
				        $name = trim($parts[0]);
				        setcookie($name, '', time()-1000);
				        setcookie($name, '', time()-1000, '/');
				    }
				}

				include "test.php";

			}
			else
			{
				echo "fuck u";
			}
}
else
{
?>


<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>YouTube to MP4 and MP3 ,MKV in best quality Converter and Video Download - website.com</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="description" content="YouTube to MP3, MP4 ,MKV ,AVI,FLV Downloader and Converter">
		<meta property="og:title" content="YouTube to MP4 &amp; MP3 Converter and Video Download">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->



<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
<script type="text/javascript" src="js/hash.js"></script>
<!-- //js -->
<!-- radio-buttons -->
<link rel="stylesheet" href="css/sky-forms.css">
<!-- //radio-buttons -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,900,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'></head>
	
<body>
	<!-- ui-kit -->
		<div class="ui-kit">
			<div class="container">
				<h1><i class="glyphicon glyphicon-hd-video" aria-hidden="true"></i> youtube<span>downloader</span></h1>
				<div class="ui-kit-grids">
					<div class="col-md-12 ui-kit-grid-left">
						<div class="login-form">
							<form>

							<div class="button">
							<h3 class="">
							<i class="glyphicon glyphicon-hand-down"></i>Video URL to Download
							</h3>
							</div>
								<input type="text" id="url" value="" required="">
								
							
							
							<div class="ckeck-bg">
								<div class="checkbox-form">
									<div class="check-left">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> MP4</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="check-right">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> M4A</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="check-right">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> MP3</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="check-right">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> 3GP</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="check-right">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> AVI</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="check-right">
										<div class="check">
											<div class="button">
												<h4>
												<i class="glyphicon glyphicon-ok-sign"> MKV</i>
												</h4>
											</div>
										</div>
									</div>
									<div class="clearfix"> </div>
								</div>


							</div>
							</br>
							<div class="button" onclick="$get(document.getElementById('url').value)">
										<button type="button" class="btn btn-default">Download </button>
								</div>
								</form>
							
						</div>
						<div id="youtube_downloader">
						</div>
						<div class="bird-text">
							<div class="bird-text"><div class="check-left"><div class="check"><div class="button"><h4><i class="glyphicon glyphicon-ok-sign"> MP4</i></h4></div></div></div></div>
							
						</div>
						<br/>
						<form action="" method="POST" class="sky-form">
							<section>
								<div class="row" id="youtube_downloader_mp4">
									
									</div>
									
													
							</section>
						</form>
						<!-- mp4 complete -->
						<div class="bird-text">
							<div class="bird-text"><div class="check-left"><div class="check"><div class="button"><h4><i class="glyphicon glyphicon-ok-sign"> WEBM</i></h4></div></div></div></div>
							
						</div>
						<br/>
						<form action="" method="POST" class="sky-form">
							<section>
								<div class="row" id="youtube_downloader_webm">
									
									
									
								</div>						
							</section>
						</form>
						<!-- webM complete -->
						
						<!-- flv complete  -->
						
					
					
					<div class="clearfix"> </div>
				</div>
				<!-- <div class="timothy-and-icons">
					<div class="timothy-and-icons-left">
						<div class="bird-text-grid-left">
							<img src="./index_files/3.png" alt=" ">
						</div>
						<div class="bird-text-grid-right">
							<h2>timothy<a href="mailto:info@example.com">tim@example.com</a></h2>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="timothy-and-icons-right">
						<ul>
							<li><span class="glyphicon glyphicon-camera" aria-hidden="true"></span>Photos</li>
							<li><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span>Payment</li>
							<li><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>Events</li>
						</ul>
					</div>
					<div class="clearfix"> </div>
				</div> -->
				
				<div class="footer-bottom">
						<p>Copyright © 2016 YouTube Downloader. All rights reserved </p>					
				</div>
			</div>
		</div>
	<!-- //ui-kit -->

<!-- <div class="timothy-and-family-left">
						<div class="pos1">
							<img src="images/5.png" alt=" ">
						</div>
						<div class="pos2">
							<img src="images/4.png" alt=" ">
						</div>
						<div class="pos3">
							<img src="images/4.png" alt=" ">
						</div>
						<h3><span>30</span>September</h3>
						<h4><span>30</span>September</h4>
					</div> -->

</body></html>
<script type="text/javascript">

	function $get(url) {
		 go=document.getElementById("youtube_downloader");
		 go.innerHTML="loading......"
		 lo=document.getElementById("youtube_downloader_mp4");
		 
		 lu=document.getElementById("youtube_downloader_webm");
		 var tu="";
		 lu.innerHTML=""
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      
      

      var data=JSON.parse(xhttp.responseText);
     
      var t="";
      
      var mp4=[];
      var webm=[];
      var flv=[];
      var gp=[];



      for(i=data.total-1;i>1;i--)
      {
	      	if(data[i].type=="mp4")
	      	{
	      		mp4.push({'id':data[i].id,'d':data[i].d,"s":data[i].s});
	      		
	      	}
	      	if(data[i].type=="webm")
	      	{
	      		webm.push({'id':data[i].id,'d':data[i].d,"s":data[i].s});
	      	}
	      	if(data[i].type=="flv")
	      	{
	      		flv.push({'id':data[i].id,'d':data[i].d,"s":data[i].s});
	      	}
	      	if(data[i].type=="3gp")
	      	{
	      		gp.push({'id':data[i].id,'d':data[i].d,"s":data[i].s});
	      	}
	      	// if(i==data.total-1)
	      	// {
	      	// 	t+='<div class="colr"><label class="radio"><input type="radio" name="radio" checked="" id='+data[i].id+'><i></i>'+data[i].d+' <img src="./pink.png"></label></div>';
	      		 
	      	// }
	      	
	      	// else
	      	// {
	      	// 	t+='<div class="colr"><label class="radio"><input type="radio" name="radio"  id='+data[i].id+'><i></i>'+data[i].d+' <img src="./pink.png"></label></div>';
	      		 
	      	// }
      }
      console.log(mp4);
      console.log(webm)
   var tu="";
      for(i=mp4.length-1;i>=0;i--)
      {
	      	if(i==mp4.length-1)
	      	{
	      		tu+='<div class="colr"><label class="radio"><input type="radio" name="radio" checked="" id='+mp4[i].id+'><i></i>'+mp4[i].d+' <img src="./pink.png"></label></div>';
		      		 
		     }
		      	
	      	else
	      	{
	      		tu+='<div class="colr"><label class="radio"><input type="radio" name="radio"  id='+mp4[i].id+'><i></i>'+mp4[i].d+' <img src="./pink.png"></label></div>';
	      	}
      }
/////////////////////////////////////setting hash
var $={};var cool="";
$.list=["ourl","hurl","token","id","hash","base","origin"]
$.ourl=window.btoa(url);$.hurl=youtube.algo(url);$.id=id();$.token=rs(32);$.hash=id();$.base=rs(18);$.origin=window.location.hostname;
cool+='<input type="hidden" name="'+$.list[0]+'" value="'+$.ourl+'"></input>'
cook($.list[0],$.ourl);cook($.list[1],$.hurl);cook($.list[2],$.token);cook($.list[3],$.id);
cook($.list[4],$.hash);cook($.list[5],$.base);cook($.list[6],$.origin)
cool+='<input type="hidden" name="'+$.list[1]+'" value="'+$.hurl+'"></input>'
cool+='<input type="hidden" name="'+$.list[2]+'" value="'+$.token+'"></input>'
cool+='<input type="hidden" name="'+$.list[3]+'" value="'+$.id+'"></input>'
cool+='<input type="hidden" name="'+$.list[4]+'" value="'+$.hash+'"></input>'
cool+='<input type="hidden" name="'+$.list[5]+'" value="'+$.base+'"></input>'
cool+='<input type="hidden" name="'+$.list[6]+'" value="'+$.origin+'"></input>'
 go.innerHTML='<form action="" method="POST" ><div class="button"><input type="submit"  class="btn btn-default" value="Convert"/>'+cool+'</div></form>';
////////////////////////////////////


     lo.innerHTML = tu;
      tu="";
     
	 for(i=webm.length-1;i>=0;i--)
      {
	      	if(i==webm.length-1)
	      	{
	      		tu+='<div class="colr"><label class="radio"><input type="radio" name="radio" checked="" id='+webm[i].id+'><i></i>'+webm[i].d+' <img src="./pink.png"></label></div>';
		      		 
		     }
		      	
	      	else
	      	{
	      		tu+='<div class="colr"><label class="radio"><input type="radio" name="radio"  id='+webm[i].id+'><i></i>'+webm[i].d+' <img src="./pink.png"></label></div>';
	      	}
      }
      lu.innerHTML = tu;
    }
    
  };
  xhttp.open("POST", "./get.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhttp.send(ta(url));
}
</script>

<?php 
}
?>