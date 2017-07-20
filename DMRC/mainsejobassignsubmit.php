<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $ms = $_GET['ms'];

  	$sql = "SELECT emp_id FROM Employee WHERE CONCAT(emp_firstname, ' ', emp_lastname) LIKE '$ms'"; 
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

    $msid = $row['emp_id'];

    $ticketid = $_SESSION['dticketid'];

    $sql = "UPDATE Ticket SET ticket_allotted = $msid WHERE ticket_id = $ticketid";
    $link->query($sql);

    $sql = "UPDATE Employee SET emp_status = 'Busy', emp_ms_tally = emp_ms_tally +1 WHERE emp_id = $msid";
    $link->query($sql);

    $link->close();

    header("Location: mainsetrackjob.php");
    die();
?>