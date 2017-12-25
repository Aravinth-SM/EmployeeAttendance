<?php
    $plant = $_REQUEST["plant"];
    $flubbers = $_REQUEST["flubbers"];

    include("DB/db.php");

    if($flubbers == 0) {
         if($plant == "all") {
           $query1 = "select * from employee where status=1";
           $query2 = "select * from employee where type='monthly' and status=1";
           $query3 = "select * from employee where type='daily' and status=1";
         }
         else {
           $query1 = "select * from employee where status=1 and plant='".$plant."'";
           $query2 = "select * from employee where type='monthly' and status=1 and plant='".$plant."'";
           $query3 = "select * from employee where type='daily' and status=1 and plant='".$plant."'";       
         }
    } else {
           if($plant == "all") {
             $query1 = "select * from employee where status=1 and PF=1";
             $query2 = "select * from employee where type='monthly' and status=1 and PF=1";
             $query3 = "select * from employee where type='daily' and status=1 and PF=1";
           }
           else {
             $query1 = "select * from employee where status=1 and PF=1 and plant='".$plant."'";
             $query2 = "select * from employee where type='monthly' and status=1 and PF=1 and plant='".$plant."'";
             $query3 = "select * from employee where type='daily' and status=1 and PF=1 and plant='".$plant."'";       
           }
    }  

   $exe1 = mysqli_query($conn,$query1);
   $noOfEmployees = mysqli_num_rows($exe1);

   $exe2 = mysqli_query($conn,$query2);
   $noOfMonthlyPaid = mysqli_num_rows($exe2);   

   $exe3 = mysqli_query($conn,$query3);
   $noOfDailyPaid = mysqli_num_rows($exe3);     
   
   echo ''.$noOfEmployees.':'.$noOfMonthlyPaid.':'.$noOfDailyPaid.'';

    mysqli_close($conn);
?>    