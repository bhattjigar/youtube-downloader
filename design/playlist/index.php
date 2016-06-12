<?php
echo 'res(';
require('crawl.php');
function dynamic($htmlinput)
{
  $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->loadHTML($htmlinput);

    $a = $dom->getElementsByTagName('a');
    $i=0;$t=array();
    foreach ($a as $data) {
      if($data->getAttribute('class')=='yt-uix-sessionlink  spf-link  playlist-video clearfix        spf-link ')
      {
        if($data->getAttribute('href')!='')
        {
        $r=explode('&',$data->getAttribute('href'));
        $t['u'][$i]=trim($r[0]);
        $i++;
        }
      }
    }
echo json_encode($t,true);

}
function html($htmlinput)
{
    //echo $htmlinput;
    $dom = new DOMDocument();
    $dom->preserveWhiteSpace = false;
    $dom->loadHTML($htmlinput);

    $a = $dom->getElementsByTagName('a');
    $i=0;$t=array();
    foreach ($a as $data) {
      if($data->getAttribute('class')=='yt-uix-sessionlink')
      {
        if($data->getAttribute('href')!='')
        {
        $r=explode('&',$data->getAttribute('href'));
        $t['u'][$i]=trim($r[0]);
        $i++;
        }
      }
      //else if('pl-video-title-link yt-uix-tile-link yt-uix-sessionlink  spf-link ')
    }
echo json_encode($t,true);
}
if(isset($_GET["q"])&&trim($_GET["q"])!="")
{
  
//$url="https://www.youtube.com/playlist?list=".trim($_GET["q"]);
  $url=trim($_GET["q"]);
  $temp=explode('?list=',$url);
  if($temp[1]=='')
  {
    $url2=explode('&list=',$url);
    
    if($url2[1]=='')
    {
      if(isset($_GET["list"])&&trim($_GET["list"])!="")
      {
        $list=trim($_GET["list"]);
        
        dynamic(doMagic($url.'&list='.$list));
      }
      else
      {
        $furl=$url;
        $goo=doMagic($furl);
        html($goo);
      }
      
    }
      
    
  }
  else
  {
    
    $furl=$url;
    $goo=doMagic($furl);
    html($goo);
  }
  


}
echo ');';
 ?>
