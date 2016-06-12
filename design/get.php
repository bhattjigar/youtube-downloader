<?php 
	error_reporting(0);
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
           $url=base64_decode(trim($_POST['ourl']));
      }
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


$cmd = "youtube-dl -F --no-check-certificate ".$url;
if (ob_get_level() == 0) ob_start();
$descriptorspec = array(
   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
   2 => array("pipe", "w"),
   3 => array("pipe", "w"),
   4 => array("pipe", "w")    // stderr is a pipe that the child will write to
);
flush();
$data="";
$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
// echo "<pre>";

if (is_resource($process)) {
    while ($s = fgets($pipes[1])) {
        $data.=$s;
        ob_flush();
        flush();
    }
}
$tmp=explode("format code  extension  resolution note",$data);
$a=explode(PHP_EOL, $tmp[1]);
// print_r($a);
$rr=array();
for($i=1;$i<count($a)-1;$i++)
{
  $b=explode(" ",$a[$i]);
   $rr[$i]['d']=trim(str_replace($b[0],"",$a[$i]));

   $type=explode(" ",$rr[$i]['d']);

   $tp=explode(",",$rr[$i]['d']);

    $rr[$i]['type']=$type[0];

  $rr[$i]['s']=$tp[count($tp)-1];
  

  

   $rr[$i]['id']=$b[0];
}
arsort($rr);
$rr['total']=count($a)-1;
echo json_encode($rr);
// print_r($rr);
// $tmp=json_decode($data,true);
// $final=array();
// for($i=0;$i<count($tmp['formats']);$i++)
// {
  
//   $final[$i]['f']=$tmp['formats'][$i]['ext'];
//   $final[$i]['d']="  ".$tmp['formats'][$i]['resolution']."  ".$tmp['formats'][$i]['format_note'];

//   if(isset($tmp['formats'][$i]['tbr']))
//   {
//     $final[$i]['d']=$final[$i]['d']."  ".round(floatval($tmp['formats'][$i]['tbr']))."K";
//   }
//   if(isset($tmp['formats'][$i]['vcodec']))
//   $final[$i]['d']=$final[$i]['d'].", ".$tmp['formats'][$i]['vcodec'].",";


//   if(isset($tmp['formats'][$i]['acodec']))
//   {
//     if($tmp['formats'][$i]['acodec']=="none")
//     {
//       $final[$i]['d'].=" vidoe only";
//     }
//     else
//     {
//       $final[$i]['d'].=$tmp['formats'][$i]['acodec'];
//     }
//   }

//   if(isset($tmp['formats'][$i]['abr']))
//   $final[$i]['d']=$final[$i]['d']." @".round(floatval(($tmp['formats'][$i]['abr'])))."K";

  

  
// $final[$i]['url']=$tmp['formats'][$i]['url'];
  
  
//   $t=b($tmp['formats'][$i]['filesize']);
//   $g=explode(" ",$t);
//   $final[$i]['size']=$g[0];
//   $final[$i]['type']=$g[1];
//   $final[$i]['id']=$tmp['formats'][$i]['format_id'];
// }
// rsort($final);
// echo json_encode($final);

 ?>