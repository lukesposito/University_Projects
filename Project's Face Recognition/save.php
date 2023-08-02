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

	$img = $_POST['textarea'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$fileData = base64_decode($img);
	$datenow = date("H:i:s");
	$fileName = "./Face_recog/random_photos/".$datenow."_screenshot.png";
	$usrrec = "Utente riconosciuto!";
	$usrnotrec = "Utente non riconosciuto...riprova";
	$error = "ERRORE";

	file_put_contents($fileName, $fileData);
	$file = "file";
	$myverfile = fopen($file.".txt", "w") or die("Unable to open file!");
	$myimagescreen = "".$datenow."_screenshot.png";
	fwrite($myverfile, $myimagescreen);
	fclose($myverfile);
	$user = "user";
	$myuserfile = fopen($user.".txt", "w") or die("Unable to open file!");
	fwrite($myuserfile, $user);
	fclose($myuserfile);

	$output = shell_exec("python3 /var/www/project/readimage.py 2>&1");
	$path = "./Face_recog/random_photos/".$myimagescreen."";
	unlink($path);
	#echo $output;
	#unlink("./Face_recog/random_photos/", "".$datenow."_screenshot.png" );
	$myuserfile = fopen("./user.txt", "r") or die("Unable to open file!");
	
	if($output == "Match: False\n"){
		fclose($myuserfile);
		echo $usrnotrec;
	}
	else if($output == "Match: True\n"){
		$compare = file_get_contents("./user.txt");
		$arr1 = str_split($compare);
		fclose($myuserfile);
		while($riga = $sqlresult->fetch_assoc())
		{
			if($riga["Tipo_utente"] == "Admin" && $riga["ID"] == $arr1[0]){
				echo "{$usrrec}\n{$compare}.png" ;
			}
			else if($riga["ID"] == $arr1[0] && $riga["Utente_attivo"] == 'Si'){
				echo "{$usrrec}\n{$compare}.png" ;
			}
			else if($riga["ID"] == $arr1[0] && $riga["Utente_attivo"] == 'No'){
				echo "Sei disabilitato! Impossibile accedere";
			}
		}
	}
	else{
		fclose($myuserfile);
		echo $output;
	}

	mysqli_close($conn);

//2>&1
//echo $?


 ?>