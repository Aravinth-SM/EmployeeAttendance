<?php

   include("DB/db.php");  

   $plant = $_REQUEST["plant"];
   $flubbers = $_REQUEST["flubbers"];

   if($flubbers == 0) {
       if($plant == "all")
        $query = "select * from employee where status=1 order by emp_id";
       else
        $query = "select * from employee where status=1 and plant='".$plant."' order by emp_id";    
   } else {
       if($plant == "all")
        $query = "select * from employee where status=1 and PF=1 order by emp_id";
       else
        $query = "select * from employee where status=1 and PF=1 and plant='".$plant."' order by emp_id";
   }

   $exe = mysqli_query($conn,$query);
   //$noOfEmployees = mysqli_num_rows($exe); 

   $i = -1;
  while($employee = mysqli_fetch_assoc($exe))
    {
      $i++;
?>     
    <div class="col s12 m4 l2" id="<?php echo "employee".$i ?>" data="<?php echo $employee['name']; ?>">
      <a class="modal-trigger" 
      <?php
        if($flubbers == 0) {
          echo  'href="employeeProfile.php?id='.$employee['id'].'"';
        } else {
          echo  'href="empProfile.php?id='.$employee['id'].'"';
        }
      ?>
       >
      <div class="card blue lighten-1" style="border-radius: 6%;height: 80px;">
        <div class="row card-content white-text">
          <div class="col s9">
            <p style="font-size: 13px;"><?php echo $employee["name"]; ?></p>
            <p><?php 
              if($flubbers == 0) {
                echo $employee["emp_id"]; 
              }
            ?></p>
          </div>
          <div class="col s3">
            <img src="images/img_avatar.png" alt="Avatar" style="width:40px;">
          </div>          
        </div>
      </div>
      </a>
    </div>
<?php
    }
 mysqli_close($conn);    
?>    