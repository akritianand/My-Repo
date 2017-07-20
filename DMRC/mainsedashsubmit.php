<?php
    session_start();

    $line = (int)$_SESSION['empline'];
    $sec = $_SESSION['empsec'];

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit(); 
    } 

    $empid = $_SESSION['empid'];

    $sql = "SELECT Ticket.ticket_open_close, Ticket.ticket_id FROM Ticket, Employee, Station WHERE Ticket.ticket_id > Employee.emp_notif AND Employee.emp_id = $empid AND Ticket.ticket_station_id = Station.station_id AND Station.station_line = $line AND Station.station_section = '$sec' ORDER BY Ticket.ticket_id ";

        $result = $link->query($sql); 

        if ($result->num_rows > 0) {
            while($rows = $result->fetch_assoc()){ 
                $ticketid = $rows['ticket_id'];

                if ($rows['ticket_open_close'] == 'Open') {
                    $sql2 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp1.emp_firstname as allfname,'Still' as closefname, 'Working' as closelname, Emp1.emp_lastname as alllname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name 

                        FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee AS Emp0 

                        WHERE Ticket.ticket_id > Emp0.emp_notif AND Emp0.emp_id = $empid AND Station.station_line = $line AND Station.station_section = '$sec' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted = Emp1.emp_id AND Ticket.ticket_open_close = 'Open' ORDER BY Ticket.ticket_id DESC";

                }
                else {
                    $sql1 = "SELECT distinct Ticket.ticket_id, Emp1.emp_id as e1, Emp2.emp_id as e2, Emp1.emp_firstname as allfname, Emp1.emp_lastname as alllname, Emp2.emp_firstname as closefname, Emp2.emp_lastname as closelname, System.system_name, Equipments.equip_name, Ticket.ticket_open_empid, Ticket.ticket_close_empid, Ticket.ticket_open_close, Ticket.ticket_open_datetime, Ticket.ticket_close_datetime, Station.station_name 

                        FROM Ticket, Station, System, Equipments, Employee as Emp1, Employee as Emp2, Employee AS Emp0

                        WHERE Ticket.ticket_id > Emp0.emp_notif AND Emp0.emp_id = $empid AND Station.station_line = $line AND Station.station_section = '$sec' AND Station.station_id = Ticket.ticket_station_id AND Ticket.ticket_system_id = System.system_id AND Equipments.equip_id = Ticket.ticket_equip_id AND Ticket.ticket_allotted = Emp1.emp_id AND Ticket.ticket_close_empid = Emp2.emp_id AND (Ticket.ticket_open_close = 'Close' OR Ticket.ticket_open_close = 'Pending') ORDER BY Ticket.ticket_id DESC" ;
                }
            }

           $res = $link->query($sql2);
              if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()){
                $linkaddress = "mainjobdetailsubmit.php?ticketid=".$row['ticket_id'];

                echo "<tr><td style = 'width: 150px;'><a target='_blank' href='".$linkaddress."'>".$row['ticket_id']."</a></td><td>".$row['system_name']."</td><td><table><tr><td>".$row['equip_name']."</td></tr><tr><td>".$row['subequip_name']."</td></tr></table></td><td>".$row['ticket_open_datetime']."</td><td>".$row['station_name']."</td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$row['ticket_open_close']."</td><td><table><tr><td>".$row['closefname']." ".$row['closelname']." (".$row['e2'].")</td></tr><tr><td>".$row['ticket_close_datetime']."</td></tr></table></td></tr>";
            }
        } 
                $resu = $link->query($sql1);
                if ($resu->num_rows > 0) {
        while($rowss = $resu->fetch_assoc()){
                $linkaddress = "mainjobdetailsubmit.php?ticketid=".$rowss['ticket_id'];

                echo "<tr><td style = 'width: 150px;'><a target='_blank' href='".$linkaddress."'>".$rowss['ticket_id']."</a></td><td>".$rowss['system_name']."</td><td><table><tr><td>".$rowss['equip_name']."</td></tr><tr><td>".$rowss['subequip_name']."</td></tr></table></td><td>".$rowss['ticket_open_datetime']."</td><td>".$rowss['station_name']."</td><td>".$row['allfname']." ".$row['alllname']." (".$row['e3'].")</td><td>".$rowss['ticket_open_close']."</td><td><table><tr><td>".$rowss['closefname']." ".$rowss['closelname']." (".$rowss['e2'].")</td></tr><tr><td>".$rowss['ticket_close_datetime']."</td></tr></table></td></tr>";  
                
            }
        }


        $sql1 = "UPDATE Employee SET emp_notif = $ticketid WHERE emp_id = $empid";
            if ($link->query($sql1) == TRUE) {
                echo "inserted";
               }
            else {
                echo mysqli_error($link);
            }
        
        } 
   
    $link->close();
?>