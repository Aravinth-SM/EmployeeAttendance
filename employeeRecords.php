<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Employee Records</title>  
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
      @font-face { font-family: Gumption lite; src: url('fonts/Gumption-lite.ttf'); } 
        .helloFont1{
        font-family:"Gumption lite";
      }
}    
  </style>

  <script type="text/javascript">

    $(document).ready(function(){   
      $('select').material_select();
      $(".button-collapse").sideNav(); 
    });


    function myFunction(length) {
      var input, filter, i, divId, divElm;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      for (i = 0; i < length; i++) {
        //td = tr[i].getElementsByTagName("td")[0];
        divId = "employee"+i;
        divElm = document.getElementById(divId);
        if (divElm) {
          if (divElm.getAttribute("data").toUpperCase().indexOf(filter) > -1) {
            divElm.style.display = "";
          } else {
            divElm.style.display = "none";
          }
        }
      }
    }

    function loadDatas(val) {
      if (val == "") { 
        return;
      } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var val = this.responseText;
                  var splitedVal = val.split(":");
                    document.getElementById("totalEmp").innerHTML = "<b>"+splitedVal[0]+"</b>";
                    document.getElementById("monthlyEmp").innerHTML = "<b>"+splitedVal[1]+"</b>";
                    document.getElementById("dailyEmp").innerHTML = "<b>"+splitedVal[2]+"</b>";
                  //document.getElementById('employeeRows').innerHTML=val;                       
              }
          }
          xmlhttp.open("GET", "loadDatasForPlant.php?plant="+val, true);
          xmlhttp.send();
        }        
    }    

    function fetchEmployees(val) {
      if (val == "") { 
        return;
      } else {
          loadDatas(val);
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var val = this.responseText;
                  document.getElementById('employeeRows').innerHTML=val;                       
              }
          }
          xmlhttp.open("GET", "fetchEmployeesForPlant.php?plant="+val, true);
          xmlhttp.send();
        }        
    } 

  </script>
</head>
<body onload="fetchEmployees('all');">
  <nav>
    <div class="nav-wrapper blue-grey darken-3">
      &nbsp;&nbsp;&nbsp;
      <a href="index.php" class="brand-logo helloFont1">Flubbers</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li class="active"><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li class="active"><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>      
    </div>
  </nav>   
  <div class="row" align="center">
<?php

   include("DB/db.php");

   $query = "select * from employee where type='monthly' and status=1";
   $exe = mysqli_query($conn,$query);
   $noOfMonthlyPaid = mysqli_num_rows($exe);

   $query = "select * from employee where type='daily' and status=1";
   $exe = mysqli_query($conn,$query);
   $noOfDailyPaid = mysqli_num_rows($exe);   

   $query = "select * from employee where status=1 order by emp_id";
   $exe = mysqli_query($conn,$query);
   $noOfEmployees = mysqli_num_rows($exe);   

?>     
    <div class="col s12 m3 l3">
      <br/>
      <div class="input-field col s12">
        <select name="plant" id="plant" onchange="fetchEmployees(this.value);">
          <option value="all" selected>All</option>
          <option value="Jelly">Jelly</option>
          <option value="Waffer">Waffer</option>
          <option value="Cup">Cup</option>
          <option value="Toy_Jar">Toy & Jar</option>
          <option value="Lollypop">Lollypop</option>
          <option value="Coffee">Coffee</option> 
          <option value="Utility">Utility</option>
          <option value="ETP_Boilers">ETP & Boilers</option>
          <option value="Electrical">Electrical</option>
          <option value="Driver">Driver</option>                       
        </select>
        <label>Plant / Department</label>
      </div>       
      <div class="input-field col s12">
        <i class="material-icons prefix green-text text-darken-2">search</i>
        <input type="text" name="myInput" placeholder="Search Employee.." id="myInput"
          onkeyup="myFunction(<?php echo $noOfEmployees; ?>)" class="blue-grey-text text-darken-3">
      </div>
    </div>   
    <div class="col s12 m3 l3">
      <div class="card green darken-1" style="">
          <div class="card-content white-text" style="line-height: 1.8">
            <p><b>NO. &nbsp; OF &nbsp; EMPLOYEES</b></p>
            <div class="divider"></div>
            <p id="totalEmp"><b><?php echo $noOfEmployees; ?></b></p>
          </div>
      </div>     
    </div>
    <div class="col s12 m3 l3">
      <div class="card green darken-1" style="">
          <div class="card-content white-text" style="line-height: 1.8">
            <p><b>MONTHLY &nbsp; PAID &nbsp; EMPLOYEES</b></p>
            <div class="divider"></div>
            <p id="monthlyEmp"><b><?php echo $noOfMonthlyPaid; ?></b></p>
          </div>
      </div>     
    </div>    
    <div class="col s12 m3 l3">
      <div class="card green darken-1" style="">
          <div class="card-content white-text" style="line-height: 1.8">
            <p><b>DAILY &nbsp; PAID &nbsp; EMPLOYEES</b></p>
            <div class="divider"></div>
            <p id="dailyEmp"><b><?php echo $noOfDailyPaid; ?></b></p>
          </div>
      </div>      
    </div>         
  </div> 

  <div class="row"  id="employeeRows"></div>           
</body>
</html>
<?php
 mysqli_close($conn);
?>