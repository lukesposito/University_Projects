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

    session_start();
    if (isset($_SESSION['ID'])) {
      unlink("./user.txt");
      unlink("./file.txt");
      $message = "Login effettuatto con successo! Benvenuto/a " . $_SESSION['Nome'] . " " . $_SESSION['Cognome'] . "!";
    } else {
      $message = "Please log in first to see this page.";
    }

    if(isset($_GET["resCode"]))
	{
		$resCode = $_GET["resCode"];
    // if($resCode == 3)
		// {
    //   $DateUsers = fopen("./user.txt", "r") or die("Unable to open file!");
    //   $verificate = file_get_contents("./user.txt");
    //   $arr1 = str_split($verificate);
		// 	fclose($DateUsers);
    //   unlink("./user.txt");
    //   unlink("./file.txt");
    //   $sql = "SELECT Nome, Cognome, ID FROM Utenti WHERE Utenti.ID='".$arr1[0]."'";
    //   $sqlresult = @$conn->query($sql);
    //   while($riga = $sqlresult->fetch_assoc()) {
    //     if($riga["ID"] == $arr1[0]) {
    //       $message = "Login effettuatto con successo! Benvenuto/a ".$riga["Nome"]." ".$riga["Cognome"]."!";

    //     }
    //   }
    // }
    // if($resCode == 4)
		// {
    //   $DateUsers = fopen("./DateUsers.txt", "r") or die("Unable to open file!");
    //   $verificate = file_get_contents("./DateUsers.txt");
    //   fclose($DateUsers);
    //   unlink("./user.txt");
    //   unlink("./file.txt");
    //   unlink("./DateUsers.txt");
    //   $sql = "SELECT Nome, Cognome, ID, Accesso_utente FROM Utenti WHERE Utenti.ID='".$verificate."'";
    //   $sqlresult = @$conn->query($sql);
    //   while($riga = $sqlresult->fetch_assoc()) {
    //     if($riga["ID"] == $verificate) {
    //       $DateUsers = fopen($riga["ID"]."_DateUsers.txt", "w") or die("Unable to open file!");
    //       fwrite($DateUsers, $riga["Accesso_utente"]);
		// 	    fclose($DateUsers);
    //       $message = "Login effettuatto con successo! Benvenuto/a ".$riga["Nome"]." ".$riga["Cognome"]."!";

    //     }
    //   }
    // }
    if($resCode == 21)
		{
			$message = "Trasferimento foto avvenuto con successo!";
		}
    if($resCode == 22)
		{
			$message = "ERRORE, trasferimento foto fallito!";
		}
	}

  
  $sql = "SELECT Nome, Cognome, Data_di_nascita, Email, Tipo_utente, ID FROM Utenti";
  $sqlresult = @$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->



  <title>Utenti</title>
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

	</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google font -->

  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round' rel='stylesheet'>



  <!-- Bootstrap -->

  <link type='text/css' rel='stylesheet' href='css/bootstrap.min.css' />



  <!-- Owl Carousel -->

  <link type='text/css' rel='stylesheet' href='css/owl.carousel.css' />
  <link type='text/css' rel='stylesheet' href='css/owl.theme.default.css' />



  <!-- Magnific Popup -->

  <link type='text/css' rel='stylesheet' href='css/magnific-popup.css' />



  <!-- Font Awesome Icon -->

  <link rel='stylesheet' href='css/font-awesome.min.css'>



  <!-- Custom stlylesheet -->

  <link type='text/css' rel='stylesheet' href='css/style.css' />



  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

  <!--[if lt IE 9]>

    <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>

    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>

  <![endif]-->

</head>

<body background='./img/windows_user.jpg'>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <header id='Utente'>

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
          			<li><a href="Index.php">Logout</a></li>
          			<li class="Utente"><a href="Utente.php">Utenti</a>
               <!-- <ul class="dropdown">
							    <li class="Admin" style="display: none;"><a href="AddUtente.php">Aggiungi</a></li>
            		</ul>-->
                </li>
        		</ul>
				<!-- /Main navigation -->

			</div>
		</nav>

    <!-- /Nav -->
    <!-- home wrapper -->
    <div class="home-wrapper">
        <div class="container">
            <div class="row">

                <!-- home content 
                <div class="col-md-10 col-md-offset-1">
                    <div class="home-content">
                        <h1 class="white-text">GESTIONE ACCESSO UTENTE</h1>
                        <p class="white-text">Benvenuto nella gestione di accesso per i soli utenti autorizzati. <br>
                        </p>
                    </div>
                </div>
                 /home content -->

            </div>
        </div>
    </div>
    <!-- /home wrapper -->
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

  <?php
		if(isset($message))
			echo "<div class='message' role='status'>".$message."</div>";
	?>

  <center> <h2 style="color:white">Utenti</h2> </center>

<p id="risultato"></p>
<div id="form_id">

    <div>
        <canvas id="canvas-area" width="640" height="480" style=visibility:hidden> </canvas>
        <textarea name="textarea" id="textarea"></textarea>
    </div>
   
    <!--<div class="container">
        <h1>webcam Preview & Image Capture</h1>
    </div>-->
    
    <p><span id="errorMsg"></span></p>   


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
        <form id="targetphoto" action="takephoto.php">
          <input type="submit" value="Take">
        </form>
          <button onclick="stopWebcamButton();" id="stop_button" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
        </div>
      </div>
    </div>
  </div>
  
<table class="form-style-5">
        <td>
        <div class="form-style-5">
        <fieldset>
                <legend><span class="number">*</span> Acquisizione foto</legend>
        </fieldset>
                <input onclick="startWebcam();" value="Scatta" id="submit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
        width: 560, height: 330
    }
};

// Access webcam
async function init() {
    try {   
        const stream = await navigator.mediaDevices.getUserMedia(constraints);
        handleSuccess(stream);
        if(document.getElementById("exampleModal").style.display == "none") { stopWebcamEscape(); } if(window.stream == stream){ if(video.srcObject == stream){ takeASnap();}};
        event.preventDefault();
    } catch (e) {
        //errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
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
    document.getElementById("targetphoto").addEventListener("submit", myFunction);
    function myFunction(e) {
      e.preventDefault();
      var canvas = document.getElementById('canvas-area');
      var context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, 640, 480);
	    var dataURL = canvas.toDataURL()
      jQuery.ajax({
           url: "takephoto.php",
           method: "POST",
           data: jQuery('textarea[name="textarea"]').val(dataURL),
           success: function()
           {
               alert("La foto è stata scattata!");
               $("#exampleModal").modal("hide");
               stopWebcamEscape();
               window.location.assign('Utente.php')
           }
      });
    }
}
     
    // jQuery.ajax({
    //     url: "takephoto.php",
    //     method: "POST",
    //     data: jQuery('textarea[name="textarea"]').val(dataURL),
    //     success: function(data){
    //         $("#loading").hide();
    //         alert(data);
    //         $("#exampleModal").modal("hide");
    //         stopWebcamEscape();
    //     }
    // });


</script>


<div class='limiter'>
    <div class='container-table100'>
      <div class='wrap-table100'>
        <div class='table100'>
          <table class='coolTable'>
            <thead>
              <tr class='table100-head'>
                <th> INVIO FOTO DATABASE </th>
                <td> <form action='fileUploadUsers.php' method='POST' enctype='multipart/form-data'> <input type='file' name='Upload'> <input type='submit'></form></td>
              </tr>
            </thead>


<div class='limiter'>
    <div class='container-table100'>
      <div class='wrap-table100'>
        <div class='table100'>
          <table class='coolTable'>
            <thead>
              <tr class='table100-head'>
                <th> NOME </th>
                <th> COGNOME </th>
                <th> DATA DI NASCITA </th>
                <th> EMAIL </th>
                <th> TIPO UTENTE </th>
                <th> ID UTENTE </th>
              </tr>
            </thead>


  <?php 
  while($riga = $sqlresult->fetch_assoc())
  {
    echo
    "<tr>
      <td> ".$riga['Nome']." </td>
      <td> ".$riga['Cognome']." </td>
      <td> ".$riga['Data_di_nascita']." </td>
      <td> ".$riga['Email']." </td>
      <td> ".$riga['Tipo_utente']." </td>
      <td> ".$riga['ID']." </td>
    </tr>";

  }

	echo 
	"					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>";

	exit;


  mysqli_close($conn);
?>


</body>
</html>