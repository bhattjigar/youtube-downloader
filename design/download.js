$={};
$.pc=0;
$.downloaded=0;
/////////////////////////////////////////////////
var MyBlobBuilder = function() {
  this.parts = [];
}

MyBlobBuilder.prototype.append = function(part) {
  this.parts.push(part);
  this.blob = undefined; // Invalidate the blob
};

MyBlobBuilder.prototype.getBlob = function() {
  if (!this.blob) {
    this.blob = new Blob(this.parts, {type: "video/mp4"});
  }
  return this.blob;
};

var youtube = new MyBlobBuilder();

// youtube.append("Hello world, 2");

// // Other stuff ... 

// youtube.append(",another data");
// var blob = youtube.getBlob();
// console.log(blob.size);
// console.log(blob.type);

///////////////////////////////////////////////////


finalBlob = new Blob([], {type: 'video/mp4'});
 bloblist=[];
var final=0;

function makeRequest(url,f,l,pos) {
    startTime = (new Date()).getTime();
  try {
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, false); // Note: synchronous
    //"+parseInt(f)+"-"+parseInt(l)
    xhr.setRequestHeader("Range", "bytes="+parseInt(f)+"-"+parseInt(l));
    /////////////////////
    xhr.onreadystatechange = function() {
      
        

    if (xhr.readyState == 4 && xhr.status == 200)
     {
           
        
        
         
      }

  };
    /////////////////////
    xhr.responseType = 'arraybuffer';
    xhr.send();
    $.response[pos]=xhr.response;
    // youtube.append(xhr.response);
    ///////////////////////////////////////////////////////////////
        endTime = (new Date()).getTime();
        var totalBytes  = xhr.getResponseHeader('Content-length');
        var downloadSize =xhr.response.byteLength;
        
       
        var duration = (endTime - startTime) / 1000;
        var bitsLoaded = downloadSize * 8;
        var speedBps = (bitsLoaded / duration).toFixed(2);
        var speedKbps = (speedBps / 1024).toFixed(2);
        var speedMbps = (speedKbps / 1024).toFixed(2);
        $.MB=speedMbps;
           console.log("Your connection speed is: "+
            speedBps + " bps "+ 
            speedKbps + " kbps "+ 
            speedMbps + " Mbps ");
//////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////
      
      
      if($.inc!=$.part&&$.flag==1)
      {
          start=parseInt(l+1);
          $.start=start;
          end=parseInt(start+$.size)
          console.log("no "+$.inc+" "+start+"--"+end);
          var w=(start/$.total) *100;
          $.s={
            size:w,
            speed:$.MB
          };
          postMessage($.s);
          $.inc++;
          pos++;
          makeRequest(url,start,end,pos);

      
      }
      

///////////////////////////////////////////////////////////////////////////////////////////////////////


        
    ///////////////////////////////////////////////////////////////
    // bloblist[fo] = new Blob([xhr.response], {type: "video/mp4"});
    //  final=final+bloblist[fo].size;
    //     console.log("size::: "+bloblist[fo].size);
    //     console.log("finalllllsize::: "+final);
    //     console.log(URL.createObjectURL(bloblist[fo]));
    // return xhr.response;
   
  } catch(e) {
    return "XHR Error " + e.toString();
  }
}

function onError(e) {
  postMessage('ERROR: ' + e.toString());
}

onmessage = function(e) {
  var data = e.data;
  $.pc=data.pc;
  $.total=data.total;
  // Make sure we have the right parameters.
  if (!data.fileName || !data.url || !data.type) {

    return;
  }

  try {
    
    var start=0;
    var blobtotal=0;

    console.log(data);
    var chunkBlobs =[];
    ////////////////////////////////////////////////
    $.response=[];
    $.part=data.chunks;
    $.size=data.size;
    $.total=data.total;
    $.inc=0;
    $.flag=1;
    a=parseInt(start+data.size);
    console.log("no "+$.inc+" "+start+"--"+a);
    var w=(start/data.total) *100;
    postMessage(w);
    makeRequest(data.url,start,a,$.inc);
      

// ////////////////////////////////////////////////////////////////////////////////////////////////
     // start=parseInt(a+1);
     // a=parseInt(start+data.size);
     // console.log("no "+$.inc+" "+start+"--"+a);
     // var w=(start/data.total) *100;
     // postMessage(w);
     // $.inc++;
     // makeRequest(data.url,start,a,$.inc);

     // start=parseInt(a+1);
     // a=parseInt(start+data.size);
     // console.log("no "+$.inc+" "+start+"--"+a);
     // var w=(start/data.total) *100;
     // postMessage(w);
     // $.inc++;
     // makeRequest(data.url,start,a,$.inc);


// ///////////////////////////////////////////////////////////////////////////////////////////////
//    

    /////////////////////////////////////////////////////////////////////

    
    /////////////////////////////////////////////////////////////////////
    $.flag=0;
    start=$.start;
    var tt=data.total-start;
    var tmp=parseInt(start+tt);
    console.log(start+"---final---------"+tmp);
    // var arrayBuffer = makeRequest(data.url,0,5535178);
     makeRequest(data.url,start,tmp);
    //  w=(start/tmp) *100;
    //      postMessage(w);
    // start=parseInt(start+data.size+1);
    // var w=(start/data.total) *100;
    // $.s={
    //   size:w,
    //   speed:$.MB
    // };
    // postMessage($.s);



   var fs=[];
   var dirEntry=[];
   var fileEntry=[];
   var fileWriter=[];
   var finalurl=[];
    try
     {
        //  fs[$.pc] = requestFileSystemSync(TEMPORARY, null);
          
        //  dirEntry[$.pc]=fs[$.pc].root.getDirectory("data", {create: true});
        //  fileEntry[$.pc] = dirEntry[$.pc].getFile(data.fileName, {create: false});
        //  console.log("---------------->>>>>>>>>>>>>>>>>>>>"+data.fileName);
        

      
        
        // fileWriter[$.pc]=fileEntry[$.pc].createWriter();

        // youtube.append(arrayBuffer);
        // bloblist[i] = new Blob([arrayBuffer], {type: "video/mp4"});
        // finalBlob = new Blob([bloblist], {type: 'video/mp4'});

        for(po=0;po<$.response.length;po++)
        {
          youtube.append($.response[po]);
        }

        finalurl[$.pc]=youtube.getBlob();
          $.uri=URL.createObjectURL(finalurl[$.pc]);
          $.fileName=data.fileName;
        ////////
          
        //////////
      //   fileWriter[$.pc].onwriteend = function(e) {
      //   console.log($.pc+'  ---*** Write completed.');
      // };
          $.write=1;
          // fileWriter[$.pc].truncate(0);

         // fileWriter[$.pc].write(finalurl[$.pc]);

 
         delete finalurl;
         delete finalBlob;
         delete bloblist;
         //fileEntry.toURL()
         //URL.createObjectURL(finalurl)
         // var uri=fileEntry[$.pc].toURL();
         // console.log(uri)
        var data={
          status:"complete",
          url:$.uri,
          filename:$.fileName
        };
        postMessage(data);
        // postMessage();
         
    } 
    catch (e) 
    {
     
        
      onError("finallllllllll errrrroo   "+ e);
    }

  } catch (e) {
    onError(e);
  }
};
