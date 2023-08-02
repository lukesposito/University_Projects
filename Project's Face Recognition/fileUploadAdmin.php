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

if (isset($_POST['btnVerUsr'])) {
  $codUsr = $_POST["actUsr"];
  $codUsrSplitted = explode("/", $codUsr);
  $actUsr = "Si";
  
  
  $sql = "SELECT ID, Utente_attivo, Tipo_utente FROM Utenti WHERE Utenti.Email='".$codUsrSplitted[0]."' AND Utenti.ID='".$codUsrSplitted[1]."'";
  $sqlresult = @$conn->query($sql);
  while($riga = $sqlresult->fetch_assoc()) {
      
    $dir = "./Face_recog/known_people/";
    $finalString = sprintf("%s %s %s", $codUsrSplitted[1], "_", $_FILES['Upload']['name']);
    $filename = $dir.basename($finalString);
    
    echo "<br><br>";
    
    if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
      $resCode = 21;
    }
    else {
      $resCode = 22;
    }
  }
  header("Location: Admin.php?resCode=".$resCode);		
    
  exit;
}


 
// $sql = "SELECT ID, Utente_attivo, Tipo_utente FROM Utenti";
// $sqlresult = @$conn->query($sql);
// $myverfile = fopen("./DateUsers.txt", "r") or die("Unable to open file!");
// $verificate = file_get_contents("./DateUsers.txt");
// $arr1 = str_split($verificate);
// fclose($myverfile);

// while($riga = $sqlresult->fetch_assoc()) {
// 	if($riga["Tipo_utente"] == "Admin" && $riga["ID"] == $arr1[0]){
// 		$dir = "./Face_recog/known_people/";
//     $finalString = sprintf("%s %s %s", $arr1[0], "_", $_FILES['Upload']['name']);
//     $filename = $dir.basename($finalString);

//     echo "<br><br>";

//     if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
//       echo "<script type='text/javascript'>alert('Perfetto! Foto caricata correttamente!'); window.location.assign('Admin.php')</script>";
//     } else { 
//       echo "<script type='text/javascript'>alert('Errore, impossibile caricare la foto!'); window.location.assign('Admin.php')</script>"; 
//     } 
// 	}
// 	else if($riga["ID"] == $arr1[0] && $riga["Tipo_utente"] == "User" && $riga["Utente_attivo"] == 'Si'){
//       $dir = "./Face_recog/known_people/";
//       $finalString = sprintf("%s %s %s", $arr1[0], "_", $_FILES['Upload']['name']);
//       $filename = $dir.basename($finalString);
  
//       echo "<br><br>";
  
//       if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
//         echo "<script type='text/javascript'>alert('Perfetto! Foto caricata correttamente!'); window.location.assign('Utente.php')</script>";
//       } else { 
//         echo "<script type='text/javascript'>alert('Errore, impossibile caricare la foto!'); window.location.assign('Utente.php')</script>"; 
//       } 
//   }
// }

mysqli_close($conn);

?>