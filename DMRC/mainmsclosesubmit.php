<?php
	session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $module = strtoupper($_POST['module']);
    $description = $_POST['closedescription'];
    $closeid = $_SESSION['empid'];
    $closedatetime = date("Y-m-d H:i:s",time());
    $ticketid = $_SESSION['ticketid'];

    if (isset($ticketid)) {

        if (isset($_POST['other'])) {
            $other = $_POST['other'];
            $equipid = $_SESSION['equipid'];

            $sql = "INSERT INTO `Module`(`module_equip_id`, `module_name`) VALUES ($equipid, '$other')";
            $link->query($sql);

            $sql = "SELECT module_id FROM Module WHERE module_name = '$other'";
            $result = $link->query($sql);
            $row = $result->fetch_assoc();
            $moduleid = $row['module_id'];

            $sql = "SELECT ticket_open_datetime FROM Ticket WHERE ticket_id = $ticketid";
            $result = $link->query($sql);
            $row = $result->fetch_assoc();
            $opendatetime = $row['ticket_open_datetime'];

            if (isset($_POST['pending'])) {
                $sql = "UPDATE Ticket, Employee SET Ticket.ticket_module_id = $moduleid, Ticket.ticket_main_desc = '$description', Ticket.ticket_close_empid = $closeid, Ticket.ticket_close_datetime = '$closedatetime', Ticket.ticket_open_close = 'Pending', Ticket.ticket_duration = TIMEDIFF(Minute,'$closedatetime', '$opendatetime'), Employee.emp_status = 'Available', Ticket.ticket_allotted = 0 WHERE Ticket.ticket_id = $ticketid AND Employee.emp_id = $closeid";
                $link->query($sql);
            }

            else {
                $sql = "UPDATE Ticket, Employee SET Ticket.ticket_module_id = $moduleid, Ticket.ticket_main_desc = '$description', Ticket.ticket_close_empid = $closeid, Ticket.ticket_close_datetime = '$closedatetime', Ticket.ticket_open_close = 'Close', Ticket.ticket_duration = TIMEDIFF(Minute,'$closedatetime', '$opendatetime'), Employee.emp_status = 'Available' WHERE Ticket.ticket_id = $ticketid AND Employee.emp_id = $closeid";
                $link->query($sql);
            } 
        }

       else {
            $sql = "SELECT module_id FROM Module WHERE module_name = '$module'";
            $result = $link->query($sql);
            $row = $result->fetch_assoc();
            $moduleid = $row['module_id'];

            $sql = "SELECT ticket_open_datetime FROM Ticket WHERE ticket_id = $ticketid";
            $result = $link->query($sql);
            $row = $result->fetch_assoc();
            $opendatetime = $row['ticket_open_datetime'];

            if (isset($_POST['pending'])) {
                $sql = "UPDATE Ticket, Employee SET Ticket.ticket_module_id = $moduleid, Ticket.ticket_main_desc = '$description', Ticket.ticket_close_empid = $closeid, Ticket.ticket_close_datetime = '$closedatetime', Ticket.ticket_open_close = 'Pending', Ticket.ticket_duration = TIMEDIFF(Minute, '$closedatetime', '$opendatetime'), Employee.emp_status = 'Available', Ticket.ticket_allotted = 0 WHERE Ticket.ticket_id = $ticketid AND Employee.emp_id = $closeid";
                $link->query($sql);
            }

            else {
               $sql = "UPDATE Ticket, Employee SET Ticket.ticket_module_id = $moduleid, Ticket.ticket_main_desc = '$description', Ticket.ticket_close_empid = $closeid, Ticket.ticket_close_datetime = '$closedatetime', Ticket.ticket_open_close = 'Close', Ticket.ticket_duration = TIMEDIFF(Minute, '$closedatetime', '$opendatetime'), Employee.emp_status = 'Available' WHERE Ticket.ticket_id = $ticketid AND Employee.emp_id = $closeid";
                $link->query($sql); 
            }
        }

        unset($_SESSION['ticketid']);
        $link->close();
        header("Location: mainmsdashboard.php");
        die(); 
    }

    else {
        header("Location: mainmsjobdetails.php");
        die();
    }

?>