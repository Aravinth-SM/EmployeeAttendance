<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Attendance Records</title>  
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
  </style>

  <script type="text/javascript">

    $(document).ready(function(){   
    $(".button-collapse").sideNav(); 
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
      });
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

      function loadDatas(date) {
        if (date == "") { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    var presentCount = parseInt(val);
                    if(presentCount==-1) {
                        document.getElementById('empPresent').innerHTML = "Present - 0";
                        document.getElementById('empAbsent').innerHTML = "Absent - 0"; 
                    }
                    else {
                        var totalCount = parseInt(document.getElementById('empTotal').getAttribute('data-val'));
                        var abCount = totalCount - presentCount;
                        document.getElementById('empPresent').innerHTML = "Present - "+presentCount;
                        document.getElementById('empAbsent').innerHTML = "Absent - "+abCount;                      
                    }
                    //document.getElementById('employeeRows').innerHTML=val;                       
                }
            }
            xmlhttp.open("GET", "loadDatasForDate.php?date="+date, true);
            xmlhttp.send();
          }        
      }    

      function fetchAttendance(date) {
        if (date == "") { 
          return;
        } else {
            loadDatas(date);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    document.getElementById('employeeRows').innerHTML=val;                       
                }
            }
            xmlhttp.open("GET", "fetchAttendanceForDate.php?date="+date, true);
            xmlhttp.send();
          }        
      }    

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
        <li class="active"><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li class="active"><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>      
    </div>
  </nav>  
  <div class="row" align="center">
<?php

   include("DB/db.php");
   date_default_timezone_set("Asia/Kolkata");  

   $query = "select * from employee where status=1";
   $exe = mysqli_query($conn,$query);
   $noOfEmployees = mysqli_num_rows($exe); 
   $noAbsent = 0;
   $noPresent = 0;  
  
?>     
    <div class="col s12 m3 l3">
      <br/>
      <div class="input-field col s12">
        <i class="material-icons prefix green-text text-darken-2">search</i>
        <input type="text" name="myInput" placeholder="Search Employee.." id="myInput"
          onkeyup="myFunction(<?php echo $noOfEmployees; ?>)" class="blue-grey-text text-darken-3">
      </div>
    </div>   
    <div class="col s12 m2 l2">
      <br/><br/>
      <div class="chip blue lighten-1 white-text" id="empTotal" style="padding: 0 24px;" data-val="<?php echo $noOfEmployees; ?>">
        Employees - <?php echo $noOfEmployees; ?>
      </div>
    </div>
    <div class="col s12 m2 l2">
      <br/><br/>    
      <div class="chip green lighten-1 white-text" id="empPresent" style="padding: 0 24px;">
        Present - <?php echo $noPresent; ?>
      </div>
    </div>
    <div class="col s12 m2 l2">
      <br/><br/>    
      <div class="chip red lighten-1 white-text" id="empAbsent" style="padding: 0 24px;">
        Absent - <?php echo $noAbsent; ?>
      </div>    
    </div>  
    <div class="col s12 m3 l3">
      <br/>
        <div class="input-field col s10">
          <input id="date" name="date" type="text" class="datepicker" onchange="fetchAttendance(this.value);"/>
          <label for="date">DATE</label>
        </div>
  
    </div>            
  </div> 
 <div class="row" id="employeeRows">  </div>
           
</body>
</html>
<?php
 mysqli_close($conn);
?>