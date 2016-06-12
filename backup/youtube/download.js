self.requestFileSystemSync = self.webkitRequestFileSystemSync ||
                             self.requestFileSystemSync;

function makeRequest(url,f,l,total) {
  
  try {
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, false); // Note: synchronous
    //"+parseInt(f)+"-"+parseInt(l)
    xhr.setRequestHeader("Range", "bytes="+parseInt(f)+"-"+parseInt(l));
    /////////////////////
    xhr.onreadystatechange = function() {
      if(xhr.readyState>1)
      {
       
      }
    if (xhr.readyState == 4 && xhr.status == 200)
     {
           
         var w=(start/total) *100;
         postMessage(w);
     
      xhr.responseType = 'arraybuffer';
       // console.log("44364364747   "+xhr.getResponseHeader('content-type'))
      
    }

  };
    /////////////////////
    
    xhr.send();
    return xhr.response;
  } catch(e) {
    return "XHR Error " + e.toString();
  }
}

function onError(e) {
  postMessage('ERROR: ' + e.toString());
}

onmessage = function(e) {
  var data = e.data;

  // Make sure we have the right parameters.
  if (!data.fileName || !data.url || !data.type) {

    return;
  }

  try {
    
    var start=0;
    var blobtotal=0;

    console.log(data);
    var chunkBlobs =[];

    for (var i = 0; i < data.chunks; i++) 
    {
      a=parseInt(start+data.size);
      console.log("no "+i+" "+start+"--"+a);
      //start=parseInt(start+data.size+1);
/////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////
    var w=(start/data.total) *100;
    postMessage(w);
    var arrayBuffer = makeRequest(data.url,start,a);
    var w=(start/data.total) *100;
    postMessage(w);
    // document.getElementById("per").style.width="";
    start=parseInt(start+data.size+1);

    chunkBlobs[i] = new Blob([new Uint8Array(arrayBuffer)], {type: data.type});

    // try
    //  {
    //     postMessage('Begin writing');
        
    //     var fw = fileEntry.createWriter();
    //     fw.seek(fw.length);
    //     fw.write(blob);
        
    //     postMessage('Writing complete');
    //     postMessage(fileEntry.toURL());
    // } 
    // catch (e) 
    // {
    //   onError(e);
    // }
////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
    }
    
    
    var tt=data.total-start;
    var tmp=parseInt(start+tt);
    console.log(start+"---------"+tmp);
    // var arrayBuffer = makeRequest(data.url,0,5535178);
    var arrayBuffer = makeRequest(data.url,start,tmp,data.total);
    var w=(start/data.total) *100;
    postMessage(w);
    start=parseInt(start+data.size+1);
    var w=(start/data.total) *100;
    postMessage(w);
    console.log("******* "+i);
     chunkBlobs[i] = new Blob([new Uint8Array(arrayBuffer)], {type: data.type});
    var finalBlob=new Blob(chunkBlobs,{type: data.type});
    try
     {
        var fs = requestFileSystemSync(TEMPORARY, 1024 * 1024 /*1MB*/);

        //postMessage('Got file system.');

        var fileEntry = fs.root.getFile(data.fileName, {create: true});

        //postMessage('Got file entry.');
        //postMessage('Begin writing');
        // fileEntry.createWriter(function(fileWriter) {

        // fileWriter.seek(fileWriter.length); // Start write position at EOF.

        fileEntry.createWriter().write(finalBlob);
        // fileWriter.write(blob);

      // });
        // fileEntry.createWriter().write(blob);
        //postMessage('Writing complete');
        var data={
          status:"complete",
          url:fileEntry.toURL()
        };
        postMessage(data);
        // postMessage();
    } 
    catch (e) 
    {
      onError(e);
    }

  } catch (e) {
    onError(e);
  }
};

/////////////
// var chunkSize = 500000;
// var totalChunks = 200;
// var currentChunk = 0;
// var mime = 'application/octet-binary';
// var waitBetweenChunks = 50;

// var finalBlob = null;
// var chunkBlobs =[];

// function addChunk() {
//     var typedArray = new Int8Array(chunkSize);
//     chunkBlobs[currentChunk] = new Blob([typedArray], {type: mime});
//     console.log('added chunk', currentChunk);
//     currentChunk++;
//     if (currentChunk == totalChunks) {
//         console.log('all chunks completed');
//         finalBlob = new Blob(chunkBlobs, {type: mime});
//         document.getElementById('completedFileLink').href = URL.createObjectURL(finalBlob);
//     } else {
//         window.setTimeout(addChunk, waitBetweenChunks);
//     }
// }
// addChunk();
