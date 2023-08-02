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


 
$sql = "SELECT ID, Utente_attivo, Tipo_utente FROM Utenti";
$sqlresult = @$conn->query($sql);
$myverfile = fopen("./DateUsers.txt", "r") or die("Unable to open file!");
$verificate = file_get_contents("./DateUsers.txt");
$arr1 = str_split($verificate);
fclose($myverfile);

while($riga = $sqlresult->fetch_assoc()) {
     $dir = "./Face_recog/known_people/";
     $finalString = sprintf("%s %s %s", $arr1[0], "_", $_FILES['Upload']['name']);
     $filename = $dir.basename($finalString);

     echo "<br><br>";

     if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
      $resCode = 21;
     }
}

header("Location: Utente.php?resCode=".$resCode);	

mysqli_close($conn);

?>