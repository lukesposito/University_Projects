<?php 
  $db = "coppa_italia";

  $conn = new mysqli("localhost", "root", "");
  if ($conn->connect_error) {
    die("Errore connessione: " . $conn->connect_error);
  }
  
  // Seleziona il Database
  if($conn->select_db($db) == 0)
  {
    echo '<script>console.log("Non trovo il database ...")</script>';
    die;      
  }
  
  if(isset($_GET["resCode"]))
  {
    $resCode = $_GET["resCode"];
    if($resCode == 0)
    {
      $message = "Giocatore aggiunto con successo";
    }
    if($resCode == 1)
    {
      $message = "Errore nei dati, il giocatore immesso è già presente";
    }
    if($resCode == 2)
    {
      $message = "Errore nei dati, il giocatore non è stata inserito";
    }
        if($resCode == 10)
    {
      $message = "Giocatore rimosso con successo";
    }
  }
  
  $sql = "SELECT Tessera, Nome_squadra, Numero_maglia, Nome, Cognome, Ruolo, Nazionalita FROM Giocatore";
  $sqlresult = @$conn->query($sql);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

  <title>Giocatori</title>

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
<body background='./img/Coppa-Italia-2019.jpg'>
  <!-- Header -->
  <header id='addGiocatore'>
    <!-- Background Image -->
    <div class='bg-img' style="background-image: url('./img/Coppa-Italia-2019.jpg');">
      <div class='overlay'></div>
    </div>
    <!-- /Background Image -->

    <!-- Nav -->
    <nav id='nav' class='navbar nav-transparent'>
      <div class='container'>

        <div class='navbar-header'>
          <!-- Collapse nav button -->
          <div class='nav-collapse'>
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
  <center> <h2 style="color:white">Giocatori</h2> </center>
  <?php
    if(isset($message))
      echo "<div class='message' role='status'>".$message."</div>";
  ?>
  "<div class='limiter'>
    <div class='container-table100'>
      <div class='wrap-table100'>
        <div class='table100'>
          <table class='coolTable'>
            <thead>
              <tr class='table100-head'>
                <th> TESSERA </th>
                <th> SQUADRA </th>
                <th> NUMERO MAGLIA </th>
                <th> NOME </th>
                <th> COGNOME </th>
                <th> RUOLO </th>
                <th> NAZIONALITA' </th>
                </tr>
            </thead>
            <tbody>
  <?php 
  while($riga = $sqlresult->fetch_assoc())
  {
    echo
    "<tr>
      <td> ".$riga['Tessera']." </td>
      <td> ".$riga['Nome_squadra']." </td>
      <td> ".$riga['Numero_maglia']." </td>
      <td> ".$riga['Nome']." </td>
      <td> ".$riga['Cognome']." </td>
      <td> ".$riga['Ruolo']." </td>
      <td> ".$riga['Nazionalita']." </td>
      <td> <form action='ServerSQL.php' method='POST'> <input type='hidden' name='codPlayer' value='".$riga['Tessera']."'/> <input type='submit' onclick='return ConfirmDelete();' name='btnDelPlayer' value='Elimina'/></form></td>
    </tr>";
  }
  echo 
  "         </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>";
  
  echo "
  <script>
    function ConfirmDelete()
    {
      var x = confirm('Eliminare Il giocatore?');
      if (x)
          return true;
      else
        return false;
    }
  </script> ";
  exit;

  mysqli_close($conn);
?>