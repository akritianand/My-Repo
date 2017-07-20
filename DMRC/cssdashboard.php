<?php
	session_start();
    if (!isset($_SESSION ['emptype']) || $_SESSION ['emptype'] != 'CSS') {
        header("Location: index.php");
        die();
    }
?>

<html>
<head>
  	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Dashboard</title>
	
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>	
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
    <script type="text/javascript" src="assets/js/css.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/table.css">
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="red">
        <div class="sidebar-wrapper">
            <div class="logo">
              <img src="/assets/img/Delhi-Metro.jpg" style="width:230px;height:90px">
            </div>
            <div class="logo text-center">
                <div style="color: white; font-size:1.1em;">
                  <?php 
                    echo "<h4 style='margin-top: 0px; font-size: 1.2em;'><b>".$_SESSION["fname"] . " " .$_SESSION["lname"]. "</b></h4>";
                    echo "<h5>CSS</h5>";
                    echo "<a style='font-size:1em; color: white;'>".$_SESSION['empdesg']."</a><br>";
                  ?>
                </div>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="cssuser.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="cssfilejob.php">
                        <i class="pe-7s-attention"></i>
                        <p>Critical Failures</p>
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
                    <a class="navbar-brand" href="#">Dashboard </a>
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

	<div class="container-fluid" style="padding-top: 1em;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Search failure</h4>
                    </div>
                	<div class="content">
                    	<form id="place1" method="POST">
                    		<div class="row">
                    		<div class="col-md-2">
                            <div class="form-group">
                    		<select type="text" name="month" id="month" class="form-control">
                    			<option value="01">January</option>
                    			<option value="02">February</option>
                    			<option value="03">March</option>
                    			<option value="04">April</option>
                    			<option value="05">May</option>
                    			<option value="06">June</option>
                    			<option value="07">July</option>
                    			<option value="08">August</option>
                    			<option value="09">September</option>
                    			<option value="10">October</option>
                    			<option value="11">November</option>
                    			<option value="12">December</option>
                    		</select>
                    		</div>
                    		</div>
                    		<div class="col-md-1">
                    		<button type="submit" class="btn btn-primary btn-fill">Search</button>
                    		</div>
                    		</div>
                    	</form>

                    	<form id="place2" method="POST">
                    		<div class="row">
                    		<div class="col-md-2">
                            <label>From Date:</label>
                    		<input class="form-control" type="date" name="sdate" id="sdate" placeholder="YYYY-mm-dd">
                            </div>
                            <div class="col-md-2">
                            <label>To Date:</label>
                            <input class="form-control" type="date" name="fdate" id="fdate" placeholder="YYYY-mm-dd">
                    		</div>
                    		<div class="col-md-2">
                    		<button type="submit" class="btn btn-primary btn-fill">Search</button>
                    		</div>
                    		</div>
                    	</form>

                    	<form id="place3" method="POST">
                    		<div class="row">
                    		<div class="col-md-2">
                    		<input type="number" name="ticketid" id="ticketid" placeholder="Enter ticket ID" class="form-control">
                    		</div>
                    		<div class="col-md-1">
                    		<button type="submit" class="btn btn-primary btn-fill">Search</button>
                    		</div>
                    		</div>
                    	</form>

                        <form id="place4" method="POST">
                            <div class="row">
                                <div class="col-md-1">
                                    <input id="lineinput" type="number" name="line" class="form-control" placeholder="Line" min = 0 step= 1>
                                </div>

                                <div class="col-md-1">
                                    <input id="secinput" type="text" name="section" placeholder="Section" class="form-control">
                                </div>
                                  
                                <div class="col-md-3">
                                    <select class="form-control" name="station" id="responsecontainer"></select>
                                </div>

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-fill">Search</button>
                                </div>
                            </div>
                        </form>

                        <form id="place5" method="POST">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="number" id="mainstaff" name="mainstaff" placeholder="Employee ID" class="form-control">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-fill">Search</button>
                                </div>
                            </div>
                        </form>
                        <button id="jobtoday" class="btn btn-fill btn-primary">View all job requests today</button>
                        <button id="openjob" class="btn btn-fill btn-primary">View open job requests</button>
                	</div>
               </div>
           </div>
       </div>
    </div>
	   <div id="MONTH" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">Jobs For <span id="mname"></span><a href="#" class="pull-right btn btn-success btn-fill" id="export1">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData1">
                        <table id="responsecontainer1" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
	   </div>
       <div id="DATE" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">Jobs on <span id="dname"></span><a href="#" class="pull-right btn btn-success btn-fill" id="export2">Export into Excel</a></h4>
                        </div> 
                        <div class="content"> <div id="dvData2">
                        <table id="responsecontainer2" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
       </div>
       <div id="TICKET" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">TICKET ID: <span id="tname"></span><a href="#" class="pull-right btn btn-success btn-fill" id="export3">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData3">
                        <table id="responsecontainer3" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
       </div>
       <div id="STATION" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title"><span style="padding-bottom: 1%; color: white;" id="stname"></span><a href="#" class="pull-right btn btn-success btn-fill" id="export4">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData4">
                        <table id="responsecontainer4" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
       </div>
       <div id="MAINSTAFF" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">MS: <span id="mainname"></span><a href="#" class="pull-right btn btn-success btn-fill" id="export5">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData5">
                        <table id="responsecontainer5" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
       </div>
       <div id="TODAY" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">Job Requests today<a href="#" class="pull-right btn btn-success btn-fill" id="export6">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData6">
                        <table id="responsecontainer6" style='width:100%' class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th><th>Duration</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
        </div>
       <div id="OPEN" class="container-fluid" style="padding-left: 0em;">
            <div class="row">
                <div class="col-md-12" style="padding-right: 0em;">
                    <div class="card">
                        <div class="header text-center" style="background-color: #E9353B;">
                            <h4 class="title" style="padding-bottom: 1%; color: white;">All Open Jobs<a href="#" class="pull-right btn btn-success btn-fill" id="export7">Export into Excel</a></h4>
                        </div>
                        <div class="content"> <div id="dvData7">
                        <table id="responsecontainer7"  class="scroll table table-responsive table-hover"><thead><tr><th style="width: 200px;">Ticket ID</th><th>System</th><th>Equipment</th><th>Opened at</th><th>Station</th><th>Status</th><th>Closed by</th><th>Closed at</th></tr></thead></table>
                        </div> </div>
                    </div>
                </div>
            </div>
       </div>
	</div>
</div>
</body>
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
