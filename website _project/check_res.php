<?php

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: main.php');
	exit;
}


$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM user WHERE Id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['Id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>




<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="calendar.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="navbar.js"></script>
<link rel="stylesheet" type="text/css" href="main.css" />




<div class="topnav" id="myTopnav">
  <!--<img src="logo.png" href="#home" class="nav_logo"></img>-->
  <a href="#home" class="active">Home</a>
  <a href="#news">News</a>
  <a href="#contact">Contact</a>
  <a href="#about">About</a>
  
  <?php
  require "check_role.php"
  ?>
 
  <a href="javascript:void(0);" class="icon" >
    <div class="container" onclick="toggle_Navbar(this),myFunction()" >
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
  </a>
</div>




</head>

<body>


	 
      

     <?php
$reserved = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
    
    );



   try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
    $sql='SELECT id, name, start_date,end_date FROM reservations ';
    $result = $conn-> query($sql);
   
    // Days to highlight
    $day_to_highlight = array();
   //array_push($day_to_highlight,)
   
   // while($row = $result->fetch(PDO::FETCH_ASSOC)){  };
   


   
   while($row = $result->fetch(PDO::FETCH_ASSOC)) {

    $arrival_date=$row['start_date'];

   $departure_date=$row['end_date'];


   echo " <br>".$arrival_date." <br>";
        echo $departure_date." <br>";
       


$date_start = date_create_from_format('Y-m-d', $arrival_date);
$array_date_start = array(
    (int)$date_start->format('Y'),
    (int)$date_start->format('m'),
    (int)$date_start->format('d')
);

$date_end = date_create_from_format('Y-m-d', $departure_date);
$array_date_end = array(
    (int)$date_end->format('Y'),
    (int)$date_end->format('m'),
    (int)$date_end->format('d')
    );


    $Date = getDatesFromRange($arrival_date, $departure_date);
  

    foreach($Date as $dates){
        $curr_date_array=explode("-",$dates);
    
        array_push($reserved[$curr_date_array[1]-1],$curr_date_array[2]);
    }
}



        
//print_r($array_date_start);
//print_r($array_date_end);




//echo $date_interval['d'];

//get duration of stay 


///////////////////////////////////////////////////////////////////////

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}
  
// Function call with passing the start date and end date




//////////////////////////////////////////////////////////////////////


// Get the current date
$date = getdate();

// Get the value of day, month, year
$m = array('Jane','February','March','April','May','June','July','August','September','October','November','December');






$months= array(
    array("Jan",$reserved),
    array("Feb",$reserved),
    array("Mar",$reserved),
    array("Apr",$reserved),
    array("May",$reserved),
    array("Jun",$reserved),
    array("Jul",$reserved),
    array("Aug",$reserved),
    array("Sep",$reserved),
    array("Oct",$reserved),
    array("Nov",$reserved),
    array("Dec",$reserved)


);