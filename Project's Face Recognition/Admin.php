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
		if($resCode == 0)
		{
			$message = "Utente aggiunto con successo";
		}
		if($resCode == 1)
		{
			$message = "Errore nei dati, l'utente immesso è già presente";
		}
		if($resCode == 2)
		{
			$message = "Errore nei dati, l'utente non è stata inserito";
		}
    if($resCode == 3)
		{
      $DateUsers = fopen("./user.txt", "r") or die("Unable to open file!");
      $verificate = file_get_contents("./user.txt");
      $arr1 = str_split($verificate);
			fclose($DateUsers);
      unlink("./user.txt");
      unlink("./file.txt");
      $sql = "SELECT Nome, Cognome, ID FROM Utenti WHERE Utenti.ID='".$arr1[0]."'";
      $sqlresult = @$conn->query($sql);
      while($riga = $sqlresult->fetch_assoc()) {
        if($riga["ID"] == $arr1[0]) {
          $message = "Login effettuatto con successo! Benvenuto ".$riga["Nome"]." ".$riga["Cognome"]."!";

        }
      }
    }
    if($resCode == 10)
		{
			$message = "Utente disabilitato con successo";
		}
    if($resCode == 11)
		{
			$message = "Utente abilitato con successo";
		}
    if($resCode == 20)
		{
			$message = "L'utente è disabilitato";
		}
    if($resCode == 21)
		{
			$message = "Trasferimento foto avvenuto con successo!";
		}
    if($resCode == 22)
		{
			$message = "ERRORE, trasferimento foto fallito!";
		}
	}

  
  $sql = "SELECT Nome, Cognome, Data_di_nascita, Email, Tipo_utente, ID, Utente_attivo FROM Utenti";
  $sqlresult = @$conn->query($sql);
?>

<!DOCTYPE html>
<html lang='en'>



<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->



  <title>Admin</title>



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

  <header id='Admin'>

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
          			<li class="has-dropdown"><a href="Admin.php">Utenti</a>
                <ul class="dropdown">
					 <li class="Admin"><a href="AddUtente.php">Aggiungi</a></li> 
            		</ul>
                </li>
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

  <center> <h2 style="color:white">Utenti</h2> </center>
  <?php
		if(isset($message))
			echo "<div class='message' role='status'>".$message."</div>";
	?>
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
                <th> ID </th>
                <th> UTENTE ATTIVO </th>
                <th> <th> INSERISCI FOTO</th> </th>
                <th> </th>
              </tr>
              </thead>

  <?php 
  $type_usr = "Admin";
  $active_usr = "Si";
  while($riga = $sqlresult->fetch_assoc())
  { 
    if($riga["Tipo_utente"] != $type_usr && $riga["Utente_attivo"] == $active_usr){
      echo
    "<tr>
      <td> ".$riga['Nome']." </td>
      <td> ".$riga['Cognome']." </td>
      <td> ".$riga['Data_di_nascita']." </td>
      <td> ".$riga['Email']." </td>
      <td> ".$riga['Tipo_utente']." </td>
      <td> ".$riga['ID']." </td>
      <td> ".$riga['Utente_attivo']." </td>
      <td> <form action='ServerSQL.php' method='POST'> <input type='hidden' name='codUsr' value='".$riga['Email']."/".$riga['ID']."'./> <input type='submit' name='btnDisUsr' value='Disabilita'/></form></td>
      <td> </td>
      <td> <form action='fileUploadAdmin.php' method='POST' enctype='multipart/form-data'> <input type='hidden' name='actUsr' value='".$riga['Email']."/".$riga['ID']."'./> <input type='file' name='Upload' value='Upload'> <input type='submit' name='btnVerUsr' value='Invia foto'/></form></td>
      </tr>";
      } 
    else if($riga["Tipo_utente"] != $type_usr && $riga["Utente_attivo"] != $active_usr){
      echo
    "<tr>
      <td> ".$riga['Nome']." </td>
      <td> ".$riga['Cognome']." </td>
      <td> ".$riga['Data_di_nascita']." </td>
      <td> ".$riga['Email']." </td>
      <td> ".$riga['Tipo_utente']." </td>
      <td> ".$riga['ID']." </td>
      <td> ".$riga['Utente_attivo']." </td>
      <td> <form action='ServerSQL.php' method='POST'> <input type='hidden' name='codUsr' value='".$riga['Email']."/".$riga['ID']."'./> <input type='submit' name='btnActUsr' value='Abilita'/></form></td>
      <td> </td>
      </tr>";
      
      }
     else{
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