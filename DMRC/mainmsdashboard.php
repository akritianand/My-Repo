<?php
	session_start();
	if (!isset($_SESSION ['emptype']) || $_SESSION['empdesg'] != 'MS') {
        header("Location: index.php");
        die();
    }
?>

<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
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
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
                <li class="active">
                    <a href="">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="mainmsuser.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                
                <li>
                    <a href="mainmsjobdetails.php">
                    	<i class="pe-7s-angle-right-circle"></i>
                        <p>Current Job Details</p>
                    </a>
                </li>
                <li>
                    <a href="mainmsjobhistory.php">
                        <i class="pe-7s-note2"></i>
                        <p>Job History</p>
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

        <div class="container-fluid" background="dmrc1.png" style="padding-top: 1em;">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="header">
                        	<h4>Mark Attendance</h4>
                            <h5 class="title">Enter your location:</h5>
                        </div>
                        <div class="content">	
							<form id="place" method="POST">
								<div class="col-md-4">
									<input type="number" name="line" placeholder="Line" class="form-control">
								</div>
								<div class="col-md-4">
									<input type="text" name="sec" placeholder="Section" class="form-control">
								</div>
								<input type="submit" value="Enter" class="btn btn-fill btn-primary"> 
								<span id="icon"></span>
							</form> 
						</div>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-2">
                <div class="content text-center">
                	<form method="POST" action="logout.php" class="form-inline">
                		<input type="submit" value="Sign Off" name="offduty" class="btn-warning btn btn-fill">
                	</form>
                </div>
			</div>
			</div>
		</div>

	    <div class="container-fluid" style="padding-left: 0em;">
	        <div class="row">
	            <div class="col-md-12" style="padding-right: 0em;">
	                <div class="card">
	                	<div class="header text-center" style="background-color: #E9353B;">
	                        <h4 class="title" style="padding-bottom: 1%; color: white;">New Job</h4>
	                    </div>
						<div class="content">
						<table id="responsecontainer" style='width:100%' class="table table-responsive table-striped"><tr align="center"><th>Ticket ID</th><th>System</th><th>Equipment Name</th><th>Station</th><th>Ticket opened by</th></tr></table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" align="center" style="padding-right: 0em;">
						<a href="mainmsjobdetails.php" id="accept" class="btn btn-primary btn-fill">Acknowledge</a> <button class="btn btn-danger btn-fill" id="reject">Reject</button>
						<div id="reason_reject">
							<form id="rejectappend" method="POST" action="mainmsreject.php">
								<div style="clear: both;">
									<textarea name="reason" rows="3" cols="70" placeholder="Mention action taken, reasons reported and name of the substitute staff..." required></textarea>
								</div>
								<div align="center"><span>Characters remaining </span><span id="characters">256</span></div>
								<input type="submit" name="reject" value="Reject" class="btn btn-primary btn-fill" style="margin-top: 0.5%">
							</form>
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
		        url: "mainmsdashsubmit.php",             
		        dataType: "html",   //expect html to be returned                
		        success: function(response){                   
		            $("#responsecontainer").append(response);
		        }
			});

	    	$('#place').submit (function (event) {
            event.preventDefault();
		 	$.ajax({
			  	type: "POST",
		        url: "mainses.php",
		        data: $(this).serialize(),
		        success: function(){
		        	$('#details').replaceWith(response);
		        	var icon = "<span class='glyphicon glyphicon-ok' style='color: #00cc00; font-size: 2em;'></span>"; 
		            $('#icon').html(icon);
		        },                   
		        error: function() {
		           console.log('not working');
		        }
			});    
	    });

	    	$('#reason_reject').hide();
			setInterval(ajaxcall, 15000);

			function ajaxcall() {
				$.ajax({
			  	type: "GET",
		        url: "mainmsdashsubmit.php",             
		        dataType: "html",   //expect html to be returned                
		        success: function(response){                   
		            $("#responsecontainer").append(response);
		        }
			});}

			$('#reject').click(function (event) {
				event.preventDefault();
				$('#reject').remove();
				$('#accept').remove();
				$('#reason_reject').show();
			});

			$('textarea').keyup(updateCount);
	          $('textarea').keydown(updateCount);

	          function updateCount() {
	              var cs = 256 - $(this).val().length;
	              $('#characters').text(cs);
	          }
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