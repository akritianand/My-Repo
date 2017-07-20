<?php
    session_start();
?>
<!DOCTYPE html>

<html>
<head>
    <title>Sign Up</title>
    <meta charset="utf-8"/>
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
                <li>
                    <a href="index.php">
                        <i class="pe-7s-science"></i>
                        <p>Login</p>
                    </a>
                </li>

                <li class="active">
                    <a href="#">
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
                            if(isset($_SESSION["user"]) && $_SESSION["user"] == 0) {
                                echo "<div class='row'><div class='card col-md-3 col-md-offset-3' style='background-color: #f9bdbd;'>";
                                echo "<span style='font-size:1.3em;'>Invalid Sign Up! Try Again!</span>";
                                echo "</div></div>"; 
                                session_unset($_SESSION["user"]);
                            } 
                        ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Employee Sign Up</h4>
                            </div>
                            <div class="content">
                                <form action="signupsubmit.php" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Employee ID</label>
                                                <input name="uid" type="number" class="form-control" placeholder="Employee ID" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name="fname" type="text" class="form-control" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lname" type="text" class="form-control" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Employee Type</label>
                                                <select name="emptype" type="text" class="form-control" required>
                                                    <option value="Operations">Operations</option>
                                                    <option value="CSS">CSS</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                                                       

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <input name="empdpt" type="text" class="form-control" placeholder="Department" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <input name="desg" type="text" class="form-control" placeholder="Designation" required>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Reports To</label>
                                                <input name="rto" type="number" class="form-control" placeholder="Employee ID" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input name="empemail" type="text" class="form-control" placeholder="Email" required>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input name="phone" type="number" class="form-control" placeholder="Phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input name="psw" type="password" class="form-control" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Sign up</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
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