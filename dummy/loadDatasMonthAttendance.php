<?php
  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $empId = $_REQUEST["empId"];
  $noOfDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);

  $holidaysCount = 0;
  $presentCount = 0;
  $absentCount = 0;  

  for($i=1; $i<=$noOfDays; $i++) {
    $date = ''.$year.'-'.$month.'-'.$i.'';

    $queryHoliday = "select * from holidays where date='".$date."'";
    $exeHoliday = mysqli_query($conn,$queryHoliday);
    if(mysqli_num_rows($exeHoliday) > 0) {
      $holidaysCount++;
    }
    else {
      $empQuery = "select * from attendance where emp_id='".$empId."' and date='".$date."'";
      $empExe = mysqli_query($conn,$empQuery);
      if(mysqli_num_rows($empExe) > 0) {
        $presentCount++;
      }
    }
}
  $absentCount = $noOfDays - $presentCount - $holidaysCount;
  echo ''.$presentCount.':'.$absentCount.':'.$holidaysCount;

    mysqli_close($conn);
?>