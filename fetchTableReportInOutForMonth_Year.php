<?php

  include("DB/db.php");
  $month = $_REQUEST["month"];
  $year = $_REQUEST["year"];
  $empId = $_REQUEST["empId"];

?>

<style type="text/css">
  td,th {
    padding: 10px 5px;
  }     
</style>

<table class="highlight centered">
  <thead style="font-size: 16px;">
    <tr>
        <th>DATE</th>
        <th>DAY</th>
        <th>IN</th>
        <th>OUT</th>
        <th>OT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $month; ?></td>
      <td><?php echo $year; ?></td>
      <td></td>
      <td></td>
      <td></td>                        
    </tr>                                
  </tbody>
</table>

<?php

  mysqli_close($conn);

?>