<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $employeeid = $_POST['uid'];
    $password = sha1($_POST['psw']);

    $sql = "SELECT * FROM Employee WHERE emp_id = '$employeeid' AND password = '$password'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){

            $_SESSION['empdesg'] = $row['emp_designation'];
            $_SESSION["fname"] = $row['emp_firstname'];
            $_SESSION["lname"] = $row['emp_lastname'];
            $_SESSION['empid'] = $row['emp_id'];
            $_SESSION['empline'] = $row['emp_line'];
            $_SESSION['empsec']= $row['emp_section'];

            $dept = $row['emp_type'];
            $_SESSION ['emptype'] = $dept;
            $desg = $row['emp_designation'];
            $_SESSION['empdesg'] = $desg;
            $link->close();
            echo $desg;

            if ($dept == 'Operations') {
            header("Location: opdashboard.php");
            die();
            }

            elseif ($dept == 'CSS') {
                if ($desg == 'AM') {
                    header("Location: amdashboard.php");
                    die();
                }
                elseif ($desg == 'DGM' || $desg == 'AGM') {
                    header("Location: highdashboard.php");
                    die();
                }
                elseif ($desg == 'GM') {
                    header("Location: high1dashboard.php");
                    die();
                }
                else {
                    header("Location: cssdashboard.php");
                    die();
                }
            }

            elseif ($dept == 'Maintenance') {
                if ($desg == 'SE' || $desg == 'ASE' || $desg == 'LI' || $desg == 'JE') {
                    header("Location: mainsedashboard.php");
                    die();
                }
                elseif ($desg == 'MS') {
                    header("Location: mainmsdashboard.php");
                    die();
                }    
            }
        }
    }

    else {
        $_SESSION["flag"] = 0;
        $link->close();
        header("Location: index.php");
        die();
  } 
?>
