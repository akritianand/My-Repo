<?php
    session_destroy();
    session_start();

    //Archiving/Deletion Yearly: DELETE FROM Ticket WHERE DATEDIFF(NOW(), ticket_open_datetime) >= 365;
?>

<!DOCTYPE html>

<html>
<head>
    <title>Login</title>
    <meta charset="utf-8"/>
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

</head>

<body>    
<div class="wrapper">
    <div class="sidebar" data-color="red" >
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/img/Delhi-Metro.jpg" style="width:230px;height:90px">
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-science"></i>
                        <p>Login</p>
                    </a>
                </li>

                <li>
                    <a href="signup.php">
                        <i class="pe-7s-add-user"></i>
                        <p>Signup</p>
                    </a>
                </li>
                <li>
                    <a href="http://www.delhimetrorail.com/about_us.aspx">
                        <i class="pe-7s-help1"></i>
                        <p>About Us</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
    <div class="content">
            <div class="container-fluid">
                <?php
                    if(isset($_SESSION["flag"]) && $_SESSION["flag"] == 0) {
                        echo "<div class='row'><div class='card col-md-3 col-md-offset-3' style='background-color: #f9bdbd;'>";
                        echo "<span style='font-size:1.3em;'>Invalid login! Try Again!</span>";
                        echo "</div></div>"; 
                        session_unset($_SESSION["user"]);
                    } 
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Employee Login</h4>
                            </div>
                            <div class="content">
                                <form action="submit.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employee ID</label>
                                                <input name="uid" type="number" class="form-control" placeholder="Employee ID" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="psw" type="password" class="form-control" placeholder="Password" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Login</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    
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