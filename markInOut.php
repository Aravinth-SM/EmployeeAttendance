<?php

  include("DB/db.php");
  $emp_id = $_REQUEST["empId"];
  $in_time = $_REQUEST["in_time"];
  $out_time = $_REQUEST["out_time"];
  $ot_time = $_REQUEST["ot_time"];
  $status = $_REQUEST["data_status"];
  $res_date = $_REQUEST["date"];
  $d=strtotime($res_date);
  $cur_date = date("Y-m-d", $d);

   $query = "select * from attendance where emp_id='".$emp_id."' and date='".$cur_date."'";
   $exe = mysqli_query($conn,$query);
   
   if(mysqli_num_rows($exe) > 0)
   {

    $execute = mysqli_query($conn,"update attendance set in_time='".$in_time."',out_time='".$out_time."',ot_time='".$ot_time."' where emp_id='".$emp_id."' and date='".$cur_date."';");

    if($execute == 1)
      echo '
                <P>IN&nbsp;&nbsp;-&nbsp;'.$in_time.'</P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;'.$out_time.'</P>
                <P>OT&nbsp;-&nbsp;'.$ot_time.'</P>
      ';
    else
      echo '';
   }
   else
    {
    $execute = mysqli_query($conn,"insert into attendance (emp_id,date,in_time,out_time,ot_time) values('".$emp_id."','".$cur_date."','".$in_time."','".$out_time."','".$ot_time."')");

        if($execute == 1)
          echo '
                <P>IN&nbsp;&nbsp;-&nbsp;'.$in_time.'</P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;'.$out_time.'</P>
                <P>OT&nbsp;-&nbsp;'.$ot_time.'</P>
          ';
        else
          echo '';
    }


 mysqli_close($conn);
?>