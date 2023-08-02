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
?>

<!DOCTYPE html>
<html lang='en'>



<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->



  <title>Aggiungi Utente</title>



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
	<!-- Header -->
	<header id='AddUtente'>

    <!-- Background Image -->
    <div class="bg-img" style="background-image: url('./img/windows_user.jpg');">
        <div class="overlay"></div>
    </div>

    <!-- Nav -->
    <<nav id="nav" class="navbar nav-transparent">
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

	<center> <h2 style="color:white">Nuovo utente</h2> </center>
		<table class="form-style-5">
			<td>
			<div class="form-style-5">
				<form action="ServerSQL.php" method="POST">
					<fieldset>
						<legend><span class="number">*</span> Info Utente </legend>
						<!--<input type="number" name="id_utente" placeholder="Id_utente..." required>-->
						<input type="text" name="Nome" placeholder="Nome..." required>
						<input type="text" name="Cognome" placeholder="Cognome..." required>
						<input type="date" name="Data_di_nascita" required>
						<input type="text" name="Email" placeholder="Email..." required>
						<input type="text" name="Password_utente" placeholder="Password..." required>
						<select name="Tipo_utente">
							<option value="User">User</option>	
						</select>
					</fieldset>
				<input type="submit" name="btnAddUsr" value="Aggiungi"/>
				</form>
			</div>
			</td>
		</table>
 </body>
</html>