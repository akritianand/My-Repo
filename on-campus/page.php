<?php
	session_start();
	
	$cookie_name = "true";
	$cookie_value = $_SESSION['user'];
	setcookie($cookie_name, $cookie_value, "/");
	$_COOKIE[$cookie_name] = $cookie_value;

	if(!(isset($cookie_value))) {
	header('Location: index.php'); exit();
	}
?>

	
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/chat.css">
	<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
</head>
<body>
	<div class="col-lg-3 pull-right">
		<a href="/media/akriti/01D2586233080A90/Music/Where Have You Been(cover).mp3" target="_blank" download>Download </a>
	</div>

	<div id="wrapper">
    <div id="menu">
    	<?php
    		if (isset($cookie_name))
    			echo "<p>Welcome, " . $cookie_value . "</p>";
    	?>
    </div>
     
    <div id="chatbox"> <?php
    	$timestamp = strtotime("now");

    	if(file_exists("pass/log.html") && filesize("/var/www/html/pass/log.html") >0) {
    	$handle = fopen("pass/log.html", "r");
    	$contents = fread($handle, filesize("/var/www/html/pass/log.html"));
    	fclose();

    	echo $contents;
		}
    ?>
    </div>

	<form name="message" action="" method="post" onsubmit="return false">
		<input type="text" id="usermsg" name="usermsg">
		<input type="submit" id="submitmsg" name="submit" value=">">
	</form>
	</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript">
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});

	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight");

		$.ajax({
			url: "pass/log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div
				var newscrollHeight = $("#chatbox").attr("scrollHeight");
				if (newscrollHeight > oldscrollHeight)
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div				
		  	},
		});
	}

	setInterval (loadLog, 250);

		<?php
		if (!isset($_COOKIE['true'])) {
			$del = fopen("pass/log.html", "a");
			fwrite($del, $_SESSION['user'] );
			fclose($del);
		}
		?>

</script>

</body>
</html>
