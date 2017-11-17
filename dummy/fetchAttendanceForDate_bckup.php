<?php
    $res_date = $_REQUEST["date"];
    $d=strtotime($res_date);
    $current_date = date("Y-m-d", $d);

    include("DB/db.php");

   $queryHoliday = "select * from holidays where date='".$current_date."'";
   $exeHoliday = mysqli_query($conn,$queryHoliday);
   
   if(mysqli_num_rows($exeHoliday) > 0) {
      echo "";
   }
   else {

   $query = "select * from employee where status=1";
   $exe = mysqli_query($conn,$query);

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
      $empStatus = "ab";
      $empColor = "red";
   }      
?>     
    <div class="col s12 m4 l2" id="<?php echo "employee".$i ?>" data="<?php echo $employee['name']; ?>">
      <div class="card <?php echo $empColor; ?> lighten-1"  id="<?php echo "emp".$i ?>" style="border-radius: 6%;height: 115px;" data-status="<?php echo $empStatus; ?>" data-empId="<?php echo $employee['emp_id']; ?>">
        <div class="card-content white-text">
          <div class="row" align="center" style="line-height: 0">
            <p><?php echo $employee["name"]; ?></p>
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
              <div class="divider" style="height: 5px;background-color :transparent;"></div>
              <div id="<?php echo 'attendanceStatus'.$employee['emp_id']; ?>">
                <P>IN&nbsp;&nbsp;-&nbsp;<?php echo $empIN; ?></P>
                <P>O&nbsp;&nbsp;&nbsp;-&nbsp;<?php echo $empOUT; ?></P>
                <P>OT&nbsp;-&nbsp;<?php echo $empOT; ?></P>
              </div>
            </div>
          </div>         
        </div>
      </div>
    </div>
<?php
    }
  }
    mysqli_close($conn);
?>    
