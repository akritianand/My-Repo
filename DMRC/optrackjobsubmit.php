<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    }

    $month = $_POST['month'];

    if (isset($_POST['month']) && $_POST['month']) {

        $sql1 = "SELECT ticket_open_close FROM Ticket WHERE MONTH(ticket_open_datetime) = $month";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if ($row['ticket_open_close'] == 'Open') {
                    $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                        MONTH(Ticket.ticket_open_datetime) = $month AND Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                }
                else {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                        MONTH(Ticket.ticket_open_datetime) = $month AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;    
                }
            }
        }

    }

    $sdate = $_POST['sdate'];
    $fdate = $_POST['fdate'];

    if (isset($_POST['sdate']) && $_POST['sdate'] && isset($_POST['fdate']) && $_POST['fdate']) {

        $sql1 = "SELECT ticket_open_close FROM Ticket WHERE DATE(Ticket.ticket_open_datetime) BETWEEN '$sdate' AND '$fdate'";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if ($row['ticket_open_close'] == 'Open') {
                    $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                        DATE(Ticket.ticket_open_datetime) BETWEEN '$sdate' AND '$fdate' AND Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                }
                else {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                        DATE(Ticket.ticket_open_datetime) BETWEEN '$sdate' AND '$fdate' AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;
                }
            }
        }
    }  

    $ticketid = $_POST['ticketid'];      

    if (isset($_POST['ticketid']) && $_POST['ticketid']) {
        $sql1 = "SELECT ticket_open_close FROM Ticket WHERE Ticket.ticket_id = $ticketid";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if ($row['ticket_open_close'] == 'Open') {
                    $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1
                        WHERE Ticket.ticket_id = $ticketid AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_open_close = 'Open' AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                }
                else {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                        Ticket.ticket_id = $ticketid AND Ticket.ticket_open_close = 'Close' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;
                }
            }
        }
    }

    $station = $_POST['station'];

    if (isset($_POST['station']) && $_POST['station']) {
        $sql1 = "SELECT ticket_open_close FROM Ticket WHERE Station.station_name = '$station'";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if ($row['ticket_open_close'] == 'Open') {
                    $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                        Station.station_name = '$station' AND Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                }
                else {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                        Station.station_name = '$station' AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;
                }
            }
        }
    }

    $mainstaff = $_POST['mainstaff'];

    if (isset($_POST['mainstaff']) && $_POST['mainstaff']) {
        $sql1 = "SELECT ticket_open_close FROM Ticket WHERE CONCAT(Emp2.emp_firstname, ' ', Emp2.emp_lastname) LIKE '$mainstaff'";
        $result = $link->query($sql1);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                if ($row['ticket_open_close'] == 'Open') {
                    $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                        CONCAT(Emp2.emp_firstname, ' ', Emp2.emp_lastname) LIKE '$mainstaff' AND Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                }
                else {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                        CONCAT(Emp2.emp_firstname, ' ', Emp2.emp_lastname) LIKE '$mainstaff' AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;
                }
            }
        }
    }

    switch ($_GET['type']) {
        case "openjob":
            $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id";
            break;

        case "jobtoday":
            $sql1 = "SELECT ticket_open_close FROM Ticket WHERE DATE(ticket_open_datetime) = curdate()";
            $result = $link->query($sql1);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    if ($row['ticket_open_close'] == 'Open') {
                        $sql = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname,  System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name   FROM Ticket, Station, System, Equipments, Employee as Emp1 WHERE 
                            DATE(ticket_open_datetime) = curdate() AND Ticket.ticket_open_close = 'Open' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id" ;
                    }
                    else {
                        $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as openfname, Emp1.emp_lastname as openlname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2 WHERE 
                            DATE(ticket_open_datetime) = curdate() AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_open_empid = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id" ;
                    }
                }
            }
            break;
    }

    $result = $link->query($sql);

    echo "<thead><tr><th style='width: 200px;'>Ticket ID</th><th>System</th><th>Equipment</th><th>Opened by</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th></tr></thead>";


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $linkaddress = "opjobdetailsubmit.php?ticketid=".$row['ticket_id'];

            echo "<tr><td style='width: 200px;'><a target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td>".$row['equip_name']."</td><td>".$row['openfname']." ".$row['openlname']." (".$row['e1'].")</td><td>".$row['ticket_open_datetime']."</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['closefname']." ".$row['closelname']." (".$row['e2'].")</td><td>".$row['ticket_close_datetime']."</td></tr>";

            echo $row['closefname'];
        }
    }

    $result = $link->query($sql2);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $linkaddress = "opjobdetailsubmit.php?ticketid=".$row['ticket_id'];
            
            echo "<tr><td style='width: 200px;'><a target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td>".$row['equip_name']."</td><td>".$row['openfname']." ".$row['openlname']." (".$row['e1'].")</td><td>".$row['ticket_open_datetime']."</td><td>".$row['station_name']."</td><td>".$row['ticket_open_close']."</td><td>".$row['closefname']." ".$row['closelname']." (".$row['e2'].")</td><td>".$row['ticket_close_datetime']."</td></tr>";

            echo $row['closefname'];
        }
    }

?>