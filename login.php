<?php

	//GET ja POSTI muutujad
	//var_dump($_POST);
	//echo "<br>";
	//var_dump ($_GET);
	
	$signupEmailError= "";
	
	//$_post["signupEmail"];
	
	if(isset($_POST["signupEmail"])) {
		
		//jah on olemas
		//kas on tühi
		if(empty($_POST["signupEmail"])) {
			
			$signupEmailError="See väli on kohustuslik";
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
	
		if(empty($_POST[repeatPassword] ) ) {
		
			$repeatPasswordError="see väli on kohustuslik";
		
		}else{
		
			if(($_POST[repeatPassword] ) !== ($_POST[signupPassword]) ) {
			
				$repeatPasswordError="Peate kirjutama täpselt sama parooli, mis eelmisesse lahtrisse!";
			
			}
		
		
		}
	
	}
 
 	$phonenoError= "";
	
	if(isset($_POST["phoneno"])) {
		
		if(empty($_POST["phoneno"])) {
 			
 			$phoneno="väli on kohustuslik";
 			
 		
 			}
 			
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
 		
 		<input name="signupEmail" type="text"> <?php echo $signupEmailError; ?>
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