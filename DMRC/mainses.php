<?php
    session_start();

        $_SESSION['empline'] = $_POST['line'];
        $_SESSION['empsec'] = $_POST['sec'];
        $line = (int)$_SESSION['empline'];
    	$sec = $_SESSION['empsec'];
    	$empid = $_SESSION['empid'];

        $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $sql = "UPDATE Employee SET emp_line = $line, emp_section = '$sec', emp_attendance = curtime(), emp_status = 'Available' WHERE emp_id = $empid";

    if ($link->query($sql) == TRUE) {
        echo "<div style='color: white; font-size:1.1em;' id='details'><h4 style='margin-top: 0px; font-size: 1.2em;'><b>".$_SESSION["fname"] . " " .$_SESSION["lname"]. "</b></h4><a style='font-size:1em; color: white;'>".$_SESSION['empdesg']."</a><br><a style='font-size:1em; color: white;'>Line: ".$_SESSION['empline']."".$_SESSION['empsec']."</a></div>";
       }
    else {
        echo mysqli_error($link);
    }

    $link->close();
?>