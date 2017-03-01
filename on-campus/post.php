<?php
	session_start();
	
if(isset($_SESSION['user'])){
    $text = $_POST['text'];
    echo $text;
     
    $fp = fopen("pass/log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['user']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}

session_destroy();
?>



