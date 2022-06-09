
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
<form class="modal-content" action="reservation_action.php" method="post">
    <div class="container-signup">
      <h1 style="align-content: center">Request Reservation</h1>
      
    

     

      
      

      <label for="text"><b>Mobile number</b></label> <br>
     
   <input for=text name="mobile"  require></input><br><br>
   <label for="adults"><b>Select number of adults</b></label> <br><br>
   <select name='adults' >
        <option value=0> Select an option </option>
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
        <option value=9>9</option>
        <option value=10>10</option>
        <option value=11>11</option>
        <option value=12>12</option>
        <option value=13>13</option>
        <option value=14>14</option>
        <option value=15>15</option>
        <option value=16>16</option>
        <option value=17>17</option>
        <option value=18>18</option>
        <option value=19>19</option>
        <option value=20>20</option>
       
       
    </select><br><br>

    <label for="adults"><b>Select number of children</b></label> <br><br>
    <select name='children' >
    <option value=0> Select an option </option>
    
        <option value=1>1</option>
        <option value=2>2</option>
        <option value=3>3</option>
        <option value=4>4</option>
        <option value=5>5</option>
        <option value=6>6</option>
        <option value=7>7</option>
        <option value=8>8</option>
        <option value=9>9</option>
        <option value=10>10</option>
        <option value=11>11</option>
        <option value=12>12</option>
        <option value=13>13</option>
        <option value=14>14</option>
        <option value=15>15</option>
        <option value=16>16</option>
        <option value=17>17</option>
        <option value=18>18</option>
        <option value=19>19</option>
        <option value=20>20</option>
        </select>  <br><br>

   <label for="arrival"><b>Arrival</b></label> 
   <input id="arrival" type="date" name="arrival" onchange="updateCost()" require>
   <label for="departure"><b>Departure</b></label> 
   <input id="departure" type="date" name="departure" onchange="updateCost()"  require><br><br>

   <label for="amount"><b>Total amount due:</b></label> 
   <p style="font-size: 10px">rate is 1000 USD per night</p>
   <input readonly type=search id="amount" name='amount'  >

	 
      <br><br>

  
   <label for="payment_type"><b>Payment type:</b></label> 
   <select name='payment_type' >
    <option value=cash> Select an option </option>
    
        <option value=cash>Cash</option>
        <option value=check>Check</option>
       
        </select>  <br><br>



    

      <div class="clearfix">
        <button type="button" style="" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" >Submit</button>
      </div>
    
</div>



  </form>
  


 

</body>
</html>