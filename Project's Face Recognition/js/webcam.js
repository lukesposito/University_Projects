'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
    video: {
        width: 1280, height: 720
    }
};

// Access webcam
async function init() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
        setTimeout(function(){ takeASnap(); }, 5000);
    } catch (e) {
        errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
}//.then(download)


// Success
function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
}

// Load init
init();

// Draw image
function takeASnap(){
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, 640, 480);
    $('#form_id').on('submit', function() {
		var canvas = document.getElementById('canvas-area')
		var dataURL = canvas.toDataURL()
		$('#textarea').val(dataURL)
	})
    //return new Promise((res, rej)=>{
    //    canvas.toblob(res, 'image/png');
    //});
    
}
    


function download(blob){
    // uses the <a download> to download a Blob
    let link = document.createElement('a'); 
    link.href = URL.createObjectURL(blob);
    //link.href = "./Face_recog/random_photos/";
    link.download = 'screenshot.jpg';
    document.body.appendChild(link);
    link.click();
}


function saveViaAJAX() {
    var dataURL = canvas.toDataURL();
    document.getElementById('canvasImg').src = dataURL;
    $.ajax({
        type: "POST",
        url: "fileUpload.php",
        data: { 
           imgBase64: dataURL
        }
      }).done(function(o) {
        console.log('saved'); 
        // If you want the file to be visible in the browser 
        // - please modify the callback in javascript. All you
        // need is to return the url to the file, you just saved 
        // and than put the image in your browser.
      });    
}