<?php

  include("DB/db.php");  

  date_default_timezone_set("Asia/Kolkata");   
  $res_date = $_REQUEST["date"];
  $d=strtotime($res_date);
  $current_date = date("Y-m-d", $d); 
  $current_display_date = date("d-M-Y", $d);//YYYY-MM-DD  d-M-Y  

$queryHoliday = "select * from holidays where date='".$current_date."'";
$exeHoliday = mysqli_query($conn,$queryHoliday);
if(mysqli_num_rows($exeHoliday) > 0) {
  echo "-1";    
}  
else {
   $plant = $_REQUEST["plant"];

   if($plant == "all")
    $query = "select * from employee where status=1 order by emp_id";
   else
    $query = "select * from employee where status=1 and plant='".$plant."' order by emp_id";

   $exe = mysqli_query($conn,$query);
   //$noOfEmployees = mysqli_num_rows($exe);

   $i = -1;
  while($employee = mysqli_fetch_assoc($exe))
    {
      $i++;

      $empId = $employee["emp_id"];
      $empStatus = "";
      $empColor = "";
      $empIN = "";
      $empOUT = "";
      $empOT = "";

   $empQuery = "select * from attendance where emp_id='".$empId."' and date='".$current_date."'";
   $empExe = mysqli_query($conn,$empQuery);
   
   if(mysqli_num_rows($empExe) > 0)
   {
      while($empRow = mysqli_fetch_assoc($empExe))
      {
            $empIN = $empRow['in_time'];
            $empOUT = $empRow['out_time'];
            $empOT = $empRow['ot_time'];

            if($empOUT=="") {
              $empStatus = "in";
              $empColor = "green";
            }
            else {
              $empStatus = "out";  
              $empColor = "green";           
            }
      }
   }
   else {
      $empStatus = "ab";
      $empColor = "red";
   }      
?>
    <div class="col s12 m4 l2" id="<?php echo "employee".$i ?>" data="<?php echo $employee['name']; ?>">
      <a class="" onclick="modalOpen('<?php echo $employee["name"]; ?>','<?php echo $employee["emp_id"]; ?>','<?php echo $empIN; ?>','<?php echo $empOUT; ?>','<?php echo $empOT; ?>','<?php echo "emp".$i; ?>');"> 
      <div class="card <?php echo $empColor; ?> lighten-1"  id="<?php echo "emp".$i ?>" style="border-radius: 6%;height: 115px;cursor: pointer;"  data-status="<?php echo $empStatus; ?>" data-empId="<?php echo $employee['emp_id']; ?>">
        <div class="card-content white-text">
          <div class="row" align="center" style="line-height: 0">
            <p style="font-size: 13px;"><?php echo $employee["name"]; ?></p>
          </div>
          <div class="divider"></div>
          <div class="row">
            <div class="col s2" style="line-height: 2;">
              <div class="divider" style="height: 9px;background-color :transparent;"></div>
              <img src="images/img_avatar.png" alt="Avatar" style="width:40px;"><br/>
              <p><?php echo $employee["emp_id"]; ?></p>
            </div> 
            <div class="col s1">
              &nbsp;
            </div>
            <div class="col s1" style="font-size: 18px;line-height : 1;">
              <p>|</p>
              <p>|</p>
              <p>|</p>
              <p>|</p>
            </div>                      
            <div class="col s6">
              <div class="divider" style="height: 9px;background-color :transparent;"></div>
              <div id="<?php echo 'attendanceStatus'.$employee['emp_id']; ?>" style="font-size: 12px;">
                <P>IN&nbsp;&nbsp;-&nbsp;<?php echo $empIN; ?></P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $empOUT; ?></P>
                <P>OT&nbsp;-&nbsp;<?php echo $empOT; ?></P>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </a>
    </div>   
<?php
    }
  }
mysqli_close($conn);    
?>   
