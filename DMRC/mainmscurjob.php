<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $msid = $_SESSION['empid'];

    $sql = "SELECT * FROM Ticket, Station, Module, System, Equipments, Employee WHERE Ticket.ticket_allotted = $msid AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Employee.emp_id";

    $result = $link->query($sql);

            if ($result->num_rows > 0 ) {
                $row = $result->fetch_assoc();
                echo "<tr><td>".$row['ticket_id']."</td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr>".$row['subequip_name']."</tr></table></td><td>".$row['station_name']."</td><td><table><tr><td>".$row['emp_firstname']." ".$row['emp_lastname']." (".$row['emp_id'].")</td></tr><td>".$row['ticket_open_datetime']."</td></tr></table></td></tr>";
                $_SESSION['equipid'] = $row['equip_id'];
                $_SESSION['ticketid'] = $row['ticket_id'];
            }
    $link->close();
?>