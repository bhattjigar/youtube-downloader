<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<title>Youtube Download Manager</title>
<link href="./design/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="./design/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<!-- <script src="./design/js/jquery-1.11.1.min.js"></script> -->

<!-- //js -->
<!-- radio-buttons -->
<link rel="stylesheet" href="./design/css/sky-forms.css">
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
                  <script>
                    $( "span.menu_1_left1" ).click(function() {
                      $( "ul.menu_1_left_nav1" ).slideToggle( "slow", function() {
                      // Animation complete.
                      });
                    });
                  </script>
              </div>
              <p>Download Manager</p>
              <div class="clearfix"> </div>
                <ul id="downloaders" class="menu_1_left_nav1" style="display: block;">
                  <!-- <li><a href="#"><i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>My Profile</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>Messages<span>10</span></a></li> 
                  <li><a href="#"><i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>My Photos</a></li>
                  <li><a href="#"><i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>My Videos</a></li> 
                  <li><a href="#"><i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>Settings</a></li>  -->
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

function get_filesize(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open("get", "./info.php?file="+url, true); // Notice "HEAD" instead of "GET",
                                 //  to get only the header
    xhr.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            // callback(parseInt(xhr.getResponseHeader("Content-Length")));
            callback(parseInt(xhr.responseText));
        }
    };
    xhr.send();
}

///////////////////////////,"youtube.mp4","old4.mp4"
var filelist=["old.mp4","old2.mp4"];
var x=[]
var y=[]
var z=[]
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


$={};
var bar=[]
function fdownload(fo)
{
  x[fo].style.webkitFilter = "blur(0px)";
  
  //////////////////////////////////////////
  
  ////////////////////////////////////////
get_filesize(filelist[fo], function(size) {
    console.log("The size of file is: " + size + " bytes. total MB "+formatBytes(size));
    
    get_filesize.size=size;
    var yy=formatBytes(size);
    if(yy<2&&yy>0)
    {
      $.chunk=yy;
    }
    else if(yy<200&&yy>2)
    {
      $.chunk=1024*512;
    }
    else if(yy<400&&yy>200)
    {
      $.chunk=1024*1024*2;
    }
    else if(yy>401&&yy<4096)
    {
      $.chunk=1024*1024*5;
    }

    console.log("size/chunks"+size+"/"+$.chunk);
    get_filesize.chunks=Math.floor(size/$.chunk);
    if(get_filesize.chunks==0)
    {
      get_filesize.total=get_filesize.size;
      get_filesize.chunks=1;
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
        y[fo].download=e.data.filename;
        y[fo].href=e.data.url;
        // y[fo].click();
        y[fo].innerHTML='<i class="glyphicon glyphicon-ok-sign" aria-hidden="true"></i>'+e.data.filename;
      //   var b=document.createElement("div");
      // b.id="result"+fo;
      // b.innerHTML="<a  download='"+e.data.filename+"' href='"+e.data.url+"'> Download</a>";     
      // // document.getElementById("final").appendChild(b);
      // a.innerHTML='<h4><span>100%  <i class="glyphicon glyphicon-ok-sign"> '+e.data.filename+'</i></span></h4>'
      fo++;
      if(fo!=filelist.length)
      {
        
        
          fdownload(fo);
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
  
  worker.postMessage({fileName:filelist[fo],
                      url: filelist[fo],type: 'video/mp4',chunks:get_filesize.chunks,size:$.chunk,send:get_filesize.send,total:get_filesize.total,remain:get_filesize.remain,fname:filelist[fo],pc:fo});
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
fo=0;
fdownload(fo);


</script>

</body>

</html>