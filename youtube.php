<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<title>Download files using a XHR2, a Worker, and saving to filesystem</title>
<style type="text/css">
#per{
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
<body>
<script>
$={};
$.fs=function (fs,file,finalBlob) 
{

  



}

function formatBytes(bytes,decimals)
 {
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
    xhr.open("HEAD", url, true); // Notice "HEAD" instead of "GET",
                                 //  to get only the header
    xhr.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            callback(parseInt(xhr.getResponseHeader("Content-Length")));
        }
    };
    xhr.send();
}

get_filesize("old.mp4", function(size) {
    console.log("The size of foo.exe is: " + size + " bytes. total MB "+formatBytes(size));
    get_filesize.size=size;
    get_filesize.chunks=Math.floor(size/(1024*1024*2));
    if(get_filesize.chunks==0)
    {
    	get_filesize.total=get_filesize.size;
    	get_filesize.chunks=1;
    	console.log(get_filesize.total)

    }
    else
    {
    	console.log("get_filesize.total get_filesize.chunks "+get_filesize.chunks);
	    get_filesize.send=get_filesize.chunks*(1024*1024*2);

	    console.log("get_filesize.send get_filesize.chunks"+get_filesize.send);
	    get_filesize.remain=get_filesize.size-get_filesize.send;
	    console.log("remaining bytes"+get_filesize.remain)
	    get_filesize.total=get_filesize.send+get_filesize.remain;
	    console.log(get_filesize.total)
    }

////////////////////////////////////////////

    		
  $.data=
  {
    fileName:'load.mp4',
    url: 'old.mp4',
    type: 'video/mp4',
    chunks:get_filesize.chunks,
    size:1024*1024*2,
    send:get_filesize.send,
    total:get_filesize.total,
    remain:get_filesize.remain,
    fname:'old.mp4'
  };
  $.on($.data);
////////////////////////////////////////////


 // for()

});

///////get file size and cout get_filesize.chunks




  
//type: 'image/png'

  

function d()
{
	window.requestFileSystem = window.webkitRequestFileSystem;
	try
	 {
    var fs = window.requestFileSystem(TEMPORARY, 1024 * 1024, function(fs) {
  fs.root.getFile('load.mp4', {create: false}, function(fileEntry) {

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


</script>
<button onclick="d()"> delete</button>
<div id="per"></div>
<div id="result"></div>
</body>

</html>
<script type="text/javascript">
  window.requestFileSystem = window.webkitRequestFileSystem;

function makeRequest(url,f,l) 
{
  
  try
  {
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, false); // Note: synchronous

    xhr.setRequestHeader("Range", "bytes="+parseInt(f)+"-"+parseInt(l));
      xhr.responseType = 'arraybuffer';
      
    
    xhr.send();
    return xhr.response;
  }
  catch(e)
  {
    return "XHR Error " + e.toString();
  }
}

function onError(e) 
{
  console.log('ERROR: ' + e.toString());
}

$.on = function(data) 
{
  
  console.log(data);
  $.tmp=data;
  // Make sure we have the right parameters.
  if (!data.fileName || !data.url || !data.type)
   {

    return;
   }

  try
   {
    
      var start=0;
      var blobtotal=0;

      console.log(data);
      var chunkBlobs =[];

      for (var i = 0; i < data.chunks; i++) 
      {
        a=parseInt(start+data.size);
        console.log("no "+i+" "+start+"--"+a);
    
        var arrayBuffer = makeRequest(data.url,start,a);
        var w=(start/data.total) *100;
        console.log(w);
        // document.getElementById("per").style.width="";
        start=parseInt(start+data.size+1);

        chunkBlobs[i] = new Blob([new Uint8Array(arrayBuffer)], {type: data.type});

      }
      
      
      var tt=data.total-start;
      var tmp=parseInt(start+tt);
      console.log(start+"---------"+tmp);
      // var arrayBuffer = makeRequest(data.url,0,5535178);
      var arrayBuffer = makeRequest(data.url,start,tmp);
      var w=(start/data.total) *100;
      document.getElementById("per").innerHTML=parseInt(w)+"%";
      document.getElementById("per").style.width=parseInt(w)+"%";
      console.log(w);
      start=parseInt(start+data.size+1);
      var w=(start/data.total) *100;
      console.log(w);
      document.getElementById("per").innerHTML=parseInt(w)+"%";
      document.getElementById("per").style.width=parseInt(w)+"%";
      console.log("******* "+i);
       chunkBlobs[i] = new Blob([new Uint8Array(arrayBuffer)], {type: data.type});
      var finalBlob=new Blob(chunkBlobs,{type: data.type});

        var finalBlob=new Blob(chunkBlobs,{type: data.type});
        window.requestFileSystem = window.webkitRequestFileSystem;
            try
           {
            var fs = window.requestFileSystem(TEMPORARY, 1024 * 1024, function(fs) {
          fs.root.getFile($.tmp.fileName, {create: true}, function(fileEntry) {
              fileEntry.createWriter(function(fileWriter) {
                fileWriter.write(finalBlob);
              });
            

          });
          });
             
            }

           catch (e) 
          {
            console.log(e);
          }

  } 
  catch (e) {
    onError(e);
  }
};

</script>