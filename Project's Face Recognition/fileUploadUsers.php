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
     $dir = "./Face_recog/known_people/";
     $finalString = sprintf("%s %s %s", $_SESSION["ID"], "_", $_FILES['Upload']['name']);
     $filename = $dir.basename($finalString);

     echo "<br><br>";

     if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
          // echo "<script type='text/javascript'>alert('Trasferimento avvenuto con successo!'); window.location.assign('Index.php')</script>";
          $resCode = 21;
     }
}

     
     

     // $sql = "SELECT ID, Utente_attivo, Tipo_utente, Accesso_utente FROM Utenti";
     // $sqlresult = @$conn->query($sql);
     // while($riga = $sqlresult->fetch_assoc()) {
     //      if($riga["Tipo_utente"] == "User"){
     // 		$myverfile = fopen($riga["ID"]."_DateUsers.txt", "r") or die("Unable to open file!");
     // 		$verificate = file_get_contents($riga["ID"]."_DateUsers.txt");
     // 		fclose($myverfile);
     // 		if($riga["Accesso_utente"] == $verificate){
     //                $dir = "./Face_recog/known_people/";
     //                $finalString = sprintf("%s %s %s", $riga["ID"], "_", $_FILES['Upload']['name']);
     //                $filename = $dir.basename($finalString);

     //           echo "<br><br>";

     //           if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
     //                $resCode = 21;
     //           }
     //           }
     //      }
     // }

header("Location: Utente.php?resCode=".$resCode);	

mysqli_close($conn);

?>