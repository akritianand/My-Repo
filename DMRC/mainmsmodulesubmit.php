<?php

    session_start();

    $link = mysqli_connect("localhost", "root", "anki29", "DMRC1");
   
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

   $equipid = $_POST['equipid'];
   $equipid = (int)$equipid;

    $sql = "SELECT module_name FROM Module WHERE module_equip_id = $equipid";

        $result = $link->query($sql);

    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()){
    		echo "<option value".$row['module_name'].">".$row['module_name']."</option>";
    	}
        echo "<option value='Others'>Others</option>";
    }

    $link->close();
?>