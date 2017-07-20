<?php
    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $sec = $_SESSION['empsec'];
    $line = $_SESSION['empline'];

    $sql = "SELECT emp_id, emp_firstname, emp_lastname, emp_attendance, emp_status FROM Employee WHERE emp_section = '$sec' AND emp_line = $line AND (emp_designation = 'MS' OR emp_designation = 'ASE' OR emp_designation = 'JE') AND emp_attendance IS NOT NULL";
    $result = $link->query($sql);

    if ($result->num_rows > 0) { 	    
    	while ($row = $result->fetch_assoc()) {
	    	echo "<tr><td>".$row['emp_id']."</td><td>".$row['emp_firstname']." ".$row['emp_lastname']."</td><td>".$row['emp_attendance']."</td><td>".$row['emp_status']."</td></tr>";
	    }
	}
	else {
		echo "<tr><td> - </td><td> - </td><td> - </td><td> - </td></tr>";
	}

	$link->close();
?>