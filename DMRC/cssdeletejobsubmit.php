<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $ticketid = $_SESSION['dticketid'];

    $sql = "DELETE FROM Ticket WHERE ticket_id = $ticketid";
    
    if($link->query($sql) == TRUE) {
    	$link->close();
    	header("Location: cssdashboard.php");
    	die();
    }
    else {
    	$link->close();
    	header("Location: cssjobdetails.php");
    	die();
    }
?>