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

$sql = "SELECT ID, Utente_attivo, Tipo_utente, Nome, Cognome FROM Utenti";
$sqlresult = @$conn->query($sql);
while($riga = $sqlresult->fetch_assoc()) {
    $myverfile = fopen("./user.txt", "r") or die("Unable to open file!");
    $verificate = file_get_contents("./user.txt");
    $arr1 = str_split($verificate);
    fclose($myverfile);
    if($arr1[0] == $riga["ID"] && $riga["Tipo_utente"] == "Admin"){
        #$resCode = 3;
        session_start();
        $_SESSION['ID'] = $riga['ID'];
        $_SESSION['Nome'] = $riga['Nome'];
		$_SESSION['Cognome'] = $riga['Cognome'];
        header("Location: Admin.php");
        exit;	
    }else if($arr1[0] == $riga["ID"] && $riga["Utente_attivo"] == "Si" && $riga["Tipo_utente"] == "User"){
        #$resCode = 3;
        session_start();
        $_SESSION['ID'] = $riga['ID'];
        $_SESSION['Nome'] = $riga['Nome'];
		$_SESSION['Cognome'] = $riga['Cognome'];
        header("Location: Utente.php");
        exit;	
    }else if($arr1[0] == $riga["ID"] && $riga["Utente_attivo"] == "No" && $riga["Tipo_utente"] == "User"){
        header("Location: Index.php");
        exit;	
    }
}

header("Location: Index.php");	

#$arr1[0] >= "2" && $arr1[0] <= "9"
?>