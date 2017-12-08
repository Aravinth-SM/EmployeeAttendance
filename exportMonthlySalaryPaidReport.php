<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Export</title>
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   
  <link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
  <!-- these js files are used for making PDF -->
    <script type="text/javascript" src="js/bootstrap.min_1.js"></script>
    <script type="text/javascript" src="js/FileSaver.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/tableexport.min.js"></script>    
  <!-- these js files are used for making PDF -->
  <script type="text/javascript">

  function hideFun() {
    var buttonM = document.getElementsByClassName("csv");
    buttonM[0].style.display = "none";
    var buttonN = document.getElementsByClassName("txt");
    buttonN[0].style.display = "none";
  }

    function printTable() {
      $('#monthlyPaidSalaryReport').tableExport();
      hideFun();
    }
    
  </script>
  <style type="text/css">
    td,th {
      padding: 10px 5px;
    }    
  </style>  
</head>
<?php

  include("DB/db.php");
  $empId = $_REQUEST["empId"];
  $empName = $_REQUEST["name"];

?>
<body onload="printTable();">
  <div id="printTable" align="center">

    <img src="images/logo.PNG" alt="LOGO" /><br/><br/>
    <br/><br/>
    <table class="highlight centered" id="monthlyPaidSalaryReport">
      <thead style="font-size: 16px;">
        <tr>
          <th>MONTH</th>
          <th>PRESENT</th>
          <th>ABSENT</th>
          <th>HOLIDAY</th>
          <th>OT</th>
          <th>BUS FARE</th>
          <th>MESS FARE</th>                  
          <th>PF</th>
          <th>ESI</th>
          <th>SALARY PAID</th>
        </tr>
      </thead>
      <tbody>

<?php

    $querySal = "select * from salary where emp_id='".$empId."' ";
    $exeSal = mysqli_query($conn,$querySal); 
    while($employeeSal = mysqli_fetch_assoc($exeSal))
    {    
?>

      <tr>
        <td><?php echo $employeeSal["month"]; ?></td>
        <td><?php echo $employeeSal["present"]; ?></td>
        <td><?php echo $employeeSal["absent"]; ?></td>
        <td><?php echo $employeeSal["holiday"]; ?></td>
        <td><?php echo $employeeSal["OT"]; ?></td> 
        <td><?php echo $employeeSal["bus_fare"]; ?></td>
        <td><?php echo $employeeSal["mess_fare"]; ?></td>
        <td><?php echo $employeeSal["PF"]; ?></td>
        <td><?php echo $employeeSal["ESI"]; ?></td>
        <td><?php echo $employeeSal["salary"]; ?></td>                                          
      </tr>   

    <?php

      }

    ?>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><b>Employee Name</b></td>
        <td><?php echo $empName; ?></td>
      </tr>
      <tr>
        <td><b>Employee ID</b></td>
        <td><?php echo $empId; ?></td>
      </tr>      
      </tbody>
    </table>
  </div>
</body>
<?php

  mysqli_close($conn);

?>
</html>