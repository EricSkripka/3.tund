<?php

	require("../../config.php");

	//echo hash("sha512", "d");

	//GET ja POSTI muutujad
	//var_dump($_POST);
	//echo "<br>";
	//var_dump ($_GET);
	
	//MUUTUJAD
	$signupEmailError = "";
	$signupEmail = "";
	
	
	
	//$_post["signupEmail"];
	
	if(isset($_POST["signupEmail"])) {
		
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"])) {
			
			$signupEmailError="See väli on kohustuslik";
		} else {
			
			$signupEmail = $_POST["signupEmail"];
			
		}
	}
	
	$signupPasswordError= "";
	
	if(isset($_POST["signupPassword"])) {
		
		if(empty($_POST["signupPassword"])) {
 			
 			$signupPasswordError="Parool on kohustuslik";
 			
 		}else{
 			
 			//siia jõuan siis kui parool oli olemas -isset
 			//ja parool ei olnud tühi -empty
 			//kas parooli pikkus on väiksem kui 8
 			if(strlen($_POST["signupPassword"]) <8){
 				
				$signupPasswordError="Parool peab olema vähemalt 8 tähemärki pikk!";
 				
 			}
 			
 		}
 		
 		
 		
 	}
 
	$repeatPasswordError= "";
	
	if(isset($_POST["repeatPassword"] ) ) {
	
		if(empty($_POST["repeatPassword"] ) ) {
		
			$repeatPasswordError="see väli on kohustuslik";
		
		}else{
		
			if(($_POST["repeatPassword"] ) !== ($_POST["signupPassword"]) ) {
			
				$repeatPasswordError="Peate kirjutama täpselt sama parooli, mis eelmisesse lahtrisse!";
			
			}
		
		
		}
	
	}
 
 	$phonenoError= "";
	
	if(isset($_POST["phoneno"])) {
		
		if(empty($_POST["phoneno"])) {
 			
			$phonenoError="väli on kohustuslik";
 			
 		
		}
			
	}
	
    	// peab olema email ja parool
		// ühtegi errorit
		
	if ( isset($_POST["signupEmail"]) && 
		 isset($_POST["signupPassword"]) && 
		 $signupEmailError == "" && 
		 empty($signupPasswordError)
		) {
		
		// salvestame ab'i
		echo "Salvestan... <br>";
		
		echo "email: ".$signupEmail."<br>";
		echo "password: ".$_POST["signupPassword"]."<br>";
		
		$password = hash("sha512", $_POST["signupPassword"]);
		
		echo "password hashed: ".$password."<br>";
 
		//echo $serverUsername;
		
		// ÜHENDUS
		
		$database = "if16_eric_2";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		
		// meie serveris nagunii 
		if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
		}
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
		
		// stringina üks täht iga muutuja kohta (?), mis tüüp
		// string - s 
		// integer - i 
		// float (double) - d 
		// küsimärgid asendada muutujaga
		
		$stmt->bind_param("ss",$signupEmail, $password);
		
		echo $mysqli->error;
		
		//täida käsku
		if($stmt->execute()) {
			echo "salvesatamine õnnestus";
		} else {
			echo "ERROR".$stmt->error;
		}
			
		//panen ühenduse kinni	
			
		$stmt->close();
		$mysqli->close();

	}
?>
 
 
<!DOCTYPE html>
<html>
<head>
	<title>Logi sisse või loo kasutaja</title>
</head>
<body>
 
 	<h1>Logi sisse </h1>
 	<form method="POST">
 		<label>E-post</label>
 		<br>
 		
 		<input name="loginEmail" type="text">
 		<br><br>
 		
 		<input name="loginPassword" placeholder="parool" type="password">
 		<br><br>
 		
 		<input type="submit" value="Logi sisse">
 		
 	</form>
 	
 	
 	<h1>Loo kasutaja </h1>
 	<form method="POST">
 		<label>E-post</label>
 		<br>
 		
 		<input name="signupEmail" type="text" value="<?=$signupEmail;?>"> <?php echo $signupEmailError; ?>
		<br><br>
		
		<input name="signupPassword" placeholder="parool" type="password"> <?php echo $signupPasswordError; ?>
		<br><br>
		
		<input name="repeatPassword" placeholder="korda parool" type="password"> <?php echo $repeatPasswordError; ?>
		<br><br>
		
		<input name="phoneno" placeholder="telefoninumber" type="text"> <?php echo $phonenoError; ?>
		<br><br>
		
		<input type="submit" value="Loo kasutaja">
		
	</form>
	
	
</body>
</html> 