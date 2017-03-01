<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8"> 
<title>Authentication</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
	<div class="signin text-center">
		<form action="file.php" method="POST">
			<div class="form">Username:
			<input type="text" name="username"></div>

			<div class="form">Password:
			<input type="password" name="password"></div>

			<input type="submit" value="Go">
		</form>
	</div>

<?php
	if (isset($_SESSION['flag']) && $_SESSION["flag"] === 1) {
		echo '<div class="text-center error-m">Invalid Login<div>';
		}

?>
</script> 
</body>
</html>
