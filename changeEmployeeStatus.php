<?php

    include("DB/db.php");
    $empId = $_REQUEST["empId"];
    $query = mysqli_query($conn,"update employee set status=0 where emp_id='".$empId."'");
    echo '1';
    mysqli_close($conn);
?>    