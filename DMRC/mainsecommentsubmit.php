<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $comment = $_POST['comment'];
    $ticketid = $_SESSION['dticketid'];

    $sql = "UPDATE Ticket SET ticket_comment = '$comment' WHERE ticket_id = $ticketid";
    $link->query($sql);
    
    $link->close();
?>