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

 
// $sql = "SELECT ID, Tipo_utente, Accesso_utente FROM Utenti";
// $sqlresult = @$conn->query($sql);
// while($riga = $sqlresult->fetch_assoc()) {
// 	if($riga["Tipo_utente"] == "User"){
// 		$myverfile = fopen($riga["ID"]."_DateUsers.txt", "r") or die("Unable to open file!");
// 		$verificate = file_get_contents($riga["ID"]."_DateUsers.txt");
// 		fclose($myverfile);
// 		if($riga["Accesso_utente"] == $verificate){
session_start();
if (isset($_SESSION['ID'])) {
	$img = $_POST['textarea'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	$datenow = date("H:i:s");
	$fileName = "./Face_recog/known_people/".$_SESSION["ID"]."_".$datenow."_User.png";

	file_put_contents($fileName, $fileData);
}
// 		}
// 	}
// }

//while($riga = $sqlresult->fetch_assoc())
	//{
	// if($riga["Tipo_utente"] == "Admin" && $riga["ID"] == $verificate){
	// 	$img = $_POST['textarea'];
	// 	$img = str_replace('data:image/png;base64,', '', $img);
	// 	$img = str_replace(' ', '+', $img);
	// 	$fileData = base64_decode($img);
	// 	$fileName = "./Face_recog/known_people/1_Admin.png";
		
	// 	file_put_contents($fileName, $fileData);
	// }
	// if($riga["ID"] == $verificate && $riga["Utente_attivo"] == 'Si'){
	// 	$img = $_POST['textarea'];
	// 	$img = str_replace('data:image/png;base64,', '', $img);
	// 	$img = str_replace(' ', '+', $img);
	// 	$fileData = base64_decode($img);
	// 	$fileName = "./Face_recog/known_people/".$verificate."_User.png";
	// }
		
//}

mysqli_close($conn);

?>