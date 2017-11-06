<?php

  include("DB/db.php");
  $cur_date = $_REQUEST["date"];
  $data = $_REQUEST["data"];

  if($data=="holiday") {

  	  $query2 = mysqli_query($conn,"delete from attendance where date='".$cur_date."'");

	  $execute = mysqli_query($conn,"insert into holidays (date) values('".$cur_date."')");

	  if($execute == 1)
	    echo '1';
	  else
	  	echo '0';
  }
  else {
  	  $query = mysqli_query($conn,"delete from holidays where date='".$cur_date."'");

  	  echo '1';
  }

 mysqli_close($conn);
?>