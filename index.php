<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">
<title>Home | Employee Attendance</title>
<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
<link rel="stylesheet" href="css/loginStyle.css" />

<?php
   session_start();
   error_reporting();
   if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1)
      header("location:viewAttendance.php");  
    else if(isset($_SESSION["flubbers_admin"]) && $_SESSION["flubbers_admin"] == 1)
      header("location:empRecords.php");
?>

<style>
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    display: table;
}
.container {
    display: table-cell;
    text-align: center;
    vertical-align: middle;
}
.content {
 
    display: inline-block;
   
}

}
</style>

<style type="text/css">
@font-face { font-family: Gumption lite; src: url('fonts/Gumption-lite.ttf'); } 
  .helloFont1{
  font-family:"Gumption lite";
}
</style>

<script type="text/javascript">
      function currentMonthVaraibleEntry() {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var val = this.responseText;
              }
          }
          xmlhttp.open("GET", "variableEntry.php", true);
          xmlhttp.send();        
      }
      function calculateSalary() {
          currentMonthVaraibleEntry();
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  var val = this.responseText;
                  location.reload();
              }
          }
          xmlhttp.open("GET", "calculateSalary.php", true);
          xmlhttp.send();        
      }  
</script>

</head>

<body >

<div class="container">

<label class="helloFont1" style="font-size:90px;color:#FFF;">Flubbers</label>

    <div class="content">

<form method="post">
<?php
if(isset($_SESSION["msg"]))
{
  //echo '<script>Materialize.toast("'.$_SESSION["msg"].'",8000);</script>';
  echo "<label style='color:red;'>".$_SESSION["msg"]."</label>";
  unset($_SESSION["msg"]);
}
?>
  <label>
    <input type="text" id="username" name="username" required autocomplete="off"/>
    <div class="label-text">User name</div>
  </label>
  <label>
    <input type="password" id="password" name="password" required />
    <div class="label-text">Password</div>
  </label>
  <button id="submit" name="submit">Login</button>
  <!-- <input type="submit" name="submit" id="submit" value="Login"> -->
</form>

  </div>
</div>
<?php

if(isset($_POST["submit"]))
{

  $username = $_POST["username"];
  $password = $_POST["password"];

   include("DB/db.php");
   
   $query = "select * from admin where username='".$username."' and password='".$password."'";
   $exe = mysqli_query($conn,$query);
   
   if(mysqli_num_rows($exe) > 0)
   {
    while($variable = mysqli_fetch_assoc($exe))
    {
      $adminId = $variable['id'];
      $roleType = $variable['role_type'];
    }
    if( $roleType == 4) {
      $_SESSION["flubbers_admin"] = 1;
      $_SESSION["flubbers_admin_id"] = $adminId;
      header("location:empRecords.php");
    }
    else {
        $_SESSION["admin"] = 1;
        $_SESSION["admin_id"] = $adminId;
        echo "<script>calculateSalary();</script>";
        //header("location:viewAttendance.php");
    }    
   }
   else
    {
      $_SESSION["msg"] = "Invalid Login";
      header("location:index.php");
    }
    mysqli_close($conn);
}

?>
</body>
</html>