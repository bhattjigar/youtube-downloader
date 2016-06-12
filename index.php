<?php 
	error_reporting(0);
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


$cmd = "./index.sh";
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
$tmp=json_decode($data,true);
$final=array();
for($i=0;$i<count($tmp['formats']);$i++)
{
  // $final[$i]['format_id']=$tmp['formats'][$i]['format_id'];
  // $final[$i]['ext']=$tmp['formats'][$i]['ext'];
  // $final[$i]['resolution']=$tmp['formats'][$i]['resolution'];
  // $final[$i]['format_note']=$tmp['formats'][$i]['format_note'];
  // $final[$i]['tbr']=$tmp['formats'][$i]['tbr'];
  // $final[$i]['fps']=$tmp['formats'][$i]['fps'];
  // $final[$i]['vcodec']=$tmp['formats'][$i]['vcodec'];
  
  

  
  $final[$i]['f']=$tmp['formats'][$i]['ext'];
  $final[$i]['d']=$tmp['formats'][$i]['ext']." ".$tmp['formats'][$i]['resolution']." ".$tmp['formats'][$i]['format_note'];

  if(isset($tmp['formats'][$i]['tbr']))
  {
    $final[$i]['d']=$final[$i]['d']." ".round(floatval($tmp['formats'][$i]['tbr']))."K";
  }
  if(isset($tmp['formats'][$i]['vcodec']))
  $final[$i]['d']=$final[$i]['d'].",".$tmp['formats'][$i]['vcodec'].",";


  if(isset($tmp['formats'][$i]['acodec']))
  {
    if($tmp['formats'][$i]['acodec']=="none")
    {
      $final[$i]['d'].="vidoe only";
    }
    else
    {
      $final[$i]['d'].=$tmp['formats'][$i]['acodec'];
    }
  }

  if(isset($tmp['formats'][$i]['abr']))
  $final[$i]['d']=$final[$i]['d']." @".round(floatval(($tmp['formats'][$i]['abr'])))."K";

  

  
$final[$i]['url']=$tmp['formats'][$i]['url'];
  
  
  $t=b($tmp['formats'][$i]['filesize']);
  $g=explode(" ",$t);
  $final[$i]['size']=$g[0];
  $final[$i]['type']=$g[1];
  $final[$i]['id']=$tmp['formats'][$i]['format_id'];
}
rsort($final);
echo json_encode($final);
// print_r($tmp);
// echo "</pre>";
 ?>