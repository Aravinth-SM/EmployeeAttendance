<?php
  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $empId = $_REQUEST["empId"];
  $noOfDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
  $days = array('SUN', 'MON', 'TUE', 'WED','THU','FRI', 'SAT');
//$date='2017-10-28';
//$dayofweek = date('w', strtotime($date));

for($i=1; $i<=$noOfDays; $i++) {
	$date = ''.$year.'-'.$month.'-'.$i.'';
	$empColor = "brown";
	$empIN = "";
	$empOUT = "";
	$empOT = "";

	$queryHoliday = "select * from holidays where date='".$date."'";
	$exeHoliday = mysqli_query($conn,$queryHoliday);

	if(mysqli_num_rows($exeHoliday) > 0) {
	  $empColor = "blue";
	}
	else {
		$empQuery = "select * from attendance where emp_id='".$empId."' and date='".$date."'";
		$empExe = mysqli_query($conn,$empQuery);

		if(mysqli_num_rows($empExe) > 0)
		{
			while($empRow = mysqli_fetch_assoc($empExe))
			{
				$empIN = $empRow['in_time'];
				$t1_explode = explode(":", $empIN);
				$empIN = $t1_explode[0].':'.$t1_explode[1];

				$empOUT = $empRow['out_time'];
				if($empOUT!="") {
					$t1_explode = explode(":", $empOUT);
					$empOUT = $t1_explode[0].':'.$t1_explode[1];              
				}

				$empOT = $empRow['duration'];
				if($empOT!="") {
					$t1_explode = explode(":", $empOT);
					$empOT = $t1_explode[0].':'.$t1_explode[1]; 
				}

				$empColor = "green";
			}
		}
		else {
			$empColor = "red";
		} 
   }  

		$dayofweek = date('w', strtotime($date));
		echo '
			    <div class="col s12 m4 l2">
			      <div class="card '.$empColor.' lighten-1" style="height: 80px;border-radius: 6%;">
			        <div class="card-content white-text" style="font-size: 11px;">
			          <div class="row" align="center">
			          	<div class="col s3">
			              	<P>'.$i.'</P>
			              	<P>'.$days[$dayofweek].'</P>
			            </div>
			            <div class="col s2" style="font-size: 18px;line-height : 1;">
			            	<p>|</p>
			            	<p>|</p>
			            </div>
			          	<div class="col s6">
			                <P>IN&nbsp;&nbsp;-&nbsp;'.$empIN.'</P>
			                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;'.$empOUT.'</P>
			                <P>OT&nbsp;-&nbsp;'.$empOT.'</P>
			            </div>			            
			          </div>         
			        </div>
			      </div>
			    </div>
		';
	}
mysqli_close($conn);
?>