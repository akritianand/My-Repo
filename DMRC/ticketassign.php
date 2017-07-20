<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $stationid = $_SESSION['station'];

    $sql = "SELECT station_line, station_section FROM Station WHERE station_id = $stationid";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

    $section = $row['station_section'];
    $line = $row['station_line'];

    $sql = "SELECT t1.emp_id FROM Employee AS t1 WHERE emp_ms_tally = (SELECT min(t2.emp_ms_tally) FROM Employee AS t2 WHERE t2.emp_designation = 'MS' AND t2.emp_attendance IS NOT NULL AND t2.emp_section = '$section' AND t2.emp_line = $line AND t2.emp_status = 'Available') AND t1.emp_section = '$section' AND t1.emp_line = $line AND t1.emp_designation = 'MS' AND t1.emp_attendance IS NOT NULL AND t1.emp_status = 'Available' ORDER BY t1.emp_id DESC LIMIT 1";
    $result = $link->query($sql);

    if ($result->num_rows > 0) { 
	    $row = $result->fetch_assoc();
	    $msid = $row['emp_id'];
	}
    else {
        $msid = 0;
    }

    echo $msid;
    $ticketid = $_SESSION['ticketid'];
    echo $ticketid;

    $sql = "UPDATE Ticket SET ticket_allotted = $msid WHERE ticket_id = $ticketid";
    $link->query($sql);

    $sql = "UPDATE Employee SET emp_status = 'Busy', emp_ms_tally = emp_ms_tally +1 WHERE emp_id = $msid";
    $link->query($sql);

    $link->close();

    header("Location: opdashboard.php");
    die();
?>