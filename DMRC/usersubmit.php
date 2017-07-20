<?php
	session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $empid = $_SESSION['empid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phno = $_POST['phno'];
    $type = $_POST['type'];
    $dept = $_POST['department'];
    $desg = $_POST['designation'];

    $sql = "UPDATE Employee SET emp_firstname = '$fname', emp_lastname = '$lname', emp_email = '$email', emp_phone = $phno, emp_type = '$type', emp_department = '$dept', emp_designation = '$desg' WHERE emp_id = $empid";
    $link->query($sql);

    $link->close();
?>