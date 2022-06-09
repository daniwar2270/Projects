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


</div>

<div class="user_panel">
<a class="button reviews" href="admin_reviews.php">View/Approve Reviews</a>

<a class="button reviews" href="admin_reservations.php">View/Approve Reservations</a>
<a class="button reviews" href="admin_news.php">Post News</a>
<?php require "check_role_panel.php" ?>

<div>

<br><br><br>

</head>

<body>


<br>
<form method="post" action="approve_review.php">
  
  <input type="search" id="review" name="review" placeholder="Input review Id:">
  
  <input class="button reviews" type="submit" value="Approve">
  
</form>

<?php


try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
    $sql='SELECT id, name, review,rating,date,is_approved FROM reviews ORDER BY id LIMIT 50';
    $result = $conn-> query($sql);
   echo"<br>";
   echo "<table id='reviews'>"; 
   echo "<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Review</th>
    <th>Rating</th>
    <th>Date</th>
    <th>Approved</th>
    
   </tr>";
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        

        
       
        echo "<tr><td>"  . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["review"].  "</td><td>". $row["rating"].  "</td><td>". $row["date"].  "</td>
        
        <td>"; 
        if($row['is_approved']=='1') {       
        echo "yes";}
        else {echo "no";}
        
        
        echo"</td></tr>";
        
      }
      echo "</table>" . "</br>";

      
    ?>

  
</body>
</html>

