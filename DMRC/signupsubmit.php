<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $empid = $_POST['uid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $empemail = $_POST['empemail'];
    $emptype = $_POST['emptype'];
    $empdpt = $_POST['empdpt'];
    $rto = $_POST['rto'];
    $emppassword = sha1($_POST['psw']);
    $empdesg = $_POST['desg'];
    $empphone = $_POST['phone'];

   $sql = "INSERT INTO Employee (emp_id, reports_to, password, emp_firstname, emp_lastname, emp_email, emp_phone, emp_department, emp_designation, emp_type) VALUES ($empid, $rto, '$emppassword', '$fname', '$lname', '$empemail', $empphone, '$empdpt', '$empdesg', '$emptype')";

   if ($emptype == 'Operations') {
        if ($link->query($sql) == TRUE) {
                $link->close();
                header("Location: index.php");
                    die();
        } 
        else {
            $_SESSION["user"] = 0;
                $link->close();
                header("Location: signup.php");
                die();
        }
    }

    elseif ($emptype == 'CSS') {
        if ($empdesg == 'AM') {
           if ($link->query($sql) == TRUE) {
                $link->close();
                header("Location: index.php");
                    die();
            }
        }
        
        elseif ($empdesg == 'DGM' || $empdesg == 'AGM') {
            if ($link->query($sql) == TRUE) {
                $link->close();
                header("Location: index.php");
                    die();
            }
        }
        
        elseif ($empdesg == 'GM') {
            if ($link->query($sql) == TRUE) {
                $link->close();
                header("Location: index.php");
                    die();
            }
        }
                
        else {
            if ($link->query($sql) == TRUE) {
                   $link->close();
                   header("Location: index.php");
                    die();
           } 
           else {
               $_SESSION["user"] = 0;
                    $link->close();
                    header("Location: signup.php");
                    die();
           }
        }
    }

    elseif ($emptype == 'Maintenance') {
        if ($empdesg == 'MS') {
            if ($link->query($sql) == TRUE) {
                    $link->close();
                    header("Location: index.php");
                    die();
            } 
            else {
                $_SESSION["user"] = 0;
                    $link->close();
                    header("Location: signup.php");
                    die();
            }
        }
        else {
            if ($link->query($sql) == TRUE) {
                    $link->close();
                    header("Location: index.php");
                    die();
            } 
            else {
                $_SESSION["user"] = 0;
                    $link->close();
                    header("Location: signup.php");
                    die();
            }
        }   
     } 
?>
