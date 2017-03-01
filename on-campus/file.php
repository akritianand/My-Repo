<?php
	ini_set('display_errors', 1); error_reporting(-1);
	session_start();
?>


	  <?php 
		 $name  = $_POST['username'];
		 $pass  = $_POST['password']; 

	   //read the contents of our password file.
		 $myFile = "pass/password.txt";
		 $data = explode(PHP_EOL, file_get_contents("pass/password.txt"));
		 
		 $auth = 0;
	 
		 foreach ($data as $line) {
		 	
		 //split the text into an array
		 $text = explode(":", $line);

		 //assign the data to variables
		 $good_name = $text[0];
		 $good_pass = $text[1];

		 if($name === $good_name && $pass === $good_pass) {
		 	$auth = 1;
		 	break;
		 }
		}

		 //compare the strings
		 if($auth){
		 	$_SESSION["user"] = $good_name;
		 	$cookie_name = "user";
		 	$cookie_value = $good_name;
		 	setcookie($cookie_name, $cookie_value, "/");
			header('Location: page.php'); exit ();
		 }else{
		 	$_SESSION["flag"] = 1;
			header('Location: index.php'); exit();
		 }

	?>	