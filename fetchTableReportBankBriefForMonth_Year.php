<?php

  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  if($month<10)
    $monthStr = '0'.$month;
  else
    $monthStr = $month;
  $month = $year.'-'.$monthStr;
?>

<style type="text/css">
  td,th {
    padding: 10px 5px;
  }     
</style>

<table class="striped centered responsive-table">
  <thead>
    <tr>
        <th>EMP NAME</th>
        <th>ACCOUNT NUMBER</th>
        <th>BRANCH NAME</th>
        <th>BRANCH CODE</th>
        <th>NET SALARY</th>
    </tr>
  </thead>
  <tbody>
<?php

    $query = "select * from employee where status=1 and bankAccountNumber>0 order by emp_id";
    $exe = mysqli_query($conn,$query);
    while($employee = mysqli_fetch_assoc($exe))
    {     
        $querySal = "select * from salary where emp_id='".$employee["emp_id"]."' and month='".$month."' ";
        $exeSal = mysqli_query($conn,$querySal); 
        while($employeeSal = mysqli_fetch_assoc($exeSal))
        {
?>    
    <tr>
      <td><?php echo $employee["name"]; ?></td>
      <td><?php echo $employee["bankAccountNumber"]; ?></td>
      <td><?php echo $employee["branchName"]; ?></td>
      <td><?php echo $employee["branchCode"]; ?></td>
      <td><?php echo $employeeSal["salary"]; ?></td>                        
    </tr> 
<?php
      }
    }
?>                                   
  </tbody>
</table>

<?php

  mysqli_close($conn);

?>