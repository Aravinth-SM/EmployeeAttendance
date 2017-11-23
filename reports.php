<?php
session_start();error_reporting(0);

if(!isset($_SESSION["admin"]))
  header("location:index.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Reports</title>  
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
      @font-face { font-family: Gumption lite; src: url('fonts/Gumption-lite.ttf'); } 
        .helloFont1{
        font-family:"Gumption lite";
      }    
  </style>

  <script type="text/javascript">
    $(document).ready(function(){   
    $('select').material_select();
    $(".button-collapse").sideNav(); 
      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
      });
    });

      function fetchTableReport() {
        var month = document.getElementById('month').value;
        var year = document.getElementById('year').value;
        var plant = document.getElementById('plant').value;
        if ( (month == "") || (year == "") || (plant == "") ) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    document.getElementById('tableReport').innerHTML=val;
                }
            }
            xmlhttp.open("GET", "fetchTableReportForMonth_Year.php?month="+month+"&year="+year+"&plant="+plant, true);
            xmlhttp.send();
          }        
      }

      function fetchTableReportBank() {
        var month = document.getElementById('month2').value;
        var year = document.getElementById('year2').value;
        if ( (month == "") || (year == "") ) { 
          return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var val = this.responseText;
                    document.getElementById('tableReportBank').innerHTML=val;
                }
            }
            xmlhttp.open("GET", "fetchTableReportBankForMonth_Year.php?month="+month+"&year="+year, true);
            xmlhttp.send();
          }        
      }      

  </script>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="materialize/charts/loader.js"></script>

<?php
  include("DB/db.php");
  $query1 = "select * from employee where gender='male' and status=1";
  $exe1 = mysqli_query($conn,$query1);
  $maleCount = mysqli_num_rows($exe1); 

  $query2 = "select * from employee where gender='female' and status=1";
  $exe2 = mysqli_query($conn,$query2);
  $femaleCount = mysqli_num_rows($exe2);    
?>

    <!-- Chart1 script -->
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart1);

      // Callback that creates and populates a data table,
      // instantiates the pie chart1, passes in the data and
      // draws it.
      function drawChart1() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Gender');
        data.addColumn('number', 'Value');
        data.addRows([
          ['Male', <?php echo $maleCount; ?>],
          ['Female', <?php echo $femaleCount; ?>]
        ]);

        // Set chart1 options
        var options = {'title':'Gender distribution in the company',
                        'is3D': true,
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart1, passing in some options.
        var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
        chart1.draw(data, options);
      }
    </script>

<?php
  include("DB/db.php");
  $query3 = "select * from employee where type='monthly' and status=1";
  $exe3 = mysqli_query($conn,$query3);
  $monthlyCount = mysqli_num_rows($exe3); 

  $query4 = "select * from employee where type='daily' and status=1";
  $exe4 = mysqli_query($conn,$query4);
  $dailyCount = mysqli_num_rows($exe4);    
?>

    <!-- Chart2 script -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

        var data = google.visualization.arrayToDataTable([
          ['SalaryType', 'Count'],
          ['Monthly Salary', <?php echo $monthlyCount; ?>],
          ['Daily wages', <?php echo $dailyCount; ?>]
        ]);

        var options = {
          'title': 'Salary Type in the company',
          'is3D': true,
           'width':400,
           'height':300          
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));

        chart2.draw(data, options);
      }
    </script>    

<?php
  include("DB/db.php");
  $query5 = "select * from employee where bankAccountNumber=0 and status=1";
  $exe5 = mysqli_query($conn,$query5);
  $noCount = mysqli_num_rows($exe5); 

  $query6 = "select * from employee where status=1";
  $exe6 = mysqli_query($conn,$query6);
  $totalCount = mysqli_num_rows($exe6); 
  $yesCount = $totalCount - $noCount;   
?>

    <!-- Chart3 script -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart3);

      function drawChart3() {

        var data = google.visualization.arrayToDataTable([
          ['BankAccount', 'Count'],
          ['Yes', <?php echo $yesCount; ?>],
          ['No', <?php echo $noCount; ?>]
        ]);

        var options = {
          'title': 'No. of Employees having Bank account in the company',
          'is3D': true,
           'width':400,
           'height':300          
        };

        var chart3 = new google.visualization.PieChart(document.getElementById('chart_div3'));

        chart3.draw(data, options);
      }
    </script>

<?php
  include("DB/db.php");
  $query7 = "select * from employee where plant='Jelly' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $jellyCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Waffer' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $wafferCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Cup' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $cupCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Toy_Jar' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $toy_jarCount = mysqli_num_rows($exe7);       

  $query7 = "select * from employee where plant='Lollypop' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $lollypopCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Coffee' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $coffeeCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Utility' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $utilityCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='ETP_Boilers' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $etp_BoilersCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Electrical' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $electricalCount = mysqli_num_rows($exe7);

  $query7 = "select * from employee where plant='Driver' and status=1";
  $exe7 = mysqli_query($conn,$query7);
  $driverCount = mysqli_num_rows($exe7);    
?>

    <!-- Chart4 script -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart4);

      function drawChart4() {

        var data = google.visualization.arrayToDataTable([
          ['Plant', 'Count'],
          ['Jelly', <?php echo $jellyCount; ?>],
          ['Waffer', <?php echo $wafferCount; ?>],
          ['Cup', <?php echo $cupCount; ?>],
          ['Toy_Jar', <?php echo $toy_jarCount; ?>],
          ['Lollypop', <?php echo $lollypopCount; ?>],
          ['Coffee', <?php echo $coffeeCount; ?>],
          ['Utility', <?php echo $utilityCount; ?>],
          ['ETP_Boilers', <?php echo $etp_BoilersCount; ?>],
          ['Electrical', <?php echo $electricalCount; ?>],
          ['Driver', <?php echo $driverCount; ?>]
        ]);

        var options = {
          'title': 'Employees count for each plant in the company',
          'is3D': true,
           'width':400,
           'height':300          
        };

        var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));

        chart4.draw(data, options);
      }
    </script>        

</head>
<body>
  <nav>
    <div class="nav-wrapper blue-grey darken-3">
      &nbsp;&nbsp;&nbsp;
      <a href="index.php" class="brand-logo helloFont1">Flubbers</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li class="active"><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        <li><a href="viewAttendance.php">Home</a></li>
        <li><a href="addEmployee.php">Add Employee</a></li>
        <li><a href="employeeRecords.php">Employee Records</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li class="active"><a href="reports.php">Reports</a></li>
        <li><a href="logout.php">Log out</a></li>        
      </ul>      
    </div>
  </nav>  

  <div class="row" align="center">
    <div class="col s12 m6 l6">
      <!--Div that will hold the pie chart1-->
      <div id="chart_div1"></div>
    </div>
    <div class="col s12 m6 l6">
      <!--Div that will hold the pie chart2-->
      <div id="chart_div2"></div>
    </div>
  </div>

  <div class="row" align="center">
    <div class="col s12 m6 l6">      
      <!--Div that will hold the pie chart3-->
      <div id="chart_div3"></div>
    </div>
    <div class="col s12 m6 l6">
      <!--Div that will hold the pie chart4-->
      <div id="chart_div4"></div>      
    </div>
  </div>  
    
<?php

  $month = date("m");
  $year = date("Y");

?>

  <div class="row" align="center">
    <ul class="collapsible" data-collapsible="accordion" style="width: 98%;">
      <li>
        <div class="collapsible-header teal-text"><b><i class="material-icons">filter_drama</i>Employees report for particular month</b></div>
        <div class="collapsible-body">
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select name="month" id="month" onchange="fetchTableReport();">
                <option value="1" <?php if($month==1){echo "selected";}else{echo "";} ?> >01-January</option>
                <option value="2" <?php if($month==2){echo "selected";}else{echo "";} ?> >02-Feburary</option>
                <option value="3" <?php if($month==3){echo "selected";}else{echo "";} ?> >03-March</option>
                <option value="4" <?php if($month==4){echo "selected";}else{echo "";} ?> >04-April</option>
                <option value="5" <?php if($month==5){echo "selected";}else{echo "";} ?> >05-May</option>
                <option value="6" <?php if($month==6){echo "selected";}else{echo "";} ?> >06-June</option>
                <option value="7" <?php if($month==7){echo "selected";}else{echo "";} ?> >07-July</option> 
                <option value="8" <?php if($month==8){echo "selected";}else{echo "";} ?> >08-August</option>
                <option value="9" <?php if($month==9){echo "selected";}else{echo "";} ?> >09-September</option>
                <option value="10" <?php if($month==10){echo "selected";}else{echo "";} ?> >10-October</option>
                <option value="11" <?php if($month==11){echo "selected";}else{echo "";} ?> >11-November</option>
                <option value="12" <?php if($month==12){echo "selected";}else{echo "";} ?> >12-December</option>
              </select>
              <label>Month</label>
            </div> 
            <div class="input-field col s12 m6 l6">
              <select name="year" id="year" onchange="fetchTableReport();">
                <option value="2018" <?php if($year==2018){echo "selected";}else{echo "";} ?> >2018</option>
                <option value="2017" <?php if($year==2017){echo "selected";}else{echo "";} ?> >2017</option> 
              </select>
              <label>Year</label>
            </div> 
            <div class="input-field col s12 m12 l12">
              <select name="plant" id="plant" onchange="fetchTableReport();">
                <option value="all" selected>All</option>
                <option value="Jelly">Jelly</option>
                <option value="Waffer">Waffer</option>
                <option value="Cup">Cup</option>
                <option value="Toy_Jar">Toy & Jar</option>
                <option value="Lollypop">Lollypop</option>
                <option value="Coffee">Coffee</option> 
                <option value="Utility">Utility</option>
                <option value="ETP_Boilers">ETP & Boilers</option>
                <option value="Electrical">Electrical</option>
                <option value="Driver">Driver</option>                       
              </select>
              <label>Plant / Department</label>
            </div>            
          </div> 
<?php
  echo "<script>fetchTableReport();</script>";
?>          
          <div class="row" id="tableReport">
          </div>        
        </div>      
      </li>
      <li>
        <div class="collapsible-header teal-text"><b><i class="material-icons">filter_drama</i>Employees report with Bank Account</b></div>
        <div class="collapsible-body"> 
          <div class="row">
            <div class="input-field col s12 m6 l6">
              <select name="month2" id="month2" onchange="fetchTableReportBank();">
                <option value="1" <?php if($month==1){echo "selected";}else{echo "";} ?> >01-January</option>
                <option value="2" <?php if($month==2){echo "selected";}else{echo "";} ?> >02-Feburary</option>
                <option value="3" <?php if($month==3){echo "selected";}else{echo "";} ?> >03-March</option>
                <option value="4" <?php if($month==4){echo "selected";}else{echo "";} ?> >04-April</option>
                <option value="5" <?php if($month==5){echo "selected";}else{echo "";} ?> >05-May</option>
                <option value="6" <?php if($month==6){echo "selected";}else{echo "";} ?> >06-June</option>
                <option value="7" <?php if($month==7){echo "selected";}else{echo "";} ?> >07-July</option> 
                <option value="8" <?php if($month==8){echo "selected";}else{echo "";} ?> >08-August</option>
                <option value="9" <?php if($month==9){echo "selected";}else{echo "";} ?> >09-September</option>
                <option value="10" <?php if($month==10){echo "selected";}else{echo "";} ?> >10-October</option>
                <option value="11" <?php if($month==11){echo "selected";}else{echo "";} ?> >11-November</option>
                <option value="12" <?php if($month==12){echo "selected";}else{echo "";} ?> >12-December</option>
              </select>
              <label>Month</label>
            </div> 
            <div class="input-field col s12 m6 l6">
              <select name="year2" id="year2" onchange="fetchTableReportBank();">
                <option value="2018" <?php if($year==2018){echo "selected";}else{echo "";} ?> >2018</option>
                <option value="2017" <?php if($year==2017){echo "selected";}else{echo "";} ?> >2017</option> 
              </select>
              <label>Year</label>
            </div>           
          </div> 
<?php
  echo "<script>fetchTableReportBank();</script>";
?>          
          <div class="row" id="tableReportBank">
          </div>
        </div>         
      </li>
    </ul>
  </div>

</body>
</html>
<?php
 mysqli_close($conn);
?>