<?php 

 $db = "facerecognition";
 $serverName = "localhost";

		$conn = new mysqli($serverName, "ubuntu", "Current-Root-Password");
		if ($conn->connect_error) {
			die("Errore connessione: " . $conn->connect_error);
		}
		if($conn->select_db($db) == 0)
		{
			echo "Non trovo il database ...";
			die;      
		}

    if(isset($_GET["resCode"]))
	{
        $resCode = $_GET["resCode"];
        if($resCode == 1) {
            //$message = "Dati non corretti, questo utente non esiste!";
            echo "<script type='text/javascript'>alert('Dati non corretti, questo utente non esiste!'); window.location.assign('Index.php')</script>";
        }
        else if($resCode == 2) {
            //$message = "Non puoi accedere! Sei stato disabilitato.";
            echo "<script type='text/javascript'>alert('Non puoi accedere! Sei stato disabilitato.'); window.location.assign('Index.php')</script>";
        }
        else if($resCode == 3) {
            //$message = "Non puoi accedere! Sei stato disabilitato.";
            echo "<script type='text/javascript'>alert('Non puoi accedere! Non sei stato riconosciuto.'); window.location.assign('Index.php')</script>";
        }
	}
?>


<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Pagina Login</title>
    <style>
		#canvas-area {
			border: 1px solid #ccc;
		}

		#textarea, #preview-pict {
			display: none;
		}
        #button {
            position: absolute;
            left: 900px;
            top: 500px;
        }

        .loader {
            display: none;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid blue;
            border-bottom: 16px solid blue;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

       @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

	</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">


<!-- Bootstrap -->
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />


<!-- Owl Carousel -->
<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />



<!-- Magnific Popup -->
<link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />



<!-- Font Awesome Icon -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">



<!-- Custom stlylesheet -->

<link type="text/css" rel="stylesheet" href="css/style.css" />

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->

</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   

<!-- Header -->
<header id="home">

    <!-- Background Image -->
    <div class="bg-img" style="background-image: url('./img/windows_user.jpg');">
        <div class="overlay"></div>
    </div>

    <!-- Nav -->
    <nav id="nav" class="navbar nav-transparent">
			<div class="container">

				<div class="navbar-header">
					<!-- Collapse nav button -->
					<div class="nav-collapse">
						<span></span>
					</div>
					<!-- /Collapse nav button -->
				</div>

                <!--  Main navigation  -->
				 <ul class="main-nav nav navbar-nav navbar-right">
          			<li><a href="Begin.html">Home</a></li>
                    <li><a href="Index.php">Login</a></li>
        		</ul>
				<!-- /Main navigation -->


			</div>
		</nav>
    <!-- /Nav -->



</header>
<!-- /Header -->

  <!-- Back to top -->
  <div id="back-to-top"></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>


  <!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>



<!-- Button trigger modal 
<div class="fixed-top">
 <button onclick="startWebcam();" id="button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Accesso da Webcam
 </button>
</div> -->
   

<p id="risultato"></p>
<div id="form_id">
   
    <!--<div class="container">
        <h1>webcam Preview & Image Capture</h1>
    </div>-->
    
        <p><span id="errorMsg"></span></p>   

    <div>
        <canvas id="canvas-area" width="640" height="480" style=visibility:hidden> </canvas>
        <textarea name="textarea" id="textarea"></textarea>
    </div>

    <!-- Modal -->
   
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <div class="video-wrap">
                <video id="video" playsinline autoplay></video>
            </div>

          <!--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
          <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
          </button>-->
        </div>
     <!--  <div class="modal-body">
          ...
        </div> -->
        <div class="modal-footer">
          <button onclick="stopWebcamButton();" id="stop_button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
          <button class="btn btn-primary" id="loading" type="button" disabled style="display:none;" data-toggle="modal" data-target="#exampleModal">
            <span class="spinner-border spinner-border-sm" id="loading" role="status" aria-hidden="true"></span>
              Loading...
          </button>
        </div>
      </div>
    </div>
  </div>

  <center> <h2 style="color:rgb(255, 255, 255)">LOGIN UTENTE</center>
  <?php
		if(isset($message))
			echo "<div class='message' role='status'>".$message."</div>";
   ?>
    <table class="form-style-5">
        <td>
        <div class="form-style-5">
            <form action="ServerSQL.php" method="POST">
                <fieldset>
                    <legend><span class="number">*</span> Login Utente</legend>
                    <input type="text" name="Email" placeholder="Email..." required>
                    <!--<input type="text" name="Password_utente" placeholder="Password..." required> -->
                    <input type="password" id="Password_utente" name="Password_utente">
                    <input type="button" onclick="showPwd()" value="Mostra/nascondi password">
                    <script>
                        function showPwd() {
                            var input = document.getElementById('Password_utente');
                            if (input.type === "password") {
                            input.type = "text";
                            } else {
                            input.type = "password";
                            }
                        }
                    </script>
                </fieldset>
                <input type="submit" name="Login" value="Accedi"/>  
            </form>
                <input onclick="startWebcam();" value="Accesso da Webcam" id="submit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <!--<button onclick="startWebcam();" value="Accesso da Webcam" id="submit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
        </div>
        </td>
    </table>

    </div>


<div class="target"></div>

<script>

'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const snap = document.getElementById("snap");
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
    video: {
        width: 470, height: 330
    }
};

// Access webcam
async function init() {
    try {   
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
        setTimeout(function(){ if(document.getElementById("exampleModal").style.display == "none") { stopWebcamEscape(); } if(window.stream == stream){ if(video.srcObject == stream){ {takeASnap();}}}  }, 3000);
        event.preventDefault();
    } catch (e) {
        errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
    }
}


function startWebcam() {
	init();
}


function stopWebcamButton() {
    stream.getVideoTracks()[0].stop();
    window.stream = null;
    video.srcObject = null; 
}

function stopWebcamEscape() {
    stream.getVideoTracks()[0].stop();
    window.stream = null;
    video.srcObject = null; 
}

// Success
function handleSuccess(stream) {
    window.stream = stream;
    video.srcObject = stream;
}

// Draw image
function takeASnap(){
    var canvas = document.getElementById('canvas-area');
    //var modal = document.getElementById("exampleModal");
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, 640, 480);
   // $('#form_id').on('submit', function() {
	var dataURL = canvas.toDataURL();
    //jQuery('form[name="form_id"]').submit(function(e){
        //e.preventDefault();
    jQuery.ajax({
        url: "save.php",
        method: "POST",
        data: jQuery('textarea[name="textarea"]').val(dataURL),
        beforeSend: function() {
            //modal.style.display = "block";
            $("#loading").show();
            $("#exampleModal").modal({backdrop: 'static', keyboard: false}); 
        },
        success: function(data){
            $("#loading").hide();
            alert(data);
            $("#exampleModal").modal("hide");
            stopWebcamEscape();
            window.location.assign("pippo.php")
        }
    });
}       
            // var rawFile = new XMLHttpRequest() || new ActiveXObject('MSXML2.XMLHTTP');
            // rawFile.open("GET", "./user.txt", false);
            // rawFile.onreadystatechange = function ()
            // {
            //     if(rawFile.readyState === 4)
            //     {
            //             var allText = rawFile.responseText;
            //             var word = allText.split("_");
            //             alert(word);
            //             if(word[0] == "1"){
            //                 window.location.assign("Admin.php")
            //             }
            //             else if(word[0] > "1"){
            //                 window.location.assign("Utente.php")
            //             }
            //             else {
            //                 window.location.assign("Index.php")
            //             }
            //     }
            // }
            // rawFile.send(null);
    //Query('form[name="Utente"]').submit(function(e){
      //  e.preventDefault();

    //});
    //});
    //return new Promise((res, rej)=>{
    //    canvas.toblob(res, 'image/png');
    //});


</script>

</body>
</html>