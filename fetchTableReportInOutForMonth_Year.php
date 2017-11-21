<?php

  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $empId = $_REQUEST["empId"];
  $noOfDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
  $days = array('SUN', 'MON', 'TUE', 'WED','THU','FRI', 'SAT');

?>

<style type="text/css">
  td,th {
    padding: 10px 5px;
  }     
</style>

<table class="centered striped">
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

  </tbody>
</table>

<?php

  mysqli_close($conn);

?>