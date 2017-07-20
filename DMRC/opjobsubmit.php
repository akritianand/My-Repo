<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

   // $type = Null;

    $station = $_POST['station'];
    $equipment = $_POST['equipment'];
    $subequipment = $_POST['sequipment'];
    $type = $_POST['type'];
    $module = $_POST['module'];
    $description = $_POST['description'];
    $system = $_POST['system'];

    $dat = explode(PHP_EOL, file_get_contents("var.txt"));
    $i = $dat[0];
    $date = $dat[1];

    if ($date == (int)date("Ymd")) {
    	echo "current date";
        $i++;
        $datedit = $date."00000";
    	$ticketid = (string)($datedit) + $i;
    	$myfile = fopen("var.txt", "w") or die("Unable to open file!");
    	$insert = $i.PHP_EOL;
    	fwrite($myfile, $insert);
    	$insert = $date;
    	fwrite($myfile, $insert);
    	fclose($myfile);
    }
    else {
    	echo "resetting date";
     	$i = 0;
     	$date = (int)date("Ymd");
     	$myfile = fopen("var.txt", "w") or die("Unable to open file!");
    	$insert = $i.PHP_EOL;
    	fwrite($myfile, $insert);
    	$insert = $date;
    	fwrite($myfile, $insert);
    	fclose($myfile);

    	$datedit = $date."00000";
        $ticketid = (string)($datedit) + $i;	
    }

    $_SESSION['ticketid'] = $ticketid;

        $sql = "SELECT system_id FROM System WHERE system_name = '$system'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) { 
            $sys = $result->fetch_assoc(); 
            $sys = $sys['system_id'];
            echo $sys;
        }
        else {
            echo "Failed to retrieve System name";
        }

        $sql = "SELECT station_id FROM Station WHERE station_name = '$station'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) { 
            $stat = $result->fetch_assoc(); 
            $stat = $stat['station_id'];
            $_SESSION['station'] = $stat;
            echo $stat;
        }
        else {
            echo "Failed to retrieve Station name";
        }

        $sql = "SELECT equip_id FROM Equipments WHERE equip_name = '$equipment'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) { 
            $eq = $result->fetch_assoc(); 
            $eq = $eq['equip_id'];
            echo $eq;
        }
        else {
            echo "Failed to retrieve Equipment name";
        }

    $empid = $_SESSION['empid'];
    $datetime = date("Y-m-d H:i:s");

    $sql = "INSERT INTO Ticket (ticket_id, ticket_system_id, ticket_equip_id, ticket_station_id, ticket_open_empid, ticket_open_datetime, ticket_op_desc) VALUES ('$ticketid', $sys, $eq, $stat, $empid, '$datetime', '$description')";

	if ($link->query($sql) == TRUE) {
        echo "success";
	    $link->close();
	    $_SESSION["flag"] = 1;
	    header("Location: ticketassign.php");
	          die();
    }

    else {
    	echo mysqli_error($link);
    	$link->close();
    }
?>