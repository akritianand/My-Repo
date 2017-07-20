<?php
  session_start();

  if (!isset($_SESSION ['emptype']) || $_SESSION ['emptype'] != 'CSS' || $_SESSION['empdesg'] = 'AM' || $_SESSION['empdesg'] = 'DGM' || $_SESSION['empdesg'] = 'AGM' || $_SESSION['empdesg'] = 'GM') {
        header("Location: index.php");
        die();
    }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Critical Failure</title>

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


    <!--     Fonts and icons   anki29
      -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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
                        echo "<a style='font-size:1em; color: white;'>".$_SESSION['empdesg']."</a><br>";
                      ?>
                </div>
            </div>

            <ul class="nav">
                <li>
                    <a href="cssdashboard.php">
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
                <li class="active">
                    <a href="#">
                        <i class="pe-7s-attention"></i>
                        <p>Critical Failures</p>
                    </a>
                </li>
            </ul>
      </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Critical Failures</a>
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


        <div class="content">
            <div class="container-fluid">
            <div class="col-md-8">
                        <div class="card ">
                          <?php   
                            if (isset($_SESSION['flag']) && $_SESSION["flag"] === 1) {
                              echo '<div class="text-center">Job request sent!</div>';
                              unset($_SESSION['flag']);
                            }  
                          ?>
                            <div class="header">
                                <h4 class="title">Place Requests</h4>
                            </div>
                            <div class="content" text>
                                 <form action="csscriticaljobsubmit.php" method="POST">
                                  <p id="line">
                                    <label for="Line">Line: </label>
                                    <input id="lineinput" type="number" name="line" placeholder="Line" min = 0 step= 1 required>
                                  </p>

                                  <p id="sec">
                                    <label for="Section">Section: </label>
                                    <input id="secinput" type="text" name="section" placeholder="Section" required>
                                  </p>
                                  
                                  <p>
                                    <label for="station">Station: </label>
                                    <select name="station" id="responsecontainer" required></select>
                                  </p>

                                  <p>
                                    <label for="system">System: </label>
                                      <select name="system" id="system" required>
                                         <option value="AFC">AFC</option>
                                         <option value="TELE">TELE</option>
                                       </select>
                                  </p>

                                  <p>
                                    <label for="equipment">Equipment: </label>
                                    <select id="equipment" name="equipment" required=""></select>
                                  </p>
                                  
                                  <p>
                                    <label for="equipmentid">Sub-equipment: </label>
                                    <input type="text" id="sequipment" name="sequipment">
                                  </p>

                                  <p class="typeq">
                                    <label for="type">Type: </label>
                                       <select name="type" class="typeq">
                                         <option value="entry">Entry</option>
                                         <option value="exit">Exit</option>
                                         <option value="bi">Bidirectional</option>
                                       </select>
                                  </p>

                                  <p>
                                    <label for="mainstaff">Assign To: </label>
                                    <select type="text" name="ms" id="responsecontainer1" required=""></select>
                                  </p>

                                  <p>
                                    <div>
                                    <label for="description">Description: </label>
                                    </div>
                                    <div>
                                    <textarea name="description" rows="6" cols="70">Critical</textarea>
                                    <div align="right"><span>Characters remaining </span><span id="characters">256</span></div>
                                    </div>   <!--this is where number of characters left to type are displayed. Style it accordingly-->
                                  </p>

                                  <p>
                                    <button class="btn btn-primary btn-fill" type="submit">Submit</button>
                                  </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


  
 

  <script type="text/javascript">
        $(document).ready(function () {

          $("#line").on("change", function() {
            $("#sec").on("change paste", function() {
              var line = $('#lineinput').val();
              var sec = $('#secinput').val();

              $.ajax({
                type: "POST",
                url: "opstat.php", 
                data: {'line':line, 'sec':sec},            
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $("#responsecontainer").html(response); 
                } 
              });
            });
          });

          $("#equipment").on("focus", function() {
            var system = $('#system option:selected').val();

            $.ajax({
                type: "POST",
                url: "opsys.php", 
                data: {'system':system},            
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $("#equipment").html(response); 
                } 
              });
          });

          $('textarea').keyup(updateCount);
          $('textarea').keydown(updateCount);

          function updateCount() {
              var cs = 256 - $(this).val().length;
              $('#characters').text(cs);
          }

          $.ajax({
            type: "GET",
            url: "cssassignstaff.php", 
            dataType: "html",   //expect html to be returned                
            success: function(response){                    
                $("#responsecontainer1").html(response); 
            } 
          });
        });
  </script>

  <script type="text/javascript">
      $(document).ready(function () {
          $(".typeq").hide();

          $("#equipment").change(function() {
            var eq = $("#equipment").val();
            eq = eq.toUpperCase(eq);

            if (eq == "GATE") {
              $(".typeq").show();
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