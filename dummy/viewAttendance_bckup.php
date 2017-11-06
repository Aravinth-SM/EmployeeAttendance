<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Today's Attendance</title>  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <!-- link rel="shortcut icon" href="img/favicon1.ico" -->

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
      font-family: 'Cavorting';
      src: url(fonts/Cavorting.ttf);
    }
    .mynewfont {
      font-family: 'Cavorting';
    }
    @font-face {
      font-family: 'SnackerComic_PerosnalUseOnly';
      src: url(fonts/SnackerComic_PerosnalUseOnly.ttf);
    }
    .mynewfont2 {
      font-family: 'SnackerComic_PerosnalUseOnly';
    }
  </style>
  <script type="text/javascript">
      $(document).ready(function(){
       // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
        });
  </script>  
</head>
<body>
  <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s4"><a class="active" href="#all">All</a></li>
        <li class="tab col s4"><a href="#present">Present</a></li>
        <li class="tab col s4"><a href="#absent">Absent</a></li>
      </ul>
    </div>
    <div id="all" class="col s12">
      <br/><br/>
      <div class="row">
        <div class="col s12 m4 l2">
          <a class="modal-trigger" href="#modal1">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
          </a>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l2">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">NAME</span>
              <p>Id : 001</p>
            </div>
          </div>
        </div>                             
      </div>      
    </div>
    <div id="present" class="col s12">Test 2</div>
    <div id="absent" class="col s12">Test 3</div>
    <!-- Modal Structure Open -->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <h4>NAME</h4>
        <p>ID : 001</p>
        <p>Daily wages</p><br/>
        <a class="waves-effect waves-light btn">present</a> &nbsp;&nbsp;&nbsp;
        <a class="waves-effect waves-light btn red-text white">absent</a><br/>
        <p><u>IN</u> - 09:00AM &nbsp;&nbsp;&nbsp; <u>OUT</u> - 04:00PM</p>
      </div>
    </div>
    <!-- Modal Structure Close -->     
  </div>  
</body>
</html>