<?php
    $res_date = $_REQUEST["date"];
    $d=strtotime($res_date);
    $current_date = date("Y-m-d", $d);

    include("DB/db.php");

   $queryHoliday = "select * from holidays where date='".$current_date."'";
   $exeHoliday = mysqli_query($conn,$queryHoliday);
   
   if(mysqli_num_rows($exeHoliday) > 0) {
      echo "-1";
   }
   else {

   $empQuery = "select * from attendance where date='".$current_date."'";
   $empExe = mysqli_query($conn,$empQuery);
   $count = mysqli_num_rows($empExe);
   echo $count;
  }

    mysqli_close($conn);
?>    