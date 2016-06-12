<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="chrome=1">
<title>Download files using a XHR2, a Worker, and saving to filesystem</title>
<style type="text/css">
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
<button onclick="d()"> delete</button>
<div id="final"></div>
<body>
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
    xhr.open("HEAD", url, true); // Notice "HEAD" instead of "GET",
                                 //  to get only the header
    xhr.onreadystatechange = function() {
        if (this.readyState == this.DONE) {
            callback(parseInt(xhr.getResponseHeader("Content-Length")));
        }
    };
    xhr.send();
}

///////////////////////////
var filelist=["old.mp4","old2.mp4"];

function fdownload(fo)
{
	var a=document.createElement("div");
	a.id="per"+fo;
	a.className="per";
	document.getElementById("final").appendChild(a);

get_filesize(filelist[fo], function(size) {
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
var worker = new Worker('download.js');
  worker.onmessage = function(e) {
    console.log(e.data);
    if(e.data.status)
    {
       if(e.data.status=="complete")
       {
       	var b=document.createElement("div");
		b.id="result"+fo;
		b.innerHTML="<a download href='"+e.data.url+"'> Download</a>";   	
    	document.getElementById("final").appendChild(b);
    	fo++;
    	if(fo!=filelist.length)
    	{
    		fdownload(fo);	
    	}
    	
    	
       }
    }
    else
    {
    	if(parseInt(e.data)>=100)
    	{
    		t=100
    	}
    	else
    	{
    		t=parseInt(e.data);
    	}
    	a.innerHTML=t+"%";
    	a.style.width=t+"%";	
    }
    
  };
  
  worker.postMessage({fileName:filelist[fo],
                      url: filelist[fo],type: 'video/mp4',chunks:get_filesize.chunks,size:1024*1024*2,send:get_filesize.send,total:get_filesize.total,remain:get_filesize.remain,fname:filelist[fo]});
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
fo=0;
fdownload(fo);

</script>

</body>

</html>