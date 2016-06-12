<?php 
	// error_reporting(0);
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
      $encodeurl=md5($url).".mp4";
}
    
  
  else
  {
    die("fuck u");
  }
// echo exec("youtube-dl -F --no-check-certificate  'https://www.youtube.com/watch?v=cWRYYZjCMgY'  2>&1");
function b($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

$one="18";
// $ff="youtube-dl  -f ".$one." --newline --output ".$encodeurl." --no-check-certificate ".$url;
$cmd = "./index.sh ".$one." ".$encodeurl." ".$url;
// $cmd=$ff;
// echo $cmd;
if (ob_get_level() == 0) ob_start();
$descriptorspec = array(
   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
   2 => array("pipe", "w"),
   3 => array("pipe", "w"),
   4 => array("pipe", "w")    // stderr is a pipe that the child will write to
);
// flush();
$data="";
$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
// echo "<pre>";
$fuck="";
if (is_resource($process)) {
    while ($s = fgets($pipes[1]))
     {
        // echo $s;
        
        $s=str_replace($fuck,"",$s);
        $tmp=explode(":", $s);
         if (strpos($tmp[0], '[download]') !== false)
          {
            $rr=explode("[download]",$tmp[0]);
            echo $rr[1].":".$tmp[1];
          }
          else
          {
            echo $tmp[1];
          }
          $fuck=$s;
        ob_flush();
        flush();
      }
      
      
      
}


 ?>