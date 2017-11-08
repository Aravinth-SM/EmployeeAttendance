<?php
  
  include("DB/db.php");  

  $plant = $_REQUEST["plant"];
  $res_date = $_REQUEST["date"];
  date_default_timezone_set("Asia/Kolkata");   
  $d=strtotime($res_date);
  $current_date = date("Y-m-d", $d); 
  $current_display_date = date("d-M-Y", $d);//YYYY-MM-DD  d-M-Y  

  if($plant == "all")
    $query = "select * from employee where status=1 order by emp_id";
  else
    $query = "select * from employee where status=1 and plant='".$plant."' order by emp_id";

  $exe = mysqli_query($conn,$query);
  $noOfEmployees = mysqli_num_rows($exe); 
  $noOfEmpPresent = 0;
  $noOfEmpAbsent = 0;   

  $queryHoliday = "select * from holidays where date='".$current_date."'";
  $exeHoliday = mysqli_query($conn,$queryHoliday);
  if(mysqli_num_rows($exeHoliday) > 0) {
    $noOfEmpPresent = 0;
    $noOfEmpAbsent = 0;    
  }  
  else {
    while($employee = mysqli_fetch_assoc($exe)) {
      $empId = $employee["emp_id"];
      $empQuery = "select * from attendance where emp_id='".$empId."' and date='".$current_date."'";
      $empExe = mysqli_query($conn,$empQuery);
      if(mysqli_num_rows($empExe) > 0) {
        $noOfEmpPresent++;
      }
      else {
        $noOfEmpAbsent++;
      }  
    }      
  }

  echo ''.$noOfEmployees.':'.$noOfEmpPresent.':'.$noOfEmpAbsent.'';

  mysqli_close($conn);
?>