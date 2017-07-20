<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $msid = $_SESSION['empid'];

    $sql = "SELECT distinct Ticket.ticket_id, System.system_name, Equipments.equip_name, Station.station_name, Ticket.ticket_open_datetime, Ticket.ticket_open_close, Ticket.ticket_close_datetime FROM Ticket, Employee, Equipments, System, Module, Station WHERE Ticket.ticket_close_empid = $msid AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Module.module_id = Ticket.ticket_module_id AND Station.station_id = Ticket.ticket_station_id ";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
        	echo "<tr><td>".$row['ticket_id']."</td><td>".$row['system_name']."</td><td>".$row['equip_name']."</td><td>".$row['station_name']."</td><td>".$row['ticket_open_datetime']."</td><td>".$row['ticket_open_close']."</td><td>".$row['ticket_close_datetime']."</td></tr>";
		}
	}

	$link->close();
?>