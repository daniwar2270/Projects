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


<?php
     if (isset($_GET['rating_check'])) {

		if ($_GET['rating_check']=='failed') {
    	echo "<br><br> <div class=error >No rating selected!</div>";
    	}


      else 	if ($_GET['rating_check']=='dupeid') {
        echo "<br><br> <div class=error >You have already submitted a review!</div>";
        }
    else if ($_GET['rating_check']=='success') {
        echo "<div class=success><br><br>Successfuly submited review!</div>";
        }
        else if ($_GET['rating_check']=='nores') {
          echo "<div class=error><br><br>You do not have any reservations!</div>";
          }
        

    }

?>


</head>

<body>

  
<form class="modal-content" action="review.php" method="post">
    <div style="text-align: center;"class="container-signup">
      <h1 >Leave a review.</h1>
      <p >Please fill in this form to submit a review.</p>
      <br><br>
      <p >Rate your experience from 1 to 5 stars.</p>
	  <fieldset style="    border: none;
    margin: auto;
    padding: 11px;
    display: inline"class="rating" >
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2.5 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
</fieldset>
    

     <br><br>

      
      

     <p >Leave a review of your experience at Wildflowers Inn.</p>
     <div style="text-align: center;
    margin: auto;
    padding: 10px;">
   <textarea id="review"style="    height: 225px;
    width: 50%;"  name="review"  placeholder="type review" required></textarea>

  </div>
      

     

      <div class="clearfix" style="    margin: auto;
    width: 250px;
    padding: 10px;">
        
        <button type="submit" style="float: left;
    margin: auto;
    width: 100%;
    padding: 10px;
}"  class="signupbtn" >Submit</button>
      </div>
    
</div>



  </form>

 

</body>
</html>