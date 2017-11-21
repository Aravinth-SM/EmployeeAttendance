<?php
	include("DB/db.php");
	$month = date("m");
	$monthBefore = ( (int)$month ) - 1;
	$year  = date("Y");
	$month = $year.'-'.$month;
	$monthBefore = $year.'-'.$monthBefore;

	$query = "select * from variables where month='".$month."'";
	$exe = mysqli_query($conn,$query);

	if(mysqli_num_rows($exe) > 0) {
	  echo "0";
	}
	else {
		$bus_fare = 0;
		$mess_fare = 0;
		$PF = 0;
		$ESI = 0;
		$query = "select * from variables where month='".$monthBefore."'";
		$exe = mysqli_query($conn,$query);
		while($variable = mysqli_fetch_assoc($exe))
		{
			$bus_fare = $variable['bus_fare'];
			$mess_fare = $variable['mess_fare'];
			$PF = $variable['PF'];
			$ESI = $variable['ESI'];
		}
		   $execute = mysqli_query($conn,"insert into variables (month,bus_fare,mess_fare,PF,ESI) values('".$month."','".$bus_fare."','".$mess_fare."','".$PF."','".$ESI."')");

		   if($execute == 1)
		   {
		    echo "1";
		   }

		   else
		   {
		    echo "-1";
		   }

	}

	mysqli_close($conn);
?> 