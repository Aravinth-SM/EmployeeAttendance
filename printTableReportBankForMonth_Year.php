<html>
<head>
  <title>print</title>
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   
  <!-- these js files are used for making PDF -->
    <script src="js/xepOnline.jqPlugin.js"></script>
  <!-- these js files are used for making PDF -->
  <script type="text/javascript">

  function HTMLtoPDF() {
    return xepOnline.Formatter.Format('printTable',{embedLocalImages:'true',render:'download',filename:'bankMonthlyReport'});
  }

  function dummy() {
    window.close();
  }

    function printTable() {
      HTMLtoPDF();
      setTimeout(dummy, 3000);
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
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  if($month<10)
    $monthStr = '0'.$month;
  else
    $monthStr = $month;
  $month = $year.'-'.$monthStr;
?>
<body onload="printTable();">
  <div id="printTable" align="center">

    <img src="images/logo.PNG" alt="LOGO" /><br/><br/>
    <div class="row" align="center">
      <div class="col s12 m2 l2">
        <br/>
      </div>
      <div class="col s12 m4 l4">
        <span><b>Month : </b><?php echo $monthStr; ?></span>
      </div>  
      <div class="col s12 m4 l4">
        <span><b>Year : </b><?php echo $year; ?></span>
      </div>                 
      <div class="col s12 m2 l2">
        <br/>
      </div>        
    </div>
    <br/><br/>
    <table class="striped centered">
      <thead style="font-size: 16px;">
        <tr>
            <th>NAME</th>
            <th>ACCOUNT NUMBER</th>
            <th>BRANCH NAME</th>
            <th>BRANCH CODE</th>
            <th>GROSS SALARY</th>
            <th>BUS FARE</th>
            <th>MESS FARE</th>
            <th>PF</th>
            <th>ESI</th>
            <th>NET SALARY</th>
        </tr>
      </thead>
      <tbody>
    <?php

        $query = "select * from employee where status=1 and bankAccountNumber>0 order by emp_id";
        $exe = mysqli_query($conn,$query);
        while($employee = mysqli_fetch_assoc($exe))
        {     
            $querySal = "select * from salary where emp_id='".$employee["emp_id"]."' and month='".$month."' ";
            $exeSal = mysqli_query($conn,$querySal); 
            while($employeeSal = mysqli_fetch_assoc($exeSal))
            {
              $grossSalary = $employeeSal["salary"] + $employeeSal["bus_fare"] + $employeeSal["mess_fare"] + $employeeSal["PF"] + $employeeSal["ESI"];
    ?>    
        <tr>
          <td><?php echo $employee["name"]; ?></td>
          <td><?php echo $employee["bankAccountNumber"]; ?></td>
          <td><?php echo $employee["branchName"]; ?></td>
          <td><?php echo $employee["branchCode"]; ?></td>
          <td><?php echo $grossSalary; ?></td>
          <td><?php echo $employeeSal["bus_fare"]; ?></td>
          <td><?php echo $employeeSal["mess_fare"]; ?></td>
          <td><?php echo $employeeSal["PF"]; ?></td>
          <td><?php echo $employeeSal["ESI"]; ?></td>
          <td><?php echo $employeeSal["salary"]; ?></td>                        
        </tr> 
    <?php
          }
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