<?php
    session_start();

    $line = (int)$_SESSION['line'];
    $sec = $_SESSION['sec'];

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $msid = $_SESSION['empid'];

    $sql = "SELECT ticket_id FROM Ticket WHERE ticket_allotted = $msid AND (ticket_open_close = 'Open' OR ticket_open_close = 'Pending')";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    $ticketid = $row['ticket_id'];

    $sql = "SELECT emp_notif FROM Employee WHERE emp_id = $msid";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
       $res = $result->fetch_assoc();
       echo $ticketid; echo $res['emp_notif'];
       if (isset($ticketid) && ($res['emp_notif'] != $ticketid)) {

       	$_SESSION['ticketid'] = $ticketid;
       	
       		$sql = "SELECT * FROM Ticket, Station, Equipments, Employee, System WHERE ticket_id = '$ticketid' AND Ticket.ticket_station_id = Station.station_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Employee.emp_id AND System.system_id = Ticket.ticket_system_id";
       		$result = $link->query($sql);

            if ($result->num_rows > 0 ) {
                $row = $result->fetch_assoc();
                echo "<tr><td>".$row['ticket_id']."</td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr>".$row['subequip_name']."</tr></table></td><td>".$row['station_name']."</td><td><table><tr><td>".$row['emp_firstname']." ".$row['emp_lastname']." (".$row['emp_id'].")</td></tr><td>".$row['ticket_open_datetime']."</td></tr></table></td></tr>";

                $sql1 = "UPDATE Employee SET emp_notif = $ticketid WHERE emp_id = $msid";
                if ($link->query($sql1) == TRUE) {
                    echo "inserted";
                   }
                else {
                    echo mysqli_error($link);
                }
            }
            else {
                echo "error";
            }
       }
   }

    $link->close();
?>