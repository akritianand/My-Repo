<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $station = $_SESSION['dstation'];

    $sql = "SELECT station_line, station_section FROM Station WHERE station_name = '$station'";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    $sec = $row['station_section'];
    $line = $row['station_line'];

    $sql = "SELECT emp_firstname, emp_lastname FROM Employee WHERE emp_section = '$sec' AND emp_line = $line AND emp_designation = 'MS' AND emp_attendance IS NOT NULL AND emp_status = 'Available'";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()){
    		echo "<option>".$row['emp_firstname']." ".$row['emp_lastname']."</option>";
    	}
    }

    $link->close();
?>