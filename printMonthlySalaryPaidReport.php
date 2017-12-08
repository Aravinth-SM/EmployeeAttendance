<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>print</title>
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   
  <link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
  <!-- these js files are used for making PDF -->
    <script src="js/xepOnline.jqPlugin.js"></script>
  <!-- these js files are used for making PDF -->
  <script type="text/javascript">

  function HTMLtoPDF() {
    return xepOnline.Formatter.Format('printTable',{embedLocalImages:'true',render:'download',filename:'MonthlySalaryPaidReport_employee'});
  }

  function dummy() {
    window.close();
  }

    function printTable() {
      HTMLtoPDF();
      setTimeout(dummy, 5000);
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
    <div class="row" align="center">
      <div class="col s12 m6 l6" align="left">
        <span><b>Employee Name : </b><?php echo $empName; ?> (<?php echo $empId; ?>)</span>
      </div>                                     
    </div>
    <br/><br/>
    <table class="highlight centered">
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

      </tbody>
    </table>
  </div>
</body>
<?php

  mysqli_close($conn);

?>
</html>