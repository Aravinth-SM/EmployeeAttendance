<?php
	include("DB/db.php");

	$month = date("m");
	$month = ( (int)$month ) - 1;
	$year  = date("Y");
	$noOfDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
	if($month<10)
		$monthStr = '0'.$month;
	else
		$monthStr = $month;
	$month = $year.'-'.$monthStr;
?>
	<!-- <script>alert('month: <?php echo $month; ?> & noOfDays:<?php echo $noOfDays; ?>');</script> -->
<?php
   $queryHoliday = "select * from holidays where date like '".$month."%' ";
   $exeHoliday = mysqli_query($conn,$queryHoliday);	
   $holiday = mysqli_num_rows($exeHoliday);

	$query = "select * from salary where month='".$month."'";
	$exe = mysqli_query($conn,$query);

	if(mysqli_num_rows($exe) > 0) {
	  echo "0";
	}
	else {

		$query = "select * from employee where status=1 order by emp_id";
		$exe = mysqli_query($conn,$query);
		while($employee = mysqli_fetch_assoc($exe))
		{
		  $empId = $employee['emp_id'];
		  $OT = 0;

		  $empQuery = "select * from attendance where emp_id='".$empId."' and date like '".$month."%' ";
   		  $empExe = mysqli_query($conn,$empQuery);	
		  $present = mysqli_num_rows($empExe);
		  while($empAttendance = mysqli_fetch_assoc($empExe))
		  {
		  	$OT = $OT + $empAttendance['ot_time'];
		  }
		  
		  $absent  = $noOfDays-$present-$holiday;

		  	$bus_fare = $employee['busFare'];
		  	$mess_fare = $employee['messFare'];
		  	$PF = $employee['PF'];
		  	$ESI = $employee['ESI'];
		  	$type = $employee['type']; 
		  	$busAmt = 0;
		  	$messAmt = 0;
		  	$perDay = 0;
		  	$perHour = 0;

		$queryVar = "select * from variables where month='".$month."'";
		$exeVar = mysqli_query($conn,$queryVar);
		while($variable = mysqli_fetch_assoc($exeVar))
		{
			$busAmt = $variable['bus_fare'];
			$messAmt = $variable['mess_fare'];
			//$PF = $variable['PF'];
			//$ESI = $variable['ESI'];
		}		  	

		  	if($bus_fare)
		  		$bus_fare = $busAmt;

		  	if($mess_fare) 
		  		$mess_fare = $messAmt;

		  	if($type == "monthly")
		  	{
		  		$perDay = round( (( (int)$employee['salary'] ) / 26.0) , 2 );
		  		$perHour = round( (( (int)$perDay ) / 9.5) , 2 );
		  	}
		  	else
		  	{
		  		$perDay = round( (int)$employee['salary'] , 2 );
		  		$perHour = round( (( (int)$perDay ) / 9.5) , 2 );
		  	}

		  	$salary = round(( ((26-$absent)*$perDay) + ($OT*$perHour) - $bus_fare - $mess_fare - $PF - $ESI ),2);

		  // echo "empId : ".$empId." ";
		  // echo "present : ".$present." ";
		  // echo "absent : ".$absent." ";
		  // echo "holiday : ".$holiday." ";
		  // echo "OT : ".$OT." ";
		  // echo "perDay : ".$perDay." ";
		  // echo "perHour : ".$perHour." ";
		  // echo "bus_fare : ".$bus_fare." ";
		  // echo "mess_fare : ".$mess_fare." ";
		  // echo "PF : ".$PF." ";	
		  // echo "ESI : ".$ESI." ";
		  // echo "salary : ".$salary." ";	
		  // echo "--------";	  
		   $execute = mysqli_query($conn,"insert into salary (month,emp_id,present,absent,holiday,OT,perDay,perHour,bus_fare,mess_fare,PF,ESI,salary) values('".$month."','".$empId."','".$present."','".$absent."','".$holiday."','".$OT."','".$perDay."','".$perHour."','".$bus_fare."','".$mess_fare."','".$PF."','".$ESI."','".$salary."')");
		}
		echo "1";		
	}	

	mysqli_close($conn);
?>  