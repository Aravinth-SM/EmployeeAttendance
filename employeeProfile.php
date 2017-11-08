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
      @font-face { 
        font-family: Gumption lite; 
        src: url('fonts/Gumption-lite.ttf'); 
      } 
      .helloFont1 {
        font-family:"Gumption lite";
      }
      td,th {
        padding: 10px 5px;
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
        });
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

      function deleteEmp(empId) {
        if(empId == "") { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var state = this.responseText;
                    window.location.href = "employeeRecords.php";
                }
            }
            xmlhttp.open("GET", "changeEmployeeStatus.php?empId="+empId, true);
            xmlhttp.send();
          }        
      }      

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

<?php

$salary = $employee['salary'];
$pf     = $employee['PF'];
$esi    = $employee['ESI'];
$isBusFare = $employee['busFare'];
$isMessFare = $employee['messFare'];
$bankAccountNumber = $employee['bankAccountNumber'];

if($isBusFare)
  $busFare = 20;
else
  $busFare = 0;

if($isMessFare)
  $messFare = 200;
else
  $messFare = 0;

$total = $salary - $pf - $esi - $busFare - $messFare;

?>

         <div class="collapsible-body">
            <table class="highlight centered">
              <thead style="border-top: 1px solid black;border-bottom: 1px solid black;font-size: 16px;">
                <tr>
                    <th>COMPONENTS</th>
                    <th>Rs.</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>BASIC</td>
                  <td><?php echo $salary; ?>.00</td>
                </tr>
                <tr>
                  <td>PF</td>
                  <td><?php echo $pf; ?>.00</td>
                </tr>
                <tr>
                  <td>ESI</td>
                  <td><?php echo $esi; ?>.00</td>
                </tr>
                <tr>
                  <td>BUS FARE</td>
                  <td><?php echo $busFare; ?>.00</td>
                </tr>
                <tr>
                  <td>MESS FARE</td>
                  <td><?php echo $messFare; ?>.00</td>
                </tr>                
                <tr style="border-top: 1px solid black;font-size: 15px;">
                  <td><b>TOTAL</b></td>
                  <td><b><?php echo $total; ?>.00</b></td>
                </tr>                                
              </tbody>
            </table>
         </div>
       </li>
      </ul>
      <br/>
      <a class="waves-effect waves-light btn modal-trigger" href="#modalAttendance">VIEW ATTENDANCE</a>
      &nbsp;&nbsp;&nbsp;
      <button class="waves-effect waves-light btn red-text white" onclick="deleteEmp(<?php echo $employee['emp_id']; ?>);">DELETE EMPLOYEE</button>
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
      <form method="post">
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
            <input name="gender" type="radio" id="male" value="male" 
               <?php 
                  if($employee['gender']=="male")
                     echo "checked";
               ?>
            />
            <label for="male">Male</label>
          </p>
        </div>
        <div class="input-field col s6">         
          <p>
            <input name="gender" type="radio" id="female" value="female" 
               <?php 
                  if($employee['gender']=="female")
                     echo "checked";
               ?>
            />
            <label for="female">Female</label>
          </p>
        </div>
      </div> 
      <div class="row">
       <div class="input-field col s12">
         <textarea id="address" name="address" class="materialize-textarea">
            <?php echo $employee['address']; ?>
         </textarea>
         <label for="address">Address</label>
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
         <input id="phone" name="phone" type="text" class="validate" value="<?php echo $employee['phone']; ?>">
         <label for="phone">Phone number</label>
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
         <input id="doj" name="doj" type="text" class="datepicker" value="<?php echo $employee['DOJ']; ?>">
         <label for="doj">DOJ</label>
       </div>
      </div>
      <div class="input-field col s12">
        <select name="plant" id="plant">
          <option value="" disabled>Choose your option</option>
          <option value="Jelly"
<?php 
    if($employee['plant']=="Jelly")
      echo "selected";
 ?>
          >Jelly</option>
          <option value="Waffer"
<?php 
    if($employee['plant']=="Waffer")
      echo "selected";
 ?>
          >Waffer</option>
          <option value="Cup"
<?php 
    if($employee['plant']=="Cup")
      echo "selected";
 ?>
          >Cup</option>
          <option value="Toy_Jar"
<?php 
    if($employee['plant']=="Toy_Jar")
      echo "selected";
 ?>
          >Toy & Jar</option>
          <option value="Lollypop"
<?php 
    if($employee['plant']=="Lollypop")
      echo "selected";
 ?>
          >Lollypop</option>
          <option value="Coffee"
<?php 
    if($employee['plant']=="Coffee")
      echo "selected";
 ?>
          >Coffee</option> 
          <option value="Utility"
<?php 
    if($employee['plant']=="Utility")
      echo "selected";
 ?>
          >Utility</option>
          <option value="ETP_Boilers"
<?php 
    if($employee['plant']=="ETP_Boilers")
      echo "selected";
 ?>
          >ETP & Boilers</option>
          <option value="Electrical"
<?php 
    if($employee['plant']=="Electrical")
      echo "selected";
 ?>
          >Electrical</option>
          <option value="Driver"
<?php 
    if($employee['plant']=="Driver")
      echo "selected";
 ?>
          >Driver</option>                       
        </select>
        <label>Plant / Department</label>
      </div>                    
      <div class="row">
       <div class="input-field col s12">
         <input id="salary" name="salary" type="text" class="validate"  value="<?php echo $employee['salary']; ?>">
         <label for="salary">Salary</label>
       </div>
      </div>
        <div class="row">
          <div class="input-field col s6">      
            <p>
              <input name="busFare" type="checkbox" onchange="toggleCheck(this.id);" class="filled-in" id="bus" 
               <?php 
                  if($isBusFare)
                     echo "checked";
               ?>
               value="<?php 
                    if($isBusFare)
                      echo "on";
                    else
                      echo "off";
                 ?>"               
              />
              <label for="bus">Bus fare</label>
            </p>
          </div>
          <div class="input-field col s6">         
            <p>
              <input name="messFare" type="checkbox" onchange="toggleCheck(this.id);" class="filled-in" id="mess" 
               <?php 
                  if($isMessFare)
                     echo "checked";
               ?>
               value="<?php 
                    if($isMessFare)
                      echo "on";
                    else
                      echo "off";
                 ?>"               
              />
              <label for="mess">Mess fare</label>
            </p>
          </div>
        </div>        
        <div class="row">
          <div class="input-field col s12">
            <input id="pf" name="pf" type="text" class="validate" required="required" value="<?php echo $pf; ?>">
            <label for="pf">PF</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="esi" name="esi" type="text" class="validate" required="required" value="<?php echo $esi; ?>">
            <label for="esi">ESI</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input name="isBank" type="checkbox" class="filled-in" id="bank" onchange="showBankDiv();" 
               <?php 
                  if($bankAccountNumber)
                     echo "checked";
               ?>
               value="<?php 
                    if($bankAccountNumber)
                      echo "on";
                    else
                      echo "off";
                 ?>"
            />
            <label for="bank">Bank Account</label>
          </div> 
        </div>
        <div class="row bank" style="
           <?php 
              if($bankAccountNumber)
                echo "display: block;";
              else
                echo "display: none;";
           ?>
           ">
          <div class="input-field col s12">
            <input id="accNo" name="accNo" type="text" class="validate" required="required" 
               <?php 
                  if($bankAccountNumber)
                    echo "value='".$bankAccountNumber."'";
                  else
                    echo "value='0'";
               ?>
            />
            <label for="accNo">Account Number</label>
          </div>
        </div>
        <div class="row bank" style="
           <?php 
              if($bankAccountNumber)
                echo "display: block;";
              else
                echo "display: none;";
           ?>
           ">        
          <div class="input-field col s12">
            <input id="branchName" name="branchName" type="text" class="validate" required="required" 
               <?php 
                  if($bankAccountNumber)
                    echo "value='".$employee['branchName']."'";
                  else
                    echo "value=' '";
               ?>
            />
            <label for="branchName">Branch Name</label>
          </div>
        </div> 
        <div class="row bank" style="
           <?php 
              if($bankAccountNumber)
                echo "display: block;";
              else
                echo "display: none;";
           ?>
           ">        
          <div class="input-field col s12">
            <input id="branchCode" name="branchCode" type="text" class="validate" required="required" 
               <?php 
                  if($bankAccountNumber)
                    echo "value='".$employee['branchCode']."'";
                  else
                    echo "value='0'";
               ?>
            />
            <label for="branchCode">Branch Code</label>
          </div>
        </div>      
<br/>
      <div class="row">
       <button class="waves-effect waves-light btn" id="submit" name="submit">EDIT</button> &nbsp;&nbsp;&nbsp;
       <button type="reset" class="waves-effect waves-light btn red-text white">RESET</button><br/>
      </div>  
      </form>    
    </div>       
  </div>             
</body>
</html>
<?php

if(isset($_POST["submit"]))
{

  $empId = $_POST["empId"];
  $name = $_POST["name"];
  $workType = $_POST["workType"];
  $salary = $_POST["salary"];   
  $phone = $_POST["phone"];
  $dob = $_POST["dob"];
  $doj = $_POST["doj"];
  $address = $_POST["address"];  

  $gender = $_POST["gender"];
  $plant = $_POST["plant"];
  $busFare = $_POST["busFare"];
  $messFare = $_POST["messFare"]; 
  $pf = $_POST["pf"];
  $esi = $_POST["esi"];
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

  if($isBank == "on") {
    $accNo      = $_POST["accNo"];
    $branchName = $_POST["branchName"];
    $branchCode = $_POST["branchCode"];    
  }

  //echo $name."<br/>".$empId."<br/>".$phone."<br/>".$address."<br/>".$dob."<br/>".$doj."<br/>".$workType."<br/>".$salary."<br/>";  

  //echo $gender."<br/>".$plant."<br/>".$busFare."<br/>".$messFare."<br/>".$pf."<br/>".$esi."<br/>".$accNo."<br/>".$branchName."<br/>".$branchCode."<br/>";

  $execute = mysqli_query($conn,"update employee set name='".$name."',type='".$workType."',salary='".$salary."',phone='".$phone."',DOB='".$dob."',DOJ='".$doj."',address='".$address."',PF='".$pf."',ESI='".$esi."',gender='".$gender."',busFare='".$busFare."',messFare='".$messFare."',plant='".$plant."',bankAccountNumber='".$accNo."',branchCode='".$branchCode."',branchName='".$branchName."' where emp_id='".$empId."' ");


   echo "<script>window.location.href='employeeRecords.php';</script>";

  mysqli_close($conn);
}

?>