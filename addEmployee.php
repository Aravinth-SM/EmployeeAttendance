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
      [type="checkbox"] + label, [type="radio"] + label {
        pointer-events: auto;
      }
  </style>

  <script type="text/javascript">

    $(document).ready(function(){    
      $('select').material_select();
      $(".button-collapse").sideNav();
      $(".dropdown-button").dropdown({ hover: true });
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
      })
    });

    function showBankDiv() {
        var x = document.getElementsByClassName("bank");
        var state = document.getElementById('bank').value;
        var val = "";

        if(state == "off") {
          val = "block";
          document.getElementById('bank').value = "on";
        }
        else {
          val = "none";
          document.getElementById('bank').value = "off";
        }

        x[0].style.display = val;
        x[1].style.display = val;
        x[2].style.display = val;
    }

    function toggleCheck(id) {
      var state = document.getElementById(id).value;
      if(state == "off") {
        document.getElementById(id).value = "on";
      }
      else {
        document.getElementById(id).value = "off";
      }      
    }

  </script>
</head>
<body>
  <!-- Dropdown Structure Open -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
    <li><a href="settings.php">Variables</a></li>
  </ul>  
  <!-- Dropdown Structure Close -->
  <!-- Dropdown Structure Open -->
  <ul id="dropdown2" class="dropdown-content">
    <li><a href="profile.php">Profile</a></li>
    <li class="divider"></li>
    <li><a href="settings.php">Variables</a></li>
  </ul>  
  <!-- Dropdown Structure Close -->  
  <nav>
    <div class="nav-wrapper blue-grey darken-3">
      &nbsp;&nbsp;&nbsp;
      <a href="index.php" class="brand-logo helloFont1">Flubbers</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="viewAttendance.php">Home</a></li>
        <li class="active"><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Settings<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li class="active"><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Settings<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>
    </div>
  </nav>  
  <div class="row" align="center">
    <div class="col s12 m3 l3">
      <br/>
    </div>
    <div class="col s12 m6 l6">
      <form method="post" novalidate>
        <div class="row">
          <div class="input-field col s12">
            <input id="name" name="name" type="text" class="validate" required="required" autofocus="autofocus">
            <label for="name">Employee Name</label>
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field">
            <div class="btn">
              <span>Photo</span>
              <input type="file">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">      
            <p>
              <input name="gender" type="radio" id="male" value="male" checked />
              <label for="male">Male</label>
            </p>
          </div>
          <div class="input-field col s6">         
            <p>
              <input name="gender" type="radio" id="female" value="female" />
              <label for="female">Female</label>
            </p>
          </div>
        </div>        
        <div class="row">
          <div class="input-field col s12">
            <textarea id="address" name="address" class="materialize-textarea" required="required"></textarea>
            <label for="address">Address</label>
          </div>
        </div>        
        <div class="row">
          <div class="input-field col s12">
            <input id="dob" name="dob" type="text" class="datepicker">
            <label for="dob">DOB</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="phone" name="phone" type="text" class="validate" required="required">
            <label for="phone">Phone number</label>
          </div>
        </div>              
        <div class="row">
          <div class="input-field col s6">      
            <p>
              <input name="workType" type="radio" id="monthly" checked value="monthly" />
              <label for="monthly">Monthly salary</label>
            </p>
          </div>
          <div class="input-field col s6">         
            <p>
              <input name="workType" type="radio" id="daily" value="daily" />
              <label for="daily">Daily wages</label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="doj" name="doj" type="text" class="datepicker">
            <label for="doj">DOJ</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="s_doj" name="s_doj" type="text" class="datepicker">
            <label for="s_doj">Secondary DOJ</label>
          </div>
        </div>        
        <div class="input-field col s12">
          <select name="plant" id="plant">
            <option value="" disabled selected>Choose your option</option>
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
        <div class="row">
          <div class="input-field col s12">
            <input id="salary" name="salary" type="text" class="validate" required="required">
            <label for="salary">Salary</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">      
            <p>
              <input name="busFare" type="checkbox" value="off" onchange="toggleCheck(this.id);" class="filled-in" id="bus" />
              <label for="bus">Bus fare</label>
            </p>
          </div>
          <div class="input-field col s6">         
            <p>
              <input name="messFare" type="checkbox" value="off" onchange="toggleCheck(this.id);" class="filled-in" id="mess" />
              <label for="mess">Mess fare</label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">      
            <p>
              <input name="pf" type="checkbox" value="off" onchange="toggleCheck(this.id);" class="filled-in" id="pf" />
              <label for="pf">PF</label>
            </p>
          </div>
          <div class="input-field col s6">         
            <p>
              <input name="esi" type="checkbox" value="off" onchange="toggleCheck(this.id);" class="filled-in" id="esi" />
              <label for="esi">ESI</label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">         
            <p>
              <input name="fixedSalary" type="checkbox" value="off" onchange="toggleCheck(this.id);" class="filled-in" id="fixedSalary" />
              <label for="fixedSalary">Fixed Salary</label>
              &nbsp;&nbsp;&nbsp;<i class="material-icons amber-text tooltipped" data-position="top" data-delay="50" data-tooltip="Paid full salary irrespective of attendance" style="cursor: pointer;">error_outline</i>
            </p>
          </div>          
          <div class="input-field col s6">
            <p>
              <input name="isBank" type="checkbox" class="filled-in" value="off" id="bank" onchange="showBankDiv();" />
              <label for="bank">Bank Account</label>
            </p>
          </div> 
        </div>
        <div class="row bank" style="display: none;">
          <div class="input-field col s12">
            <input id="accNo" name="accNo" type="text" class="validate" required="required">
            <label for="accNo">Account Number</label>
          </div>
        </div>
        <div class="row bank" style="display: none;">
          <div class="input-field col s12">
            <input id="branchName" name="branchName" type="text" class="validate" required="required">
            <label for="branchName">Branch Name</label>
          </div>
        </div> 
        <div class="row bank" style="display: none;">
          <div class="input-field col s12">
            <input id="branchCode" name="branchCode" type="text" class="validate" required="required">
            <label for="branchCode">Branch Code</label>
          </div>
        </div>                                      
<br/><br/><br/>
        <div class="row">
          <button class="waves-effect waves-light btn" id="submit" name="submit">SAVE</button> &nbsp;&nbsp;&nbsp;
          <button onclick="location.reload();" class="waves-effect waves-light btn red-text white">RESET</button><br/>
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

  include("DB/db.php");

   $queryEmp = "select * from employee";
   $exeEmp = mysqli_query($conn,$queryEmp);
   
   $empId = mysqli_num_rows($exeEmp) + 1;

  $name = $_POST["name"];
  $workType = $_POST["workType"];
  $salary = $_POST["salary"];   
  $phone = $_POST["phone"];
  $dob = $_POST["dob"];
  $doj = $_POST["doj"];
  $s_doj = $_POST["s_doj"];
  $address = $_POST["address"];  

  $gender = $_POST["gender"];
  $plant = $_POST["plant"];
  $busFare = $_POST["busFare"];
  $messFare = $_POST["messFare"]; 
  $pf = $_POST["pf"];
  $esi = $_POST["esi"];
  $fixedSalary = $_POST["fixedSalary"];
  $isBank = $_POST["isBank"]; 
  $accNo = 0;
  $branchName = "";
  $branchCode = 0;

  if($busFare == "on") {
    $busFare = 1;
  } 
  else {
    $busFare = 0;
  } 

  if($messFare == "on") {
    $messFare = 1;
  } 
  else {
    $messFare = 0;
  }

  if($pf == "on") {
    $pf = 1;
  } 
  else {
    $pf = 0;
  }

  if($esi == "on") {
    $esi = 1;
  } 
  else {
    $esi = 0;
  }

  if($fixedSalary == "on") {
    $fixedSalary = 1;
  } 
  else {
    $fixedSalary = 0;
  }         

  if($isBank == "on") {
    $accNo      = $_POST["accNo"];
    $branchName = $_POST["branchName"];
    $branchCode = $_POST["branchCode"];    
  }

  //echo $gender."<br/>".$plant."<br/>".$busFare."<br/>".$messFare."<br/>".$pf."<br/>".$esi."<br/>".$accNo."<br/>".$branchName."<br/>".$branchCode;

  //echo $name."<br/>".$empId."<br/>".$phone."<br/>".$address."<br/>".$dob."<br/>".$doj."<br/>".$s_doj."<br/>".$workType."<br/>".$salary;
  if( ($empId=="")||($name=="")||($workType=="")||($salary=="")||($phone=="")||($dob=="")||($doj=="")||($s_doj=="")||($address=="")||($gender=="")||($plant=="") )
  {
      echo '<script>Materialize.toast("Enter all details",6000,"rounded");</script>';
      //header("location:addEmployee.php");    
  }
  else
  {

   $queryCheck = "select * from employee where emp_id='".$empId."'";
   $exeCheck = mysqli_query($conn,$queryCheck);
   
   if(mysqli_num_rows($exeCheck) > 0) {
      echo '<script>Materialize.toast("Employee ID already exists",6000,"rounded");</script>';
      //header("location:addEmployee.php");
   }
   else { 

     $execute = mysqli_query($conn,"insert into employee (emp_id,name,type,salary,phone,DOB,DOJ,secondary_DOJ,address,fixed_salary,PF,ESI,gender,busFare,messFare,plant,bankAccountNumber,branchCode,branchName) values('".$empId."','".$name."','".$workType."','".$salary."','".$phone."','".$dob."','".$doj."','".$s_doj."','".$address."','".$fixedSalary."','".$pf."','".$esi."','".$gender."','".$busFare."','".$messFare."','".$plant."','".$accNo."','".$branchCode."','".$branchName."')");

     if($execute == 1)
     {
      echo '<script>Materialize.toast("Employee added successfully",6000,"rounded");</script>';
      //header("location:employeeRecords.php");
     }

     else
     {
      echo '<script>Materialize.toast("Cannot add employee",6000,"rounded");</script>';
      //header("location:addEmployee.php");
     }
   }
  }
  mysqli_close($conn);
}

?>