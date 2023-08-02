<?php 
		$db = "coppa_italia";

		$conn = new mysqli("localhost", "root", "");
		if ($conn->connect_error) {
			die("Errore connessione: " . $conn->connect_error);
		}
		if($conn->select_db($db) == 0)
		{
			echo "Non trovo il database ...";
			die;      
		}
	$sqlTeams = "SELECT Id_squadra, Nome_sq FROM Squadra";
	$sqlTeamResult = @$conn->query($sqlTeams);
?> 

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>GIOCATORE</title>

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

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body background="./img/Coppa-Italia-2019.jpg">
	<!-- Header -->
	<header id="AddGiocatore">
		<!-- Background Image -->
		<div class="bg-img" style="background-image: url('./img/Coppa-Italia-2019.jpg');">
			<div class="overlay"></div>
		</div>
		<!-- /Background Image -->

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
          			<li><a href="index.html">Home</a></li>
          			<li class="has-dropdown"><a href="Squadra.php">Squadre</a>
            			<ul class="dropdown">
              				<li><a href="AddSquadra.html">Aggiungi</a></li>
            			</ul>
          			</li>
          			<li class="has-dropdown"><a href="Giocatore.php">Giocatori</a>
            			<ul class="dropdown">
              				<li><a href="AddGiocatore.php">Aggiungi</a></li>
            			</ul>
         			 </li>
          			<li class="has-dropdown"><a href="Arbitro.php">Arbitri</a>
            			<ul class="dropdown">
              				<li><a href="AddArbitro.html">Aggiungi</a></li>
          	  			</ul>
          			</li>
          			<li class="has-dropdown"><a href="Partita.php">Partite</a>
            			<ul class="dropdown">
              				<li><a href="AddPartita.php">Aggiungi</a></li>
            			</ul>
          			</li>
          			<li class="has-dropdown"><a href="Goal.php">Goal</a>
            			<ul class="dropdown">
              				<li><a href="AddGoal.php">Aggiungi</a></li>
            			</ul>
          			</li>
          			<li class="has-dropdown"><a href="Edvinte.php">Edizioni vinte</a>
            			<ul class="dropdown">
              				<li><a href="AddEdvinte.php">Aggiungi</a></li>
            			</ul>
          			</li>
        		</ul>
				<!-- /Main navigation -->
			</div>
		</nav>
		<!-- /Nav -->
	</header>
	<!-- /Header -->

	<center> <h2 style="color:white">Nuova edizione</h2> </center>
		<table class="form-style-5">
			<td>
			<div class="form-style-5">
				<form action="ServerSQL.php" method="POST">
					<fieldset>
						<legend><span class="number">*</span> Info Edizione </legend>
						<input type="number" name="year_edition" placeholder="Anno edizione..." min=1950 max=2019 required>
						<select name="winning_team">
						<?php 
							while($team = $sqlTeamResult->fetch_assoc())
							{
								echo "<option value=".$team['Nome_sq'].">".$team['Nome_sq']."</option>";
							}
						?> 
						</select>
					</fieldset>
				<input type="submit" name="btnAddEdition" value="Aggiungi" />
				</form>
			</div>
			</td>
		</table>
 </body>
</html>