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
    .w3-modal{
      z-index:3;display:none;padding-top:100px;position:fixed;left:0;top:0;width:100%;height:100%;overflow:auto;background-color:rgb(0,0,0);background-color:rgba(0,0,0,0.4)
    }
    .w3-modal-content{
      margin:auto;background-color:#fff;position:relative;padding:0;outline:0;width:600px
    }
    @media (max-width:600px){
      .w3-modal-content{
        margin:0 10px;width:auto!important
      }
      .w3-modal{
        padding-top:30px
      }
    }
    @media (max-width:768px){
      .w3-modal-content{
        width:500px
      }
      .w3-modal{
        padding-top:50px
      }
    }
    @media (min-width:993px){
      .w3-modal-content{
        width:600px
      }
    }  
    .w3-display-topright{
      position:absolute;right:0;top:0
    }
    .w3-button{
      border:none;display:inline-block;outline:0;padding:8px 16px;vertical-align:middle;overflow:hidden;text-decoration:none;color:inherit;background-color:inherit;text-align:center;cursor:pointer;white-space:nowrap
    }
    .w3-button:hover{
      color:#000!important;background-color:#ccc!important
    }
  </style>

  <script type="text/javascript">

    $(document).ready(function(){   
      $('select').material_select();
      $(".button-collapse").sideNav(); 
      $('.datepicker').pickadate({
        min: [2017,9,20],
        max: [2018,11,29],      
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 10, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
      });
      $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: true, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
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

    function modalOpen(name,id,inTime,outTime,otTime,divId) {
      document.getElementById("emp_name_time").innerHTML = "<b>"+name+"</b>";
      document.getElementById("emp_id_time").value = id;
      document.getElementById("div_id_time").value = divId;
      document.getElementById("in_time").value = inTime;
      if( outTime != "" ) {
        document.getElementById("out_time").value = outTime;
      }
      if( otTime != "" ) {
        document.getElementById("ot_time").value = otTime;
      }
      document.getElementById('id01').style.display ='block';
    }

    function resetModalOpen() {
      document.getElementById("emp_id_time").value = "";
      document.getElementById("div_id_time").value = "";
      document.getElementById("in_time").value = "";
      document.getElementById("out_time").value = "";
      document.getElementById("ot_time").value = "";
      document.getElementById('id01').style.display ='none';
    }    

      function markHoliday(param,length) {
        var date = document.getElementById("date").value;
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
                          empJ_elm.classList.remove('red');
                          empJ_elm.classList.add('red');
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

      function markAttendance() {
      var data_empId = document.getElementById("emp_id_time").value;
      var div_id_time = document.getElementById("div_id_time").value;
      var in_time = document.getElementById("in_time").value;
      var out_time = document.getElementById("out_time").value;
      var ot_time = document.getElementById("ot_time").value;
      var date = document.getElementById("date").value;

        var data_status = document.getElementById(div_id_time).getAttribute("data-status");

        if ((data_empId == "") || (in_time == "")) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    var atStatus = "attendanceStatus"+data_empId;
                    if(val!='') {
                      if(data_status=="ab") {
                        document.getElementById(div_id_time).setAttribute("data-status","in");
                        document.getElementById(atStatus).innerHTML = val;
                        var empPresentVal = parseInt(document.getElementById('empPresent').getAttribute('data-val'));
                        empPresentVal = empPresentVal + 1;
                        document.getElementById('empPresent').setAttribute("data-val",empPresentVal);
                        document.getElementById('empPresent').innerHTML = "Present - "+empPresentVal;

                        var empAbsentVal = parseInt(document.getElementById('empAbsent').getAttribute('data-val'));
                        empAbsentVal = empAbsentVal - 1;
                        document.getElementById('empAbsent').setAttribute("data-val",empAbsentVal);
                        document.getElementById('empAbsent').innerHTML = "Absent - "+empAbsentVal;

                        document.getElementById(div_id_time).classList.remove('red');
                        document.getElementById(div_id_time).classList.add('green');
                      }
                      else {
                        document.getElementById(div_id_time).setAttribute("data-status","out");
                        document.getElementById(atStatus).innerHTML = val;
                      }
                    }
                    resetModalOpen();
                }
            }
            xmlhttp.open("GET", "markInOut.php?empId="+data_empId+"&in_time="+in_time+"&out_time="+out_time+"&ot_time="+ot_time+"&data_status="+data_status+"&date="+date, true);
            xmlhttp.send();
          }        
      }

      function loadDatas(val,date) {
        if ( (val == "") || (date == "") ) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    var splitedVal = val.split(":");

                    totalEmpVal = splitedVal[0];
                    document.getElementById('empTotal').setAttribute("data-val",totalEmpVal);
                    document.getElementById('empTotal').innerHTML = "Employees - "+totalEmpVal;

                    empPresentVal = splitedVal[1];
                    document.getElementById('empPresent').setAttribute("data-val",empPresentVal);
                    document.getElementById('empPresent').innerHTML = "Present - "+empPresentVal;

                    empAbsentVal = splitedVal[2];
                    document.getElementById('empAbsent').setAttribute("data-val",empAbsentVal);
                    document.getElementById('empAbsent').innerHTML = "Absent - "+empAbsentVal;
                    //document.getElementById('employeeRows').innerHTML=val;                       
                }
            }
            xmlhttp.open("GET", "loadDatasForPlant_Date.php?plant="+val+"&date="+date, true);
            xmlhttp.send();
          }        
      }       

      function fetchEmployees() {
        var val = document.getElementById('plant').value;
        var date = document.getElementById('date').value;
        if ( (val == "") || (date == "") ) { 
          return;
        } else {
            loadDatas(val,date);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    if(val[0]!="-") {
                      document.getElementById('employeeRows').innerHTML=val;
                      document.getElementById('employeeRows').style.display="block";
                      document.getElementById('holiday_working_btn').innerHTML = "MARK AS HOLIDAY";
                      document.getElementById('holiday_working_btn').setAttribute("data","holiday");
                      document.getElementById('holiday_working_btn').style.border = "solid 2px #ff6f00";
                      document.getElementById('holiday_working_btn').classList.remove('blue-grey-text');
                      document.getElementById('holiday_working_btn').classList.add('amber-text');
                    }
                    else {
                      document.getElementById('employeeRows').style.display="none";
                      document.getElementById('holiday_working_btn').innerHTML = "MARK AS WORKING DAY";
                      document.getElementById('holiday_working_btn').setAttribute("data","working");
                      document.getElementById('holiday_working_btn').style.border = "solid 2px #455a64";
                      document.getElementById('holiday_working_btn').classList.remove('amber-text');
                      document.getElementById('holiday_working_btn').classList.add('blue-grey-text');                      
                    }
                }
            }
            xmlhttp.open("GET", "fetchEmployeesForPlant_Date.php?plant="+val+"&date="+date, true);
            xmlhttp.send();
          }        
      }             

  </script>
</head>
<body onload="fetchEmployees();">
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
 <!--  <input id="time" name="time" type="text" class="timepicker" /> -->
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
        <select name="plant" id="plant" onchange="fetchEmployees();">
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
<!--       <label class="grey-text text-darken-2" style="font-size: 15px;"><b>Date : </b></label>&nbsp;&nbsp;&nbsp;<label class="green-text" style="font-size: 15px;"><b><?php echo $current_display_date; ?></b></label> -->
      <div class="input-field col s10">
        <input id="date" name="date" type="text" class="datepicker" onchange="fetchEmployees();" value="<?php echo $current_display_date; ?>" />
        <label for="date">DATE</label>
      </div>

      <br/>
        <?php 
          if($isHoliday=="false") {
        ?>
      <button class="white amber-text text-darken-4 btn" onclick="markHoliday(this,<?php echo $noOfEmployees; ?>);" data="holiday" id="holiday_working_btn" style="border: solid 2px #ff6f00;">MARK AS HOLIDAY</button>
        <?php
          }
          else {
        ?>
      <button class="white  blue-grey-text text-darken-2 btn" onclick="markHoliday(this,<?php echo $noOfEmployees; ?>);" data="working" id="holiday_working_btn" style="border: solid 2px #455a64 ;">MARK AS WORKING DAY</button>        
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
</div>     

<!-- Modal Structure Open -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <div class="row">
        <div class="col s12 m2 l2">
          <br/>
        </div>        
        <div class="col s12 l8 m8 blue-grey darken-3" align="center">
          <p id="emp_name_time" class="white-text"></p>
        </div>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      </div>
      <div class="row">
        <div class="col s12 m2 l2">
          <br/>
        </div>
        <div class="col s12 m8 l8">
          <input type="hidden" name="emp_id_time" id="emp_id_time"/>
          <input type="hidden" name="div_id_time" id="div_id_time"/>
          <div class="row">
            <div class="col s12 m6 l6">
              <p>IN</p>
            </div>
            <div class="col s12 m6 l6">
              <input type="text" name="in_time" id="in_time" class="timepicker"/>
            </div>
          </div>
          <div class="row">
            <div class="col s12 m6 l6">
              <p>OUT</p>
            </div>
            <div class="col s12 m6 l6">
              <input type="text" name="out_time" id="out_time" class="timepicker"/>
            </div>
          </div>
          <div class="row">
            <div class="col s12 m6 l6">
              <p>OT</p>
            </div>
            <div class="col s12 m6 l6">
              <input type="text" name="ot_time" id="ot_time" class="validate"/>
            </div>
          </div> 
          <div class="row" align="center">
           <button class="waves-effect waves-light btn" onclick="markAttendance();">SUBMIT</button>
           &nbsp;&nbsp;&nbsp;
           <button class="waves-effect waves-light btn red-text white" onclick="document.getElementById('id01').style.display='none';">CANCEL</button>
          </div>                              
        </div>
        <div class="col s12 m2 l2">
          <br/>
        </div>
      </div>
    </div>
  </div>
</div>  
<!-- Modal Structure Close --> 

</body>
</html>
<?php
 mysqli_close($conn);
?>