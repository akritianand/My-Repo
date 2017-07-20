<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $system = $_POST['system'];

    $sql = "SELECT system_id FROM System WHERE system_name = '$system'";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    $sys_id = $row['system_id'];

    $sql = "SELECT equip_name FROM Equipments WHERE equip_system_id = $sys_id"; //

        $result = $link->query($sql);

    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()){
    		echo "<option>".$row['equip_name']."</option>";
    	}
    }

    $link->close();
?>