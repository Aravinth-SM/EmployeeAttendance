<?php

  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];

?>

<style type="text/css">
  td,th {
    padding: 10px 5px;
  }     
</style>

<table class="highlight centered">
  <thead style="font-size: 16px;">
    <tr>
        <th>EMP ID</th>
        <th>EMP NAME</th>
        <th>PLANT</th>
        <th>PRESENT</th>
        <th>ABSENT</th>
        <th>OT</th>
        <th>PF</th>
        <th>ESI</th>
        <th>BUS FARE</th>
        <th>MESS FARE</th>
        <th>SALARY PAID</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $month; ?></td>
      <td><?php echo $year; ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>                        
    </tr>                                
  </tbody>
</table>

<?php

  mysqli_close($conn);

?>