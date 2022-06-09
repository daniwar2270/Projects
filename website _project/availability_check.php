<style type="text/css">
   table  {
       border:1px solid #aaa;
       border-collapse:collapse;
       background-color:#fff;
       font-family: Verdana;
       font-size:12px;
       margin: auto;
   }
   
   th {
       background-color:#777;
       color:#fff;
       height:32px;
   }
   
   td {
       border:1px solid #ccc;
       height:32px;
       width:32px;
       text-align:center;
   }
   
   td.red {
       color:red;
   }
   
   td.bg-yellow {
       background-color:#ffffe0;
   }
   
   td.bg-orange {
       background-color:#ffa500;
   }
   
   td.bg-green {
       background-color:red;
   }
   
   td.bg-white {
       background-color:#fff;
   }
   
   td.bg-blue {
       background-color:#add8e6;
   }
   
   a {
       color: #333;
       text-decoration:none;
       
   }
</style>
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
<a href="main.php" class="active">Home</a>
  
  <a href="phpgallery/gallery.php">Gallery</a>
  <a href="about.php">About</a>
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

<div class="user_panel" >
<a class="button reviews" href="user_review.php">Submit a Review</a>

<a class="button reviews" href="user_reservations.php">Create a Reservation</a>

<a class="button reviews" href="availability_check.php">Check Availability</a>
</div>



</head>

<body>


	 
      

     <?php
     if (isset($_GET['check'])) {
if ($_GET['check']=='failed') {
    echo "<div class=error>Selected dates unavaiable</div>";
    }
    else if ($_GET['check']=='success') {
        echo "<div class=success>Successfuly reserved!</div>";
        }

        else if ($_GET['check']=='nodate') {
            echo "<div class=error>Error in selected dates!</div>";
            }

            else if ($_GET['check']=='noadults') {
                echo "<div class=error>no adults selected</div>";
                }

    }


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

//array_push($reserved[2],3,4,5);
//print_r ($reserved[2]);
///////////////////////////////////////////////////////////////////////////////////////////////





//////////////////////////////////////////////////////////////////////////////////////////
$mday = $date['mday'];
$mon = $date['mon'];
$wday = $date['wday'];
$month = $date['month'];
$year = $date['year'];

$_SESSION['prevM']=FALSE;
/////////////////////////////////////////////////////////
if(array_key_exists('next', $_POST)&& !($_SESSION['prevM']) )
{

    $_SESSION['nextM'] =TRUE;
    $mon= $mon+1;
    $_SESSION['prevM'] = FALSE;
    }
    
else if(array_key_exists('prev', $_POST) && !($_SESSION['nextM'])) 
{
    $_SESSION['prevM'] =TRUE;
    $mon= $mon-1;
    $_SESSION['nextM'] =FALSE;


    }




//////////////////////////////////////////////////////////

$dayCount = $wday;
$day = $mday;

while($day > 0) {
   $days[$day--] = $dayCount--;
   if($dayCount < 0)
       $dayCount = 6;
}

$dayCount = $wday;
$day = $mday;

if(checkdate($mon,31,$year))
   $lastDay = 31;
elseif(checkdate($mon,30,$year))
   $lastDay = 30;
elseif(checkdate($mon,29,$year))
   $lastDay = 29;
elseif(checkdate($mon,28,$year))
   $lastDay = 28;

while($day <= $lastDay) {
   $days[$day++] = $dayCount++;
   if($dayCount > 6)
       $dayCount = 0;
}	




$currmonth =  $m[$mon-1];




echo"<table border='0' >"; 
echo("<tr>");
echo("<th colspan='7' align='center'>".$currmonth."</th>");
echo("</tr>");
echo("<tr>");
   echo("<td class='red bg-yellow'>Sun</td>");
   echo("<td class='bg-yellow'>Mon</td>");
   echo("<td class='bg-yellow'>Tue</td>");
   echo("<td class='bg-yellow'>Wed</td>");
   echo("<td class='bg-yellow'>Thu</td>");
   echo("<td class='bg-yellow'>Fri</td>");
   echo("<td class='bg-yellow'>Sat</td>");
echo("</tr>");

$startDay = 0;
$d = $days[1];

echo("<tr>");
while($startDay < $d) {
   echo("<td></td>");
   $startDay++;
}

for ($d=1;$d<=$lastDay;$d++) {
   if (in_array( $d, $reserved[$mon-1]))
       $bg = "bg-green";
   else
       $bg = "bg-white";
   // Highlights the current day	
   if($d == $mday && ($mon == $date['mon']))
       echo("<td class='bg-blue'><a href='#' title='Detail of day'>$d</a></td>");
   else 
       echo("<td class='$bg'><a href='#' title='Detail of day'>$d</a></td>");


   $startDay++;
   if($startDay > 6 && $d < $lastDay){
       $startDay = 0;
       echo("</tr>");
       echo("<tr>");
   }
}

echo("</tr>");
echo"</table>";
////////////////////////////////////////////////////////////////////////
//SPACE FOR FORM BUTTONS FOR CALENDAR
?>
<form  style="    margin: auto;
    width: 250px;
    padding: 10px;"action="availability_check.php" method="post">
<input class=button reviews type=submit style="float: left;margin: auto;width: 50%;padding: 10px;"name=prev value=PREV>
<input class=button reviews type=submit style="background-color:gray;float: left;margin: auto;width: 50%;padding: 10px;" name=next value=NEXT>
</form>