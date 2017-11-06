<?php

  include("DB/db.php");
  $emp_id = $_REQUEST["empId"];
  $status = $_REQUEST["data"];
  date_default_timezone_set("Asia/Kolkata");  
  $cur_date = date("Y-m-d");
  $in_out_time = date("G:i:s");
  $in_out_time_display = date("G:i");

  if($status=="ab") {
	  $execute = mysqli_query($conn,"insert into attendance (emp_id,date,in_time) values('".$emp_id."','".$cur_date."','".$in_out_time."')");

	  if($execute == 1)
	    echo '
                <P>IN&nbsp;&nbsp;-&nbsp;'.$in_out_time_display.'</P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;</P>
                <P>OT&nbsp;-&nbsp;</P>
      ';
	  else
	  	echo '';
  }
  else {

   $query = "select * from attendance where emp_id='".$emp_id."' and date='".$cur_date."'";
   $exe = mysqli_query($conn,$query);
   
   if(mysqli_num_rows($exe) > 0)
   {
    while($row = mysqli_fetch_assoc($exe))
    {
          $t1 = $row['in_time'];
    }
    $t1_explode = explode(":", $t1);
    $t1_display = $t1_explode[0].':'.$t1_explode[1];
    $strStart = $cur_date.' '.$t1; 
    $strEnd   = $cur_date.' '.$in_out_time; 
    $dteStart = new DateTime($strStart); 
    $dteEnd   = new DateTime($strEnd);
    $dteDiff  = $dteStart->diff($dteEnd);
    $ans = $dteDiff->format("%H:%I:%S");
    $ans_display = $dteDiff->format("%H:%I");

    $execute = mysqli_query($conn,"update attendance set out_time='".$in_out_time."',duration='".$ans."' where emp_id='".$emp_id."' and date='".$cur_date."';");

    if($execute == 1)
      echo '
                <P>IN&nbsp;&nbsp;-&nbsp;'.$t1_display.'</P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;'.$in_out_time_display.'</P>
                <P>OT&nbsp;-&nbsp;'.$ans_display.'</P>
      ';
    else
      echo '';
   }
   else
    {
      echo '';
    }


  }

 mysqli_close($conn);
?>