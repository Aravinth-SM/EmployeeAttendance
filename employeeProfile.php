<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Employee Profile</title>  
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
       // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.collapsible').collapsible();
        $('select').material_select();
        $('.modal-trigger').leanModal();
        $(".button-collapse").sideNav();

  $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
      complete: function() { location.reload(); } // Callback for Modal close
    }
  );

        });

      function loadDatas(empId) {
        var month = document.getElementById("month").value;
        var year = document.getElementById("year").value;
        if ( (month == "") || (year == "") ) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var val = this.responseText;
                  var splitedVal = val.split(":");
                    //document.getElementById("monthAttendance").innerHTML = this.responseText;
                    document.getElementById("empPresent").innerHTML = "Present - "+splitedVal[0];
                    document.getElementById("empAbsent").innerHTML = "Absent -"+splitedVal[1];
                    document.getElementById("empHoliday").innerHTML = "Holidays -"+splitedVal[2];
                }
            }
            xmlhttp.open("GET", "loadDatasMonthAttendance.php?month="+month+"&year="+year+"&empId="+empId, true);
            xmlhttp.send();
          }        
      }      

      function showMonthAttendance(empId) {
        var month = document.getElementById("month").value;
        var year = document.getElementById("year").value;
        if ( (month == "") || (year == "") ) { 
          return;
        } else {
            loadDatas(empId);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("monthAttendance").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "fetchMonthAttendance.php?month="+month+"&year="+year+"&empId="+empId, true);
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
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="attendanceRecords.php">Attendance Records</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>
    </div>
  </nav>  
<?php
   include("DB/db.php");
   $id = intval($_GET['id']);
   $query = "select * from employee where id=".$id;
   $exe = mysqli_query($conn,$query);
   $employee = mysqli_fetch_assoc($exe)
?>   
  <div class="row" align="center">
    <div class="col s12 m6 l6">
      <br/>
      <img src="images/img_avatar.png" alt="Avatar" style="width:200px">
      <br/>
      <ul class="collapsible popout" data-collapsible="accordion" style="width: 500px;">
       <li>
         <div class="collapsible-header active teal-text">
            <i class="material-icons">assignment</i><b>Salary Structure</b>
         </div>
         <div class="collapsible-body">
            <table class=" centered">
              <thead>
                <tr>
                    <th>Component</th>
                    <th>Rs.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>BASIC</td>
                  <td>4500.00</td>
                </tr>
                <tr>
                  <td>HRA</td>
                  <td>2100.00</td>
                </tr>
                <tr>
                  <td>ALLOWANCE</td>
                  <td>3200.00</td>
                </tr>
                <tr>
                  <td>EMPLOYER PF</td>
                  <td>600.00</td>
                </tr>
                <tr>
                  <td>TOTAL</td>
                  <td>10400.00</td>
                </tr>                                
              </tbody>
            </table>
         </div>
       </li>
      </ul>
      <br/>
      <a class="waves-effect waves-light btn modal-trigger" href="#modalAttendance">VIEW ATTENDANCE</a>
      <!-- Modal Structure Open -->
      <div id="modalAttendance" class="modal" style="width: 1200px;max-height: 600px;">
         <div class="modal-content">

      <div class="row">      
         <div class="col s12 m4 l3">
          <div class="chip green white-text" id="empPresent" style="padding: 0 8px;">
            Present - 0
          </div>
          <div class="chip red white-text" id="empAbsent" style="padding: 0 8px;">
            Absent - 0
          </div>
          <div class="chip blue white-text" id="empHoliday" style="padding: 0 8px;">
            Holidays - 0
          </div>                    
         </div>       
         <div class="input-field col s3 m4 l3">
          <select id="month" name="month">
            <option value="" disabled selected>Choose month</option>
            <option value="1">January-01</option>
            <option value="2">Feburary-02</option>
            <option value="3">March-03</option>
            <option value="4">April-04</option>
            <option value="5">May-05</option>
            <option value="6">June-06</option>
            <option value="7">July-07</option>
            <option value="8">August-08</option>
            <option value="9">September-09</option>
            <option value="10">October-10</option>
            <option value="11">November-11</option>
            <option value="12">December-12</option>                                    
          </select>
          <label>Month</label>
         </div>
         <div class="input-field col s3 m4 l4">
          <select id="year" name="year">
            <option value="" disabled selected>Choose year</option>
            <option value="2013">2013</option>
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>            
          </select>
          <label>Year</label>
         </div> 
         <div class="col s12 m4 l2">
            <br/>
            <button class="waves-effect waves-light btn" onclick="showMonthAttendance('<?php echo $employee['emp_id']; ?>');">SUBMIT</button>
         </div>                                    
      </div>          
      <div class="divider" style="height: 4px;background-color :black;"></div><br/>
      <div class="row" id="monthAttendance"></div>

         </div>
      </div>
      <!-- Modal Structure Close -->     
    </div>
    <div class="col s12 m6 l6">
      <fom method="post">
      <div class="row">
       <div class="input-field col s12">
         <input id="name" name="name" type="text" class="validate" value="<?php echo $employee['name']; ?>">
         <label for="name">Employee Name</label>
       </div>
      </div>
      <div class="row">
       <div class="input-field col s12">
         <input id="empId" name="empId" type="text" class="validate" value="<?php echo $employee['emp_id']; ?>">
         <label for="empId">Employee ID</label>
       </div>
      </div>
      <div class="row">
       <div class="input-field col s12">
         <input id="phone" name="phone" type="text" class="validate" value="<?php echo $employee['phone']; ?>">
         <label for="phone">Phone number</label>
       </div>
      </div>
      <div class="row">
       <div class="input-field col s12">
         <input id="dob" name="dob" type="text" class="datepicker" value="<?php echo $employee['DOB']; ?>">
         <label for="dob">DOB</label>
       </div>
      </div>
      <div class="row">
       <div class="input-field col s12">
         <input id="doj" name="doj" type="text" class="datepicker" value="<?php echo $employee['DOJ']; ?>">
         <label for="doj">DOJ</label>
       </div>
      </div>      
      <div class="row">
       <div class="input-field col s6">      
         <p>
           <input name="workType" type="radio" id="monthly" value="monthly" 
               <?php 
                  if($employee['type']=="monthly")
                     echo "checked";
               ?>
           />
           <label for="monthly">Monthly salary</label>
         </p>
       </div>
       <div class="input-field col s6">         
         <p>
           <input name="workType" type="radio" id="daily" value="daily" 
               <?php 
                  if($employee['type']=="daily")
                     echo "checked";
               ?>
           />
           <label for="daily">Daily wages</label>
         </p>
       </div>
      </div>        
      <div class="row">
       <div class="input-field col s12">
         <input id="salary" name="salary" type="text" class="validate"  value="<?php echo $employee['salary']; ?>">
         <label for="salary">Salary</label>
       </div>
      </div>
      <div class="row">
       <div class="input-field col s12">
         <textarea id="address" name="address" class="materialize-textarea">
            <?php echo $employee['address']; ?>
         </textarea>
         <label for="address">Address</label>
       </div>
      </div><br/>
      <div class="row">
       <button class="waves-effect waves-light btn" id="submit" name="submit">EDIT</button> &nbsp;&nbsp;&nbsp;
       <button type="reset" class="waves-effect waves-light btn red-text white">RESET</button><br/>
      </div>  
      </fom>    
    </div>       
  </div>             
</body>
</html>
<?php
 mysqli_close($conn);
?>