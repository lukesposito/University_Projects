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


		// PREMUTO BOTTONE ACCESSO/LOGIN
		if (isset($_POST['Login'])) {
			$email_usr = $_POST["Email"];
			$pass_usr = $_POST["Password_utente"];
			$type_usr = "User";
			$active_usr = "Si";
			
			$existSql = "SELECT ID FROM Utenti WHERE Email='".$email_usr."' AND Password_utente='".$pass_usr."'";
			$existResult = @$conn->query($existSql);
			$exist = $existResult->fetch_assoc();
			if(!$exist)
			{
				$resCode = 1;
				header("Location: Index.php?resCode=".$resCode);
				exit;
			}
			else{
				$existSql = "SELECT Tipo_utente FROM Utenti WHERE Tipo_utente='".$type_usr."' AND Email='".$email_usr."' AND Password_utente='".$pass_usr."'";
				$existResult = @$conn->query($existSql);
				$exist = $existResult->fetch_assoc();
				
				if($exist){
					$existSql = "SELECT Utente_attivo FROM Utenti WHERE Utente_attivo='".$active_usr."' AND Tipo_utente='".$type_usr."' AND Email='".$email_usr."' AND Password_utente='".$pass_usr."'";
					$existResult = @$conn->query($existSql);
					$exist = $existResult->fetch_assoc();
					
					if($exist){
						$resCode = 4;
						$existSql = "SELECT ID, Nome, Cognome FROM Utenti WHERE Utente_attivo='".$active_usr."' AND Tipo_utente='".$type_usr."' AND Email='".$email_usr."' AND Password_utente='".$pass_usr."'";
						$existResult = @$conn->query($existSql);
						$exist = $existResult->fetch_assoc();
						if($exist){
							session_start();
							$_SESSION['ID'] = $exist['ID'];;
							$_SESSION['Nome'] = $exist['Nome'];
							$_SESSION['Cognome'] = $exist['Cognome'];
							header("Location: Utente.php");
							exit;	
						}
						// $text = "DateUsers";
						// $DateUsers = fopen($text.".txt", "w") or die("Unable to open file!");
						// fwrite($DateUsers, $exist["ID"]);
						// fclose($DateUsers);
						// header("Location: Utente.php?resCode=".$resCode);
						// exit;
					}
					else {
						$resCode = 2;
						header("Location: Index.php?resCode=".$resCode);
						exit;
					}
						
				}	
				else{
					// $resCode = 4;
					// $text = "DateUsers";
					// $DateUsers = fopen($text.".txt", "w") or die("Unable to open file!");
					// fwrite($DateUsers, "1");
					// fclose($DateUsers);
					$type_usr = "Admin";
					$existSql = "SELECT ID, Nome, Cognome FROM Utenti WHERE Tipo_utente='".$type_usr."'";
					$existResult = @$conn->query($existSql);
					$exist = $existResult->fetch_assoc();
					session_start();
					$_SESSION['ID'] = $exist['ID'];;
					$_SESSION['Nome'] = $exist['Nome'];
					$_SESSION['Cognome'] = $exist['Cognome'];
					header("Location: Admin.php");
					exit;	
				}
			}
				
		}



		// PREMUTO BOTTONE NUOVO UTENTE
		if (isset($_POST['btnAddUsr'])) {
			$name_usr = $_POST["Nome"];
			$surname_usr = $_POST["Cognome"];
			$birth_usr = $_POST["Data_di_nascita"];
			$email_usr = $_POST["Email"];
			$pass_usr = $_POST["Password_utente"];
			$type_usr = $_POST["Tipo_utente"];
			$active_usr = "Si";
			$changeDate = date("Y-m-d", strtotime($birth_usr));
			$access_usr = date("H:i:s");
			
			$insertSql = "INSERT INTO Utenti (Nome, Cognome, Data_di_nascita, Email, Password_utente, Tipo_utente, Utente_attivo, Accesso_utente)
			VALUES ('".$name_usr."', '".$surname_usr."', '".$changeDate."', '".$email_usr."', '".$pass_usr."', '".$type_usr."', '".$active_usr."', '".$access_usr."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT ID, Email FROM Utenti WHERE Nome= '".$name_usr."' AND Cognome='".$surname_usr."' AND Data_di_nascita='".$changeDate."' AND Email='".$email_usr."' AND Password_utente='".$pass_usr."' AND Tipo_utente='".$type_usr."'";
			$existResult = @$conn->query($existSql);
			$exist = $existResult->fetch_assoc();
			if(!$exist)
			{
				if ($conn->query($insertSql) === TRUE) {
					$resCode = 0; //"New record created successfully";
					
				} else {
					$resCode = 2;
					echo "Error: " . $insertSql . "<br>" . $conn->error;
				}
			}
			else
			{
				$resCode = 1;
				echo "Error: " . $existSql . "<br>" . $conn->error;
			}
			
			header("Location: Admin.php?resCode=".$resCode);		
					
			exit;
		}

		// PREMUTO BOTTONE DISABILITA UTENTE
		if (isset($_POST['btnDisUsr'])) {
			$codUsr = $_POST["codUsr"];
			$codUsrSplitted = explode("/", $codUsr);
			
			$disUsrSql = "UPDATE Utenti SET Utente_attivo = 'No' 
				WHERE Utenti.Email='".$codUsrSplitted[0]."'
				AND Utenti.ID='".$codUsrSplitted[1]."'";
			echo $disUsrSql;
			
			if ($conn->query($disUsrSql) === TRUE)
			{
				$resCode = 10;
			}
			header("Location: Admin.php?resCode=".$resCode);		
        
			exit;
		}

		// PREMUTO BOTTONE ABILITA UTENTE
		if (isset($_POST['btnActUsr'])) {
			$codUsr = $_POST["codUsr"];
			$codUsrSplitted = explode("/", $codUsr);
			
			$actUsrSql = "UPDATE Utenti SET Utente_attivo = 'Si' 
				WHERE Utenti.Email='".$codUsrSplitted[0]."'
				AND Utenti.ID='".$codUsrSplitted[1]."'";
			echo $actUsrSql;
			
			if ($conn->query($actUsrSql) === TRUE)
			{
				$resCode = 11; 
			}
			header("Location: Admin.php?resCode=".$resCode);		
        
			exit;
		}



		// PREMUTO BOTTONE VERIFICA UTENTE
		// if (isset($_POST['btnVerUsr'])) {
		// 	$codUsr = $_POST["actUsr"];
		// 	$codUsrSplitted = explode("/", $codUsr);
		// 	$actUsr = "Si";
			
		// 	$actUsrSql = "SELECT Utente_attivo 
		// 	    WHERE Utenti.Email='".$codUsrSplitted[0]."'
		// 		AND Utenti.ID='".$codUsrSplitted[1]."'";
		// 	echo $actUsrSql;
			
		// 	if ($conn->query($actUsrSql) === $actUsr)
		// 	{
		// 		$dir = "./Face_recog/known_people/";
		// 		$filename = $dir.basename($_FILES['Upload']['name']);

		// 		echo "<br><br>";

		// 		if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename) ) { 
		// 			$resCode = 21;
		// 			//echo "<p>The HTML5 and php file upload was a success! -->".$_FILES['Upload']['name']; 
		// 		} else { 
		// 			$resCode = 22;
		// 			//echo "The php and HTML5 file upload failed.".$_FILES['Upload']['name']; 
		// 		} 
		// 	}
		// 	else{
		// 		$resCode = 20;
		// 	}
		// 	header("Location: Admin.php?resCode=".$resCode);		
        
		// 	exit;
		// }

		//INSERT INTO Utenti (Nome, Cognome, Data_di_nascita, Email, Password, Tipo_utente, ID) VALUES ('Luca', 'Esposito', '1997-11-26', 'luca.2611.le@gmail.com', 'ilmitico2697', 'Admin', 1);
		
	mysqli_close($conn);
?>