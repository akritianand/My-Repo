<?php
	session_start();

	$link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $ticketid = $_GET['ticketid'];

    $sql1 = "SELECT ticket_open_close FROM Ticket WHERE Ticket.ticket_id = $ticketid";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($row['ticket_open_close'] == 'Open') {
                $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname,'' as closefname, 'NULL' as closelname, 'NULL' AS e2, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Ticket.ticket_duration, Ticket.ticket_op_desc, Ticket.ticket_main_reject, Ticket.ticket_main_desc, Module.module_name, Ticket.ticket_comment
                	FROM Ticket, Station, Module, System, Equipments, Employee as Emp1, Employee AS Emp3 
                    WHERE Ticket.ticket_id = $ticketid AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND (Ticket.ticket_allotted = Emp3.emp_id OR Ticket.ticket_allotted IS NULL) LIMIT 1" ;
            }
            else {
                $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name, Emp3.emp_id as e3, Emp3.emp_firstname as allfname, Emp3.emp_lastname AS alllname, Ticket.ticket_duration, Ticket.ticket_op_desc, Ticket.ticket_main_reject, Ticket.ticket_main_desc, Ticket.ticket_comment 
                	FROM Ticket, Station, System, Module, Equipments, Employee as Emp1, Employee as Emp2, Employee AS Emp3  
	            	WHERE Ticket.ticket_id = $ticketid AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id AND Emp3.emp_id = Ticket.ticket_allotted AND Module.module_id = Ticket.ticket_module_id" ;
            }
        }

        $res = $link->query($sql);
        $row = $res->fetch_assoc();

        $_SESSION['dticketid'] = $row['ticket_id'];
        $_SESSION['dsystem'] = $row['system_name'];
        $_SESSION['dequipment'] = $row['equip_name'];
        $_SESSION['dstation'] = $row['station_name'];
        $_SESSION['dmodule'] = $row['module_name'];
        $_SESSION['dopenempid'] = $row['e1'];
        $_SESSION['dopenname'] = $row['openfname']." ".$row['openlname'];
        $_SESSION['dclosempid'] = $row['e2'];
        $_SESSION['dclosename'] = $row['closefname']." ".$row['closelname'];
        $_SESSION['dallempid'] = $row['e3'];
        $_SESSION['dallname'] = $row['allfname']." ".$row['alllname'];
        $_SESSION['dopendtime'] = $row['ticket_open_datetime'];
        $_SESSION['dclosedtime'] = $row['ticket_close_datetime'];
        $_SESSION['duration'] = $row['ticket_duration'];
        $_SESSION['dopenclose'] = $row['ticket_open_close'];
        $_SESSION['dopdesc'] = $row['ticket_op_desc'];
        $_SESSION['dmainreject'] = $row['ticket_main_reject'];
        $_SESSION['dmaindesc'] = $row['ticket_main_desc'];
        $_SESSION['dcomment'] = $row['ticket_comment'];
        
        header("Location: opjobdetail.php");
        die();

    $link->close();
?>

