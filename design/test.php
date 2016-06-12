<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<title>Youtube Download Manager</title>

<link href="./css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="./css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<!-- <script src="./js/jquery-1.11.1.min.js"></script> -->

<!-- //js -->
<!-- radio-buttons -->
<link rel="stylesheet" href="./css/sky-forms.css">
<script type="text/javascript" src="js/hash.js"></script>
<!-- //radio-buttons -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,900,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<style type="text/css">
html, body {
    font-size: 100%;
     background: #fff; 
    font-family: 'Open Sans', sans-serif;
}
.men-icon2 {
    background: #fff;
    margin: 0 0 4em;
    /* box-shadow: 1px 4px 13px #D08080; */
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
.per{
  width: 0;
    height: 30px;
    background-color: black;
    -webkit-transition-property: width; /* Safari */
    -webkit-transition-duration: .5s; /* Safari */
    transition-property: width;
    transition-duration: .5s;
    color: #fff;

}
</style>
</head>

<div class="men-icon2">
              <div class="menu-nav2">
                <span class="menu_1_left1"><i class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></i></span> 
                  
              </div>
              <p>Download Manager</p>
              <div class="clearfix"> </div>
              <!-- 



               -->
                  <div class="timothy-and-family-right-timothy">
               

              <div class="bird-text-grid-left ind">
                  <img  id="currentimage"  class="img-thumbnail" alt="Loading ....." width="320" height="180">
                  <img    src="339.gif" width="32" height="32">
                   <div class="bird-text-grid-left ind1"><h2 id="upper">converting.....</h2></div>
              </div>
              <div class="bird-text-grid-right ind1">
                <h2 id="currenttitle">Downloading.......</h2>
                <p id="currentdesc">
                  converting .............
                </p>
              </div>

              <div class="clearfix"> </div>

  
            </div>
            <div class="progress">
            <div id="currentprogress" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
            aria-valuemin="0" aria-valuemax="100" style="width:100%">
              
            </div>
          </div>
               <!-- 


                -->
                <ul id="downloaders" class="menu_1_left_nav1" style="display: block;">
                </ul>
            </div>
<body >
<script>

function formatBytes(bytes,decimals) {
   if(bytes == 0) return '0 Byte';
   var k = 1000;
   var dm = decimals + 1 || 3;
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
   var i = Math.floor(Math.log(bytes) / Math.log(k));
   //+ ' ' + sizes[i]
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm));
}

function get_filesize(url, callback)
 {

  url=url+".mp4";
    var xhr = new XMLHttpRequest();
    
    
    xhr.onreadystatechange = function()
     {
        if (this.readyState == this.DONE) 
        {
            // callback(parseInt(xhr.getResponseHeader("Content-Length")));
            callback(parseInt(xhr.responseText));
        }
    };
    xhr.open("POST", "info.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(ta(url));
}

///////////////////////////,"youtube.mp4","old4.mp4"




var $={};
var bar=[]
function fdownload(fo)
{
  x[fo].style.webkitFilter = "blur(0px)";
  
  //////////////////////////////////////////
  
  ////////////////////////////////////////
get_filesize(filelist[fo], function(size) {

    console.log("The size of file is: " + size + " bytes. total MB "+formatBytes(size));
    if(size<=(1024*1024))
    {
      $.chunk=size;

    }
    else
    {
          get_filesize.size=size;
          var yy=formatBytes(size);
          console.log("zero is shown"+yy);  
        
        
        
        if(yy<100&&yy>1)
        {
          $.chunk=1024*512;
        }
        else if(yy<=400&&yy>=100)
        {
          $.chunk=1024*1024*2;
        }
        else if(yy>=401&&yy<=4096)
        {
          $.chunk=1024*1024*5;
        }
    }
    console.log("size/chunks"+size+"/"+$.chunk);
    get_filesize.chunks=Math.floor(size/$.chunk);
    if(get_filesize.chunks==1)
    {
      get_filesize.total=get_filesize.size;
      get_filesize.chunks=0;
      console.log(get_filesize.total)

    }
    else
    {
      console.log("get_filesize.total get_filesize.chunks "+get_filesize.chunks);
      get_filesize.send=get_filesize.chunks*$.chunk;

      console.log("get_filesize.send get_filesize.chunks"+get_filesize.send);
      get_filesize.remain=get_filesize.size-get_filesize.send;
      console.log("remaining bytes"+get_filesize.remain)
      get_filesize.total=get_filesize.send+get_filesize.remain;
      console.log(get_filesize.total)
    }

////////////////////////////////////////////
var worker = new Worker('download.js');
  worker.onmessage = function(e) {
    console.log(e.data);
    if(e.data.status)
    {
       if(e.data.status=="complete")
       {
        z[fo].style.width=100+"%";
        // y[fo].download=e.data.filename;
        y[fo].download=title.innerHTML+".mp4";
        y[fo].href=e.data.url;
        y[fo].click();
        y[fo].innerHTML='<i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>'+title.innerHTML+".mp4";
      //   var b=document.createElement("div");
      // b.id="result"+fo;
      // b.innerHTML="<a  download='"+e.data.filename+"' href='"+e.data.url+"'> Download</a>";     
      // // document.getElementById("final").appendChild(b);
      // a.innerHTML='<h4><span>100%  <i class="glyphicon glyphicon-ok-sign"> '+e.data.filename+'</i></span></h4>'
      fo++;
      alert(fo+"=="+filelist.length);
      $.enable=1;
      console.log("waitiiing changing " +$.enable)
      if(fo!=filelist.length)
      {
        
        
          $.finalcall(fo);
      }
      
      
       }
    }
    else
    {
      if(e.data.speed)
      {

      if(parseInt(e.data.size)>=100)
      {
        t=100
      }
      else
      {
        t=parseInt(e.data.size);
      }
      // a.innerHTML="<h3><span>"+t+"%</span></h3>";
      z[fo].style.width=t+"%";
      y[fo].innerHTML='<i class="glyphicon glyphicon-hdd" aria-hidden="true"></i>speed     '+parseFloat(e.data.speed)+' MB/s                                                         Downloading....   '+t;
      }
        
    }
    
  };
  // alert("request for "+filelist[fo]);
  // alert("request no "+fo);
  
  worker.postMessage({fileName:filelist[fo]+".mp4",
                      url: filelist[fo]+".mp4",type: 'video/mp4',chunks:get_filesize.chunks,size:$.chunk,send:get_filesize.send,total:get_filesize.total,remain:get_filesize.remain,fname:filelist[fo]+".mp4",pc:fo});
////////////////////////////////////////////


 // for()

});

///////get file size and cout get_filesize.chunks

}



  
//type: 'image/png'

  

function d()
{
  window.requestFileSystem = window.webkitRequestFileSystem;
  try
   {
    var fs = window.requestFileSystem(TEMPORARY, 1024 * 1024, function(fs) {
  fs.root.getFile('old.mp4', {create: false}, function(fileEntry) {

    fileEntry.remove(function() {
      console.log('File removed.');
    });

  });
  });
     
    }

   catch (e) 
  {
    console.log(e);
  }

  

}

////////////////////////origin path is here
<?php 
$url=array();
$url[0]=base64_decode(trim($_POST["ourl"]));
$url[1]="https://www.youtube.com/watch?v=QzJfW1sij9k";
?>
 // var filelist=["old"];
var filelist=[];
var filedecode=[];
var x=[]
var y=[]
var z=[]
filedecode.push("<?php echo $url[0];?>");
filedecode.push("<?php echo $url[1];?>");
filelist.push(youtube.algo("<?php echo $url[0];?>"));
filelist.push(youtube.algo("<?php echo $url[1];?>"));
for(o=0;o<filelist.length;o++)
{
  x[o]=document.createElement("li");
  x[o].style.webkitFilter = "blur(5px)";
  document.getElementById("downloaders").appendChild(x[o]);
  y[o]=document.createElement("a");
  x[o].appendChild(y[o]);
  y[o].innerHTML='<i class="glyphicon glyphicon-hdd" aria-hidden="true"></i>Downloading.... ';
  z[o]=document.createElement("div");
  z[o].id="per"+o;
  z[o].className="dm";
  x[o].appendChild(z[o]);
}

////////////////////////////////////

$.ajax=function(fo,url,f,callback,download)
 {
   x[fo].style.webkitFilter = "blur(0px)";
  var tmp="";var fuck="";
  var xhr= new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState > 2 && xhr.status == 200) 
    {

      callback(xhr,fo);
    }
    if (xhr.readyState == 4 && xhr.status == 200) 
    {

       if(download==1)
       {
        fdownload(fo);
        
       }
    }
    
  };
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xhr.send(ta(f));
  
}
/************************************/
var fo=0;
var tmp=0;



var title=document.getElementById("currenttitle");
var desc=document.getElementById("currentdesc");
var image=document.getElementById("currentimage");
var progress=document.getElementById("currentprogress");
var upper=document.getElementById("upper");

$.wait=function()
{
  console.log("waitiiing " +$.enable)
  setTimeout($.wait, 50 );
}
$.enable=1;

$.finalcall=function(fo)
{

        $.ajax(fo,'gettitle.php',filedecode[fo],function(xhr,fo){
            
            url=filedecode[fo];
            f=JSON.parse(xhr.responseText);
            title.innerHTML=f['header'];
            desc.innerHTML=f['desc'];
            tt=url.split("?v=");
            image.src="http://i.ytimg.com/vi/"+tt[1]+"/mqdefault.jpg";
        },0);

        $.ajax(fo,'playlist.php',filedecode[fo],function(xhr,fo){
            console.log(xhr.responseText);
            fuck=xhr.responseText;
            fuck=fuck.replace(tmp,"")
            var abc=fuck.split("%");
            
            
            z[fo].style.width=parseFloat(abc[0])+"%";
            progress.style.width=parseFloat(abc[0])+"%";
            if(parseFloat(abc[0]))
            upper.innerHTML="converting.....</br>"+parseFloat(abc[0])+"%";
            y[fo].innerHTML='<i class="glyphicon glyphicon-hdd" aria-hidden="true"></i><b>'+fuck+"</b>";
            tmp=xhr.responseText;
        },1);
}

$.finalcall(fo);
// fdownload(fo);


</script>

</body>

</html>