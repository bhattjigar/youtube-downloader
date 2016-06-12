<?php
error_reporting(0);
require('./playlist/crawl.php');

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
           

      }
      $url=base64_decode(trim($_POST['ourl']));
      html(doMagic($url));
}
else
{
  echo "fuck u";
}    
  


function html($htmlinput)
{
    //echo $htmlinput;
  $array=array();
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->loadHTML($htmlinput);

    $a = $dom->getElementsByTagName('span');
   
    foreach ($a as $data) {
      if($data->getAttribute('class')=='watch-title'&&$data->getAttribute('id')=='eow-title')
      {
        $input=$data->textContent;
        $array["header"]=trim(preg_replace('!\s+!', ' ', $input));
      }
      //else if('pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ')
    }
    $a = $dom->getElementsByTagName('div');
   
    foreach ($a as $data) {
      if($data->getAttribute('id')=='watch-description')
      {
        $input=$data->textContent;
        $array["desc"]=preg_replace('!\s+!', ' ', $input);
      }
      //else if('pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ')
    }
echo json_encode($array);
}

 ?>
