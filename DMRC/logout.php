<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

	if (isset($_POST['offduty']) ) {
		$empid = $_SESSION['empid'];
		echo $empid;
		$sql = "UPDATE Employee SET emp_line = NULL, emp_section = NULL, emp_attendance = NULL, emp_ms_tally = 0, emp_status = 'Busy' WHERE emp_id = $empid";
		$link->query($sql);
		$link->close();
		header("Location: mainmsdashboard.php");
    	die();
	}

	session_unset();
	session_destroy();
	$link->close();
	header("Location: index.php");
    die();
?>
