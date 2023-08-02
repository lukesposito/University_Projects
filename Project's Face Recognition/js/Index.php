<!DOCTYPE html>
<html>
<head>
    <title>Upload from Canvas</title>
    <style>
		#canvas-area {
			border: 1px solid #ccc;
		}

		#textarea, #preview-pict {
			display: none;
		}
	</style>
<meta charset="utf-8">

<link rel="stylesheet" href="css/html5.webcam.demo.css">

</head>
<body>


<!-- Trigger canvas web API
<div class="controller">
    <button id="snap">Capture</button>
</div> -->

<form action="save.php" method="post" id="form_id">
    
    <div class="container">
        <h1>webcam Preview & Image Capture </h1>
    </div>
    
        <p><span id="errorMsg"></span></p>
    
    <div class="video-wrap">
        <video id="video" playsinline autoplay></video>
    </div>

    <div>
        <canvas id="canvas-area" width="640" height="480"></canvas>
        <textarea name="textarea" id="textarea"></textarea>
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>

'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
    video: {
        width: 990, height: 720
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
    var canvas = document.getElementById('canvas-area');
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

</script>
</body>
</html>
