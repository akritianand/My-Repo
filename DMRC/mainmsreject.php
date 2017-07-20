<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $reason = $_POST['reason'];
    $msid = $_SESSION['empid'];
    $ticketid = $_SESSION['ticketid'];

    echo $reason;
    echo $msid;
    echo $ticketid;

    $sql = "UPDATE Ticket, Employee SET Ticket.ticket_main_reject = CONCAT('empid:', $msid, ' Reason:', '$reason'), Ticket.ticket_allotted = NULL, Employee.emp_status = 'Available', Employee.emp_ms_tally = Employee.emp_ms_tally -1 WHERE ticket_id = $ticketid AND Employee.emp_id = $msid";
    $link->query($sql);

    $link->close();

    header("Location: mainmsdashboard.php");
    die();
?>