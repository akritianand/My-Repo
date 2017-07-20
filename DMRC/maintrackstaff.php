<?php
	session_start();
    if (!isset($_SESSION ['emptype']) || $_SESSION['empdesg'] != 'SE') {
        header("Location: index.php");
        die();
    }
?>

<html>
<head>
	<title>Maintenance</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	
	
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/"></script>
	
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
	
</head>
<body >
	
	
	<div class="wrapper">
    <div class="sidebar" data-color="red">
		<div class="sidebar-wrapper">
            <div class="logo">
              <img src="/assets/img/Delhi-Metro.jpg" style="width:230px;height:90px">
            </div>
            <div class="logo text-center">
                <div style="color: white; font-size:1.1em;" id="details">
                  <?php 
                    echo "<h4 style='margin-top: 0px; font-size: 1.2em;'><b>".$_SESSION["fname"] . " " .$_SESSION["lname"]. "</b></h4>";
                    echo "<a style='font-size:1em; color: white;'>".$_SESSION['empdesg']."</a><br>";
                    echo "<a style='font-size:1em; color: white;'>Line: ".$_SESSION['empline']."".$_SESSION['empsec']."</a>";
                  ?>
                </div>
            </div>

            <ul class="nav">
                <li>
                    <a href="mainsedashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="mainseuser.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-note2"></i>
                        <p>Track staff attendance</p>
                    </a>
                </li>
                <li>
                    <a href="mainsetrackjob.php">
                        <i class="pe-7s-angle-right-circle"></i>
                        <p>Track jobs</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel" >
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Track staff attendance</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                            
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="logout.php">
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

	<div class="container-fluid" style="padding-left: 0em;">
        <div class="row">
            <div class="col-md-12" style="padding-right: 0em;">
                <div class="card">
					<div class="content">

					<table id="responsecontainer" style='width:100%' class="table table-responsive table-hover">
<tr><th>Employee ID</th><th>Employee Name</th><th>Attendance</th><th>Status</th></tr>
                    <div ></div>
                    </table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
	    <div class="container-fluid">
	        <nav class="pull-left">
	            <ul>
	                <li>
	                    <a href="#">
	                        Copyright
	                    </a>
	                </li>
	            </ul>
	        </nav>
	    </div>
	</footer>
			
    </div>
</div>

	<script type="text/javascript">
		$(document).ready(function() {

				$.ajax({
                type: "GET",
                url: "maintrackstaffsubmit.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $("#responsecontainer").append(response); 
                }
            });
	    });
	</script>
</body>
	

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
</html>