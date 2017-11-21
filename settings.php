<?php
session_start();
error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Add Employee</title>  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">

  <!-- W3.CSS Open 
    <link rel="stylesheet" href="css/offW3.css">
   W3.CSS Close -->
    
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   

  <style type="text/css">
      @font-face { 
        font-family: Gumption lite; 
        src: url('fonts/Gumption-lite.ttf'); 
      } 
      .helloFont1 {
        font-family:"Gumption lite";
      }
  </style>

  <script type="text/javascript">
    $(document).ready(function(){  
      $(".button-collapse").sideNav();
    });

  </script>
</head>
<body>
  <nav>
    <div class="nav-wrapper blue-grey darken-3">
      &nbsp;&nbsp;&nbsp;
      <a href="index.php" class="brand-logo helloFont1">Flubbers</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li class="active"><a href="settings.php">Settings</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li class="active"><a href="settings.php">Settings</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>
    </div>
  </nav> 
<?php
  include("DB/db.php");

  $month = date("m");
  $year  = date("Y");
  if($month<10)
    $monthStr = '0'.$month;
  else
    $monthStr = $month;
  $month = $year.'-'.$monthStr;

        $busAmt = 0;
        $messAmt = 0;
        $PF_val = 0;
        $ESI_val = 0;

    $queryVar = "select * from variables where month='".$month."'";
    $exeVar = mysqli_query($conn,$queryVar);
    while($variable = mysqli_fetch_assoc($exeVar))
    {
      $busAmt = $variable['bus_fare'];
      $messAmt = $variable['mess_fare'];
      $PF_val = $variable['PF'];
      $ESI_val = $variable['ESI'];
    }

?>   
  <div class="row" align="center">
    <div class="col s12 m3 l3">
      <br/>
    </div>
    <div class="col s12 m6 l6">
      <form method="post" novalidate>
        <div class="row">
          <div class="input-field col s12">
            <input id="busFare" name="busFare" type="text" class="validate" required="required" autofocus="autofocus" value="<?php echo $busAmt; ?>">
            <label for="busFare">Bus Fare (in Rs.)</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="messFare" name="messFare" type="text" class="validate" required="required" value="<?php echo $messAmt; ?>">
            <label for="messFare">Mess Fare (in Rs.)</label>
          </div>
        </div> 
        <div class="row">
          <div class="input-field col s12">
            <input id="PF" name="PF" type="text" class="validate" required="required" value="<?php echo $PF_val; ?>">
            <label for="PF">PF (in %)</label>
          </div>
        </div> 
        <div class="row">
          <div class="input-field col s12">
            <input id="ESI" name="ESI" type="text" class="validate" required="required" value="<?php echo $ESI_val; ?>">
            <label for="ESI">ESI (in %)</label>
          </div>
        </div>                                                     
<br/>
        <div class="row">
          <button class="waves-effect waves-light btn" id="submit" name="submit">SAVE</button> &nbsp;&nbsp;&nbsp;
          <button type="reset" class="waves-effect waves-light btn red-text white">RESET</button><br/>
        </div> 
      </form>                           
    </div>
    <div class="col s12 m3 l3">
      <br/>
    </div>        
  </div>   
</body>
</html>
<?php

if(isset($_POST["submit"]))
{

  $busFare = $_POST["busFare"];
  $messFare = $_POST["messFare"];
  $PF = $_POST["PF"];
  $ESI = $_POST["ESI"];

$execute = mysqli_query($conn,"update variables set bus_fare='".$busFare."',mess_fare='".$messFare."',PF='".$PF."',ESI='".$ESI."' where month='".$month."' ");


   echo "<script>window.location.href='settings.php';</script>";  

}

  mysqli_close($conn);


?>