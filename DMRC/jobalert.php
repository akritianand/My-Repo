<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

	switch ($_GET['type']) {
		case 'main':
			$sec = $_SESSION['empsec'];
			$line = $_SESSION['empline'];
			$empid = $_SESSION['empid'];

			$sql = "SELECT ticket_allotted FROM Ticket WHERE TIMESTAMPDIFF(Minute, ticket_open_datetime, NOW()) > 30 AND (ticket_open_close = 'Open' OR ticket_open_close = 'Pending')";
			$res = $link->query($sql);

			if ($res->num_rows > 0) {
	            while($rows = $res->fetch_assoc()){
					if ($rows['ticket_allotted'] == NULL) {
						$sql4 = "SELECT distinct Ticket.ticket_id, System.system_name, timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Station.station_name, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, 'NULL' AS allfname, '' AS alllname , '' AS e3 
							FROM Ticket, Station, Module, System, Equipments, Employee as Emp1, Employee AS Emp2
							 WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 30 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted IS NULL AND Emp1.emp_id = Ticket.ticket_open_empid AND Emp2.emp_section = '$sec' AND Emp2.emp_line = $line AND Emp2.emp_id = $empid order by duration desc";
		            }
		            else {
		            	$sql1 = "SELECT distinct Ticket.ticket_id, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid,timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
		            		FROM Ticket, Station, System, Equipments, Employee as Emp3, Employee as Emp1, Employee AS Emp2 
		            		WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 30 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending')  AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Emp1.emp_id = Ticket.ticket_open_empid AND Ticket.ticket_allotted = Emp3.emp_id AND Emp2.emp_section = '$sec' AND Emp2.emp_line = $line AND Emp2.emp_id = $empid order by duration desc";
		            }
		            $result = $link->query($sql4);
		          
		            $result1 = $link->query($sql1);
	            }
	        echo"<thead><th style = 'width: 150px;'>Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Allotted To</th><th>Station</th><th>Status</th><th>Ticket duration</th></thead>";
				if ($result->num_rows > 0) {
			        while($row = $result->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			   
			        	echo "<tr><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>"; 
			        }
			    }

			    if ($result1->num_rows > 0) {
	            	
			        while($row = $result1->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }
            }
        	break; 

        case 'AM':
        	$sql = "SELECT ticket_allotted FROM Ticket WHERE TIMESTAMPDIFF(Minute, ticket_open_datetime, NOW()) > 45 AND (ticket_open_close = 'Open' OR ticket_open_close = 'Pending')";
			$res = $link->query($sql);

			if ($res->num_rows > 0) {
	            while($rows = $res->fetch_assoc()){
					if ($rows['ticket_allotted'] == NULL) {
						$sql = "SELECT distinct Ticket.ticket_id, System.system_name, timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Station.station_name, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
							FROM Ticket, Station, Module, System, Equipments, Employee AS Emp1 
							WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 45 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted IS NULL AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            else {
		            	$sql1 = "SELECT distinct Ticket.ticket_id, timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration,System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
		            		FROM Ticket, Station, System, Equipments, Employee AS Emp1, Employee as Emp3 
		            		WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 45 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted = Emp3.emp_id AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            $result = $link->query($sql);
		            $result1 = $link->query($sql1);
	            }
	            echo"<thead><th style = 'width: 150px;'>Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Allotted To</th><th>Station</th><th>Status</th><th>Ticket duration</th></thead>";
	            if ($result->num_rows > 0) {
	            	
			        while($row = $result->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }

			    if ($result1->num_rows > 0) {
			        while($row = $result1->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }
            }
        	break;

        	case 'DGM/AGM':
        	$sql = "SELECT ticket_allotted FROM Ticket WHERE TIMESTAMPDIFF(Minute, ticket_open_datetime, NOW()) > 60 AND (ticket_open_close = 'Open' OR ticket_open_close = 'Pending')";
			$res = $link->query($sql);

			if ($res->num_rows > 0) {
	            while($rows = $res->fetch_assoc()){
					if ($rows['ticket_allotted'] == NULL) {
						$sql = "SELECT distinct Ticket.ticket_id,timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, System.system_name, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Station.station_name, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
							FROM Ticket, Station, Module, System, Equipments, Employee AS Emp1 
							WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 60 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted IS NULL AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            else {
		            	$sql1 = "SELECT distinct Ticket.ticket_id, System.system_name,timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
		            		FROM Ticket, Station, System, Equipments, Employee AS Emp1, Employee as Emp3 
		            		WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 60 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted = Emp3.emp_id AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            $result = $link->query($sql);
		            $result1 = $link->query($sql1);
	            }
	            echo"<thead><th style = 'width: 150px;'>Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Allotted To</th><th>Station</th><th>Status</th><th>Ticket duration</th></thead>";
	            if ($result->num_rows > 0) {
	                while($row = $result->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }

			    if ($result1->num_rows > 0) {
	                while($row = $result1->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }
            }
        	break;

        	case 'GM':
        	$sql = "SELECT ticket_allotted FROM Ticket WHERE TIMESTAMPDIFF(Minute, ticket_open_datetime, NOW()) > 120 AND (ticket_open_close = 'Open' OR ticket_open_close = 'Pending')";
			$res = $link->query($sql);

			if ($res->num_rows > 0) {
	            while($rows = $res->fetch_assoc()){
					if ($rows['ticket_allotted'] == NULL) {
						$sql = "SELECT distinct Ticket.ticket_id,timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, System.system_name, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Station.station_name, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
							FROM Ticket, Station, Module, System, Equipments, Employee AS Emp1 
							WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 120 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted IS NULL AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            else {
		            	$sql1 = "SELECT distinct Ticket.ticket_id, System.system_name,timestampdiff(Minute,Ticket.ticket_open_datetime,NOW()) as duration, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname 
		            		FROM Ticket, Station, System, Equipments, Employee AS Emp1, Employee as Emp3 
		            		WHERE TIMESTAMPDIFF(Minute, Ticket.ticket_open_datetime, NOW()) > 120 AND (Ticket.ticket_open_close = 'Open' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted = Emp3.emp_id AND Emp1.emp_id = Ticket.ticket_open_empid order by duration desc";
		            }
		            $result = $link->query($sql);
		            $result1 = $link->query($sql1);
	            }
	            echo"<thead><th style = 'width: 150px;'>Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Allotted To</th><th>Station</th><th>Status</th><th>Ticket duration</th></thead>";
	            if ($result->num_rows > 0) {
	                while($row = $result->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }

			    if ($result1->num_rows > 0) {
	                while($row = $result1->fetch_assoc()){

			        	$linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];
			        	
			        	echo "<tr style = 'background-color: #efbaba;'><td style = 'width: 150px;'><a style='color:#01406b;' target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td><table><tr><td>".$row['ticket_open_datetime']."</td></tr></table></td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['duration']." minutes </td></tr>";
			        }
			    }
            }
        	break;
	} 

    $link->close();

?>