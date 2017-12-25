<?php
session_start();
error_reporting(0);

if(!isset($_SESSION["flubbers_admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Profile</title>  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="icon" href="images/favicon.png" type="image/png" sizes="20x20">

  <!-- W3.CSS Open 
    <link rel="stylesheet" href="css/offW3.css">
   W3.CSS Close -->
    
  <!-- Materialize Open --> 
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css"  media="screen,projection"/>
    <script type="text/javascript" src="materialize/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
  <!-- Materialize Close -->   

  <style type="text/css">
      @font-face { 
        font-family: Gumption lite; 
        src: url('fonts/Gumption-lite.ttf'); 
      } 
      .helloFont1 {
        font-family:"Gumption lite";
      }
  </style>

  <style type="text/css">
    td,th {
      padding: 10px 5px;
    }     
  </style>

  <script type="text/javascript">
    $(document).ready(function(){  
      $(".button-collapse").sideNav();
    });
  </script>

</head>
<body>
  <nav>
    <div class="nav-wrapper blue-grey darken-3">
      &nbsp;&nbsp;&nbsp;
      <a href="index.php" class="brand-logo helloFont1">Flubbers</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li class="active"><a href="userProfile.php">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li class="active"><a href="userProfile.php">Profile</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>      
    </div>
  </nav>  
<?php
  include("DB/db.php");

    $username = "";
    $oldPassword = "";
    $queryVar = "select * from admin where id='".$_SESSION["flubbers_admin_id"]."'";
    $exeVar = mysqli_query($conn,$queryVar);
    while($variable = mysqli_fetch_assoc($exeVar))
    {
      $username = $variable['username'];
      $oldPassword = $variable['password'];
      $roleName = $variable['role_name'];
      $roleType = $variable['role_type'];
    }

?>   
  <div class="row" align="center">
    <div class="col s12 m3 l3">
      <br/>
    </div>
    <div class="col s12 m6 l6">
      <form method="post" novalidate>
        <br/>       
        <div class="row">
          <div class="input-field col s12">
            <input id="userName" name="userName" type="text" class="validate" required="required" value="<?php echo $username; ?>">
            <label for="userName">User Name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="oldPswd" name="oldPswd" type="password" class="validate" autofocus="autofocus" required="required">
            <label for="oldPswd">Old Password</label>
          </div>
        </div> 
        <div class="row">
          <div class="input-field col s12">
            <input id="newPswd" name="newPswd" type="password" class="validate" required="required">
            <label for="newPswd">New Password</label>
          </div>
        </div> 
        <div class="row">
          <div class="input-field col s12">
            <input id="re_newPswd" name="re_newPswd" type="password" class="validate" required="required">
            <label for="re_newPswd">Re-enter New Password</label>
          </div>
        </div>                                                     
        <br/>
        <div class="row">
          <button class="waves-effect waves-light btn" id="submit" name="submit">UPDATE</button> &nbsp;&nbsp;&nbsp;
          <button type="reset" class="waves-effect waves-light btn red-text white">RESET</button><br/>
        </div> 
      </form>                           
    </div>   
    <div class="col s12 m3 l3">
      <br/>
    </div>        
  </div>  
</body>
</html>
<?php

if(isset($_POST["submit"]))
{

  $userName = $_POST["userName"];
  $oldPswd = $_POST["oldPswd"];

if($userName=="")
{
  echo '<script>Materialize.toast("Enter Username",6000,"rounded");</script>';
}
else
{
  if($oldPswd != $oldPassword)
  {
    //echo "<script>alert('Wrong old password');window.location.href='profile.php';</script>";
    echo '<script>Materialize.toast("Wrong old password",6000,"rounded");</script>';
  }
else {
  $newPswd = $_POST["newPswd"];
  $re_newPswd = $_POST["re_newPswd"];

  if($newPswd != $re_newPswd)
  {
    //echo "<script>alert('New password and Re-enter new password is not same');window.location.href='profile.php';</script>";
    echo '<script>Materialize.toast("New password and Re-enter new password is not same",6000,"rounded");</script>';
  }  
else {
$execute = mysqli_query($conn,"update admin set username='".$userName."',password='".$newPswd."' where id='".$_SESSION["flubbers_admin_id"]."' ");


   echo "<script>window.location.href='logout.php';</script>";  
 }
}
}
}

  mysqli_close($conn);


?>