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


		// PREMUTO BOTTONE NUOVA SQUADRA
		if (isset($_POST['btnAddTeam'])) {
			$id_squadra = $_POST["id_squadra"];
			$name_sq = $_POST["name_sq"];
			$city = $_POST["city"];
			$coach = $_POST["coach"];
			$sponsor = $_POST["sponsor"];
			$colour = $_POST["colour"];
			
			$insertSql = "INSERT INTO Squadra (Id_squadra, Nome_sq, Citta, Allenatore, Sponsor, Colori_sociali)
			VALUES (".$id_squadra.", '".$name_sq."', '".$city."', '".$coach."', '".$sponsor."', '". $colour."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT Id_squadra FROM Squadra WHERE Nome_sq= '".$name_sq."' AND Citta='".$city."' AND Allenatore='".$coach."' AND Sponsor='".$sponsor."' AND Colori_sociali='".$colour."'";
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
			
			header("Location: Squadra.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA SQUADRA
		if (isset($_POST['btnDelTeam'])) {
			$codTeam = $_POST["codTeam"];
			$codTeamSplitted = explode("/", $codTeam);
			
			$delTeamSql = "DELETE FROM Squadra 
				WHERE Id_squadra= '".$codTeamSplitted[0]."'
				AND Nome_sq='".$codTeamSplitted[1]."'";
			echo $delTeamSql;
			
			if ($conn->query($delTeamSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Squadra.php?resCode=".$resCode);		
        
			exit;
		}


		// PREMUTO BOTTONE NUOVO GIOCATORE
		if (isset($_POST['btnAddPlayer'])) {
			$card = $_POST["card"];
			$name_team = $_POST["name_team"];
			$number_shirt = $_POST["number_shirt"];
			$name_g = $_POST["name_g"];
			$surname_g = $_POST["surname_g"];
			$role = $_POST["role"];
			$nationality = $_POST["nationality"];
			
			$insertSql = "INSERT INTO Giocatore (Tessera, Nome_squadra, Numero_maglia, Nome, Cognome, Ruolo, Nazionalita)
			VALUES (".$card.", '".$name_team."', '".$number_shirt."', '".$name_g."', '".$surname_g."', '".$role."', '".$nationality."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT Tessera FROM Giocatore WHERE Nome_squadra= '".$name_team."' AND Numero_maglia='".$number_shirt."' AND Nome='".$name_g."' AND Cognome='".$surname_g."' AND Ruolo='".$role."' AND Nazionalita='".$nationality."'";
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
			
			header("Location: Giocatore.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA GIOCATORE
		if (isset($_POST['btnDelPlayer'])) {
			$codPlayer = $_POST["codPlayer"];
			
			$delPlayerSql = "DELETE FROM Giocatore 
				WHERE Tessera=".$codPlayer."";
			echo $delPlayerSql;
			
			if ($conn->query($delPlayerSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Giocatore.php?resCode=".$resCode);		
        
			exit;
		}


		// PREMUTO BOTTONE NUOVO ARBITRO
		if (isset($_POST['btnAddReferee'])) {
			$id_arbitro = $_POST["id_arbitro"];
			$name_ar = $_POST["name_ar"];
			$number_presence = $_POST["number_presence"];
			
			$insertSql = "INSERT INTO Arbitro (Id_arbitro, Nome_ar, Num_presenze)
			VALUES (".$id_arbitro.", '".$name_ar."', '".$number_presence."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT Id_arbitro FROM Arbitro WHERE Nome_ar= '".$name_ar."' AND Num_presenze='".$number_presence."'";
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
			
			header("Location: Arbitro.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA ARBITRO
		if (isset($_POST['btnDelReferee'])) {
			$codReferee = $_POST["codReferee"];
			$codRefereeSplitted = explode("/", $codReferee);
			
			$delRefereeSql = "DELETE FROM Arbitro 
				WHERE Id_arbitro='".$codRefereeSplitted[0]."' AND Nome_ar= '".$codRefereeSplitted[1]."'";
			echo $delRefereeSql;
			
			if ($conn->query($delRefereeSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Arbitro.php?resCode=".$resCode);		
        
			exit;
		}


		// PREMUTO BOTTONE NUOVA PARTITA
		if (isset($_POST['btnAddGame'])) {
			$number_game = $_POST["number_game"];
			$name_shift = $_POST["name_shift"];
			$place = $_POST["place"];
			$date = $_POST["date"];
			$team_home = $_POST["team_home"];
			$team_away = $_POST["team_away"];
			$referee = $_POST["referee"];
			
			$insertSql = "INSERT INTO Partita (Num_partita, Nome_turno, Luogo, Data, Sq_casa, Sq_trasferta, Nome_a)
			VALUES (".$number_game.", '".$name_shift."', '".$place."', '".$date."', '".$team_home."', '".$team_away."', '".$referee."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT Num_partita FROM Partita WHERE Num_partita='".$number_game."' AND Nome_turno= '".$name_shift."' AND Luogo='".$place."' AND Data='".$date."' AND Sq_casa='".$team_home."' AND Sq_trasferta='".$team_away."' AND Nome_a='".$referee."'";
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
			
			header("Location: Partita.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA PARTITA
		if (isset($_POST['btnDelGame'])) {
			$codGame = $_POST["codGame"];
			$codGameSplitted = explode("/", $codGame);
			
			$delGameSql = "DELETE FROM Partita WHERE Num_partita= '".$codGameSplitted[0]."' AND Nome_turno='".$codGameSplitted[1]."'";
			echo $delGameSql;
			
			if ($conn->query($delGameSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Partita.php?resCode=".$resCode);		
        
			exit;
		}


		// PREMUTO BOTTONE NUOVO GOAL
		if (isset($_POST['btnAddGoal'])) {
			$number_game = $_POST["number_game"];
			$round = $_POST["round"];
			$minute = $_POST["minute"];
			$surname_g = $_POST["surname_g"];
			$name_g = $_POST["name_g"];
			$additional = $_POST["additional"];
			$penalty = $_POST["penalty"];
			
			$insertSql = "INSERT INTO Goal (Num_Partita, Nome_Turno, Minuto, Cognome_G, Nome_G, Supplementari, Rigore)
			VALUES (".$number_game.", '".$round."', '".$minute."', '".$surname_g."', '".$name_g."', '".$additional."', '".$penalty."')";
			//echo $insertSql."<br>";
			
			$goalSql = "SELECT Num_Partita, Minuto, Supplementari FROM Goal WHERE Nome_Turno='".$round."' AND Cognome_G='".$surname_g."' AND Nome_G='".$name_g."' AND Rigore='".$penalty."'";
			//echo $projSql;

			$goalResult = @$conn->query($goalSql);
			$colliding = false;
			$variabile_min = 90;
			if($minute < $variabile_min)
			{
				if($additional == "SI"){
					$colliding = true;
				}
			}
			if($minute > $variabile_min)
			{
				if($additional == "NO"){
					$colliding = true;
				}
			}
			$variabile_max = 125;
			if($minute > $variabile_min)
			{
				if($additional == "NO"){
					$colliding = true;
				}
				if($minute < $variabile_max)
				{
					if($additional == "NO"){
						$colliding = true;
					}
				}
			}
			if($minute > $variabile_max)
			{
				$colliding = true;
			}
			if(!$colliding){
					if ($conn->query($insertSql) === TRUE) 
					{
						$resCode = 0; //"New record created successfully";
						
					} else {
						$resCode = 2;
						echo "Error: " . $insertSql . "<br>" . $conn->error;
					}
				} else {
						$resCode = 3;
					}
			header("Location: Goal.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA GOAL
		if (isset($_POST['btnDelGoal'])) {
			$codGoal = $_POST["codGoal"];
			$codGoalSplitted = explode("/", $codGoal);
			
			$delGoalSql = "DELETE FROM Goal
				WHERE Num_partita= '".$codGoalSplitted[0]."' AND Nome_turno='".$codGoalSplitted[1]."' AND Minuto='".$codGoalSplitted[2]."'";
			echo $delGoalSql;
			
			if ($conn->query($delGoalSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Goal.php?resCode=".$resCode);		
        
			exit;
		}



		// PREMUTO BOTTONE NUOVA EDIZIONE
		if (isset($_POST['btnAddEdition'])) {
			$year_edition = $_POST["year_edition"];
			$winning_team = $_POST["winning_team"];
			
			$insertSql = "INSERT INTO Edizione_vinta (Anno_edizione, Sq_vincitrice)
			VALUES (".$year_edition.", '".$winning_team."')";
			echo $insertSql."<br>";
			
			$existSql = "SELECT Anno_edizione FROM Edizione_vinta WHERE Sq_vincitrice= '".$winning_team."' AND Anno_edizione= '".$year_edition."'";
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
			
			header("Location: Edvinte.php?resCode=".$resCode);		
					
			exit;
		}


		// PREMUTO BOTTONE ELIMINA EDIZIONE
		if (isset($_POST['btnDelEdition'])) {
			$codEdition = $_POST["codEdition"];
			
			$delEditionSql = "DELETE FROM Edizione_vinta 
				WHERE Anno_edizione=".$codEdition."";
			echo $delEditionSql;
			
			if ($conn->query($delEditionSql) === TRUE)
			{
				$resCode = 10; //"Record deleted successfully";
			}
			header("Location: Edvinte.php?resCode=".$resCode);		
        
			exit;
		}




	mysqli_close($conn);
?>