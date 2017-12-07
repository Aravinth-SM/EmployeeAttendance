<html>
<head>
  <title>export</title>
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   
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
      $('#monthlyInOutReport').tableExport();
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
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $empId = $_REQUEST["empId"];
  $empName = $_REQUEST["name"];
  $noOfDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
  $days = array('SUN', 'MON', 'TUE', 'WED','THU','FRI', 'SAT');

?>
<body onload="printTable();">
  <div id="printTable" align="center">

    <img src="images/logo.PNG" alt="LOGO" /><br/><br/>
    <br/><br/>
    <table class="centered striped" id="monthlyInOutReport">
      <thead style="font-size: 16px;">
        <tr>
            <th>DATE</th>
            <th>DAY</th>
            <th>STATUS</th>
            <th>IN</th>
            <th>OUT</th>
            <th>OT</th>
        </tr>
      </thead>
      <tbody>

    <?php

      for($i=1; $i<=$noOfDays; $i++) {
        $date = ''.$year.'-'.$month.'-'.$i.'';
        $dayofweek = date('w', strtotime($date));
        $dayName = $days[$dayofweek];

        $empIN = "-";
        $empOUT = "-";
        $empOT = "-";

      $queryHoliday = "select * from holidays where date='".$date."'";
      $exeHoliday = mysqli_query($conn,$queryHoliday);

      if(mysqli_num_rows($exeHoliday) > 0) {
        $status = "holiday";
      }
      else {
        $empQuery = "select * from attendance where emp_id='".$empId."' and date='".$date."'";
        $empExe = mysqli_query($conn,$empQuery);

        if(mysqli_num_rows($empExe) > 0)
        {
          $status = "present";
          while($empRow = mysqli_fetch_assoc($empExe))
          {
            $empIN = $empRow['in_time'];
            $empOUT = $empRow['out_time'];
            $empOT = $empRow['ot_time'];
          }
        }
        else {
          $status = "absent";
        } 
       }    

    ?>

        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $dayName; ?></td>
          <td><?php echo $status; ?></td>
          <td><?php echo $empIN; ?></td>
          <td><?php echo $empOUT; ?></td>
          <td><?php echo $empOT; ?></td>                        
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
      <tr>
        <td><b>Month</b></td>
        <td><?php echo $month; ?></td>
      </tr>
      <tr>
        <td><b>Year</b></td>
        <td><?php echo $year; ?></td>
      </tr>      
      </tbody>
    </table>
  </div>
</body>
<?php

  mysqli_close($conn);

?>
</html>