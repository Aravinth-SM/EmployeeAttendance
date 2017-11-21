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

<table class="striped centered">
  <thead style="font-size: 16px;">
    <tr>
        <th>EMP ID</th>
        <th>EMP NAME</th>
        <th>PLANT</th>
        <th>PRESENT</th>
        <th>ABSENT</th>
        <th>HOLIDAY</th>
        <th>OT</th>
        <th>PER DAY</th>
        <th>PER HOUR</th>
        <th>BUS FARE</th>
        <th>MESS FARE</th>
        <th>PF</th>
        <th>ESI</th>
        <th>SALARY PAID</th>
    </tr>
  </thead>
  <tbody>
<?php
    $query = "select * from employee where status=1 order by emp_id";
    $exe = mysqli_query($conn,$query);
    while($employee = mysqli_fetch_assoc($exe))
    {     
        $querySal = "select * from salary where emp_id='".$employee["emp_id"]."' and month='".$month."' ";
        $exeSal = mysqli_query($conn,$querySal); 
        while($employeeSal = mysqli_fetch_assoc($exeSal))
        {
?>    
    <tr>
      <td><?php echo $employee["emp_id"]; ?></td>
      <td><?php echo $employee["name"]; ?></td>
      <td><?php echo $employee["plant"]; ?></td>
      <td><?php echo $employeeSal["present"]; ?></td>
      <td><?php echo $employeeSal["absent"]; ?></td>
      <td><?php echo $employeeSal["holiday"]; ?></td>
      <td><?php echo $employeeSal["OT"]; ?></td>
      <td><?php echo $employeeSal["perDay"]; ?></td>
      <td><?php echo $employeeSal["perHour"]; ?></td>
      <td><?php echo $employeeSal["bus_fare"]; ?></td>
      <td><?php echo $employeeSal["mess_fare"]; ?></td>
      <td><?php echo $employeeSal["PF"]; ?></td>
      <td><?php echo $employeeSal["ESI"]; ?></td>
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