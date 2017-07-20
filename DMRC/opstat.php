<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $sec = $_POST['sec'];
    $line = $_POST['line'];

    echo $line;

    $sql = "SELECT station_name FROM Station WHERE station_line = $line AND station_section = '$sec'";

        $result = $link->query($sql);

    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()){
    		echo "<option>".$row['station_name']."</option>";
    	}
    }

    $link->close();
?>