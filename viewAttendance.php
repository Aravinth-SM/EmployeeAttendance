<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Today's Attendance</title>  
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

      function markHoliday(param,length) {
        var date = param.getAttribute("data-date");
        var data = param.getAttribute("data");

        if ((date == "") || (data == "")) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    if(val=='1') {
                      if(data=="holiday") {
                        param.innerHTML = "MARK AS WORKING DAY";//solid 2px #ff6f00
                        param.setAttribute("data","working");
                        param.style.border = "solid 2px #455a64";
                        param.classList.remove('amber-text');
                        param.classList.add('blue-grey-text');
                        document.getElementById('employeeRows').style.display="none";
                        document.getElementById('empPresent').innerHTML = "Present - 0";
                        document.getElementById('empAbsent').innerHTML = "Absent - 0";                        
                      }
                      else {
                        param.innerHTML = "MARK AS HOLIDAY";
                        param.setAttribute("data","holiday");
                        param.style.border = "solid 2px #ff6f00";
                        param.classList.remove('blue-grey-text');
                        param.classList.add('amber-text');
                        document.getElementById('employeeRows').style.display="block";
                        document.getElementById('empPresent').innerHTML = "Present - 0";
                        document.getElementById('empPresent').setAttribute("data-val",0);
                        var count = document.getElementById('empTotal').getAttribute('data-val');
                        document.getElementById('empAbsent').innerHTML = "Absent - "+count;
                        document.getElementById('empAbsent').setAttribute("data-val",count);  

                        var j=0;
                        for(j=0;j<length;j++) {
                          var empJ = "emp"+j;
                          var empJ_elm = document.getElementById(empJ);
                          empJ_elm.classList.remove('green');
                          empJ_elm.classList.remove('amber');
                          empJ_elm.classList.add('blue');
                          empJ_elm.setAttribute("data-status","ab");
                          var empJ_id = empJ_elm.getAttribute("data-empId");
                          document.getElementById("attendanceStatus"+empJ_id).innerHTML= "<P>IN&nbsp;&nbsp;-&nbsp;</P><P>O&nbsp;&nbsp;&nbsp;-&nbsp;</P><P>OT&nbsp;-&nbsp;</P>";
                        }

                      }
                    }
                }
            }
            xmlhttp.open("GET", "markHolidayOrNot.php?date="+date+"&data="+data, true);
            xmlhttp.send();
          }        
      }

      function markAttendance(param) {
        var data_empId = param.getAttribute("data-empId");
        var data_status = param.getAttribute("data-status");

        if ((data_empId == "") || (data_status == "") || (data_status == "out")) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    var atStatus = "attendanceStatus"+data_empId;
                    if(val!='') {
                      if(data_status=="ab") {
                        param.setAttribute("data-status","in");
                        document.getElementById(atStatus).innerHTML = val;
                        var empPresentVal = parseInt(document.getElementById('empPresent').getAttribute('data-val'));
                        empPresentVal = empPresentVal + 1;
                        document.getElementById('empPresent').setAttribute("data-val",empPresentVal);
                        document.getElementById('empPresent').innerHTML = "Present - "+empPresentVal;

                        var empAbsentVal = parseInt(document.getElementById('empAbsent').getAttribute('data-val'));
                        empAbsentVal = empAbsentVal - 1;
                        document.getElementById('empAbsent').setAttribute("data-val",empAbsentVal);
                        document.getElementById('empAbsent').innerHTML = "Absent - "+empAbsentVal;

                        param.classList.remove('blue');
                        param.classList.add('green');
                      }
                      else {
                        param.setAttribute("data-status","out");
                        document.getElementById(atStatus).innerHTML = val;
                        param.classList.remove('green');
                        param.classList.add('amber');
                      }
                    }
                }
            }
            xmlhttp.open("GET", "markInOut.php?empId="+data_empId+"&data="+data_status, true);
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
        <li class="active"><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li class="active"><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>      
    </div>
  </nav>   
  <div class="row" align="center">
<?php

   include("DB/db.php");
   date_default_timezone_set("Asia/Kolkata");
   $current_display_date = date("d-M-Y");//YYYY-MM-DD  d-M-Y
   $current_date = date("Y-m-d");   

   $query = "select * from attendance where date='".$current_date."'";
   $exe = mysqli_query($conn,$query);
   $noPresent = mysqli_num_rows($exe);  

   $query = "select * from employee where status=1";
   $exe = mysqli_query($conn,$query);
   $noOfEmployees = mysqli_num_rows($exe);   

   $noAbsent = $noOfEmployees-$noPresent;

   $queryHoliday = "select * from holidays where date='".$current_date."'";
   $exeHoliday = mysqli_query($conn,$queryHoliday);
   
   if(mysqli_num_rows($exeHoliday) > 0) {   
      $isHoliday = "true";
      $noAbsent = 0;
      $noPresent = 0;
   }
   else {
      $isHoliday = "false";
   }   

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
      <div class="chip green lighten-1 white-text" id="empPresent" style="padding: 0 24px;" data-val="<?php echo $noPresent; ?>">
        Present - <?php echo $noPresent; ?>
      </div>
    </div>
    <div class="col s12 m2 l2">
      <br/><br/>    
      <div class="chip red lighten-1 white-text" id="empAbsent" style="padding: 0 24px;" data-val="<?php echo $noAbsent; ?>">
        Absent - <?php echo $noAbsent; ?>
      </div>    
    </div>  
    <div class="col s12 m3 l3">
      <br/>
      <label class="grey-text text-darken-2" style="font-size: 15px;"><b>Date : </b></label>&nbsp;&nbsp;&nbsp;<label class="green-text" style="font-size: 15px;"><b><?php echo $current_display_date; ?></b></label>
      <br/>
        <?php 
          if($isHoliday=="false") {
        ?>
      <button class="white amber-text text-darken-4 btn" onclick="markHoliday(this,<?php echo $noOfEmployees; ?>);" data="holiday" data-date="<?php echo $current_date; ?>" style="border: solid 2px #ff6f00;">MARK AS HOLIDAY</button>
        <?php
          }
          else {
        ?>
      <button class="white  blue-grey-text text-darken-2 btn" onclick="markHoliday(this,<?php echo $noOfEmployees; ?>);" data="working" data-date="<?php echo $current_date; ?>" style="border: solid 2px #455a64 ;">MARK AS WORKING DAY</button>        
        <?php    
          }
        ?>
    </div>            
  </div> 

<?php 
  if($isHoliday=="false") {
?>
  <div class="row" id="employeeRows">
<?php
  }
  else {
?>
  <div class="row" id="employeeRows" style="display: none;">
<?php    
  }
?>

<?php
   $i = -1;
  while($employee = mysqli_fetch_assoc($exe))
    {
      $i++;

      $empId = $employee["emp_id"];
      $empStatus = "";
      $empColor = "";
      $empIN = "";
      $empOUT = "";
      $empOT = "";

   $empQuery = "select * from attendance where emp_id='".$empId."' and date='".$current_date."'";
   $empExe = mysqli_query($conn,$empQuery);
   
   if(mysqli_num_rows($empExe) > 0)
   {
      while($empRow = mysqli_fetch_assoc($empExe))
      {
            $empIN = $empRow['in_time'];
            $t1_explode = explode(":", $empIN);
            $empIN = $t1_explode[0].':'.$t1_explode[1];

            $empOUT = $empRow['out_time'];
            if($empOUT!="") {
              $t1_explode = explode(":", $empOUT);
              $empOUT = $t1_explode[0].':'.$t1_explode[1];              
            }
 

            $empOT = $empRow['duration'];
            if($empOT!="") {
              $t1_explode = explode(":", $empOT);
              $empOT = $t1_explode[0].':'.$t1_explode[1]; 
            }
            

            if($empOUT=="") {
              $empStatus = "in";
              $empColor = "green";
            }
            else {
              $empStatus = "out";
              $empColor = "amber";              
            }
      }
   }
   else {
      $empStatus = "ab";
      $empColor = "blue";
   }      
?>     
    <div class="col s12 m4 l2" id="<?php echo "employee".$i ?>" data="<?php echo $employee['name']; ?>">
      <div class="card <?php echo $empColor; ?> lighten-1"  id="<?php echo "emp".$i ?>" style="border-radius: 6%;height: 115px;cursor: pointer;" onclick="markAttendance(this);" data-status="<?php echo $empStatus; ?>" data-empId="<?php echo $employee['emp_id']; ?>">
        <div class="card-content white-text">
          <div class="row" align="center" style="line-height: 0">
            <p><?php echo $employee["name"]; ?></p>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col s2" style="line-height: 2;">
              <div class="divider" style="height: 9px;background-color :transparent;"></div>
              <img src="images/img_avatar.png" alt="Avatar" style="width:40px;"><br/>
              <p><?php echo $employee["emp_id"]; ?></p>
            </div> 
            <div class="col s1">
              &nbsp;
            </div>
            <div class="col s1" style="font-size: 18px;line-height : 1;">
              <p>|</p>
              <p>|</p>
              <p>|</p>
              <p>|</p>
            </div>                      
            <div class="col s6">
              <div class="divider" style="height: 5px;background-color :transparent;"></div>
              <div id="<?php echo 'attendanceStatus'.$employee['emp_id']; ?>">
                <P>IN&nbsp;&nbsp;-&nbsp;<?php echo $empIN; ?></P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $empOUT; ?></P>
                <P>OT&nbsp;-&nbsp;<?php echo $empOT; ?></P>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </div>
<?php
    }
?>    
  </div>           
</body>
</html>
<?php
 mysqli_close($conn);
?>