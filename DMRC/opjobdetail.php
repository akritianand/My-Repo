<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Job Details</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	
	
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>	
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
	
	<!-- Bootstrap core CSS     -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/table.css">
</head>
<body>
<div class="wrapper">
    <div class="row">
        <div class="col-md-12" style="padding-right: 0em;">
            <div class="card">
            	<div class="header text-center" style="background-color: #E9353B;">
                    <h4 class="title" style="padding-bottom: 1%; color: white;">Job Details</h4>
                </div>
				<div class="container-fluid">
					<div class="col-md-6" style="padding: 5px;">
					<?php
						echo "<b>Ticket ID:</b> ";
						echo $_SESSION['dticketid']."<br>";
						echo "<b>System:</b> ";
						echo $_SESSION['dsystem']."</br>";
						echo "<b>Equipment Name:</b> ";
						echo $_SESSION['dequipment']."</br>";
						echo "<b>Module:</b> ";
						echo $_SESSION['dmodule']."<br>";
						echo "<b>Station:</b> ";
						echo $_SESSION['dstation']."<br>";
						echo "<b>Opened by:</b> ";
						echo $_SESSION['dopenname']." (".$_SESSION['dopenempid'].")<br>";
						echo "<b>Opened at:</b> ";
						echo $_SESSION['dopendtime']."<br>";
						echo "<b>Alloted to:</b> ";
						echo $_SESSION['dallname']." (".$_SESSION['dallempid'].")<br>";
						echo "<b>Closed at:</b> ";
						echo $_SESSION['dclosedtime']."<br>";
						echo "<b>Closed by:</b> ";
						echo $_SESSION['dclosename']." (".$_SESSION['dclosempid'].")<br>";
						echo "<b>Ticket Duration:</b> ";
						echo $_SESSION['duration']."<br>";
					?>
					</div>
					<div class="col-md-6" style="padding: 5px;">
						<?php
							echo "<b>Ticket Description:</b><br>";
							echo $_SESSION['dopdesc']."<br>";
							echo "<b>Ticket Rejected:</b><br>";
							echo $_SESSION['dmainreject']."<br>";
							echo "<b>Ticket Rectification:</b><br>";
							echo $_SESSION['dmaindesc']."<br>";
                            echo "<b>Ticket Comments:</b><br>";
                            echo $_SESSION['dcomment'];
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
