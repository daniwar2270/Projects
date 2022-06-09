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


</div>
<br><br><br>

</head>

<body>


<br>

<div class="user_panel">
<form method="post" action="update_res.php">
  
  <input type="search" id="res" name="res" placeholder="Input reservation Id:">
  
  <input class="button reviews" type="submit" value="Edit">
</form>

</div>
<?php
// We need to use sessions, so you should always start sessions using the below code.

// If the user is not logged in redirect to the login page...






$user = 'root';
$password = ''; 
$database = 'test'; 
  
$email = $_SESSION['email'];

     if (isset($_GET['check'])) {

		if ($_GET['check']=='error') {
    	echo "<br><br> <div class=error >Error!</div>";
    	}
    else if ($_GET['check']=='success') {
        echo "<div class=success><br><br>Change successuly made!</div>";
        }

    }





try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
    $sql="SELECT id, name, email,mobile,start_date,end_date,payment,No_adults,No_children,amount,status FROM reservations ORDER BY 'start_date' ";
    $result = $conn-> query($sql);
   
    



      
    ?>


<br>
<form method="post" action="update_res.php">
  
  


  <?php 


  echo"<h3>Reservation DETAILS:</h3>";

  echo"<br>";
   echo "<table id='reviews'>"; 
   echo "<tr>
    <th>id</th>
    <th>name</th>
    <th>email</th>
    <th>Mobile</th>
    <th>Arrival</th>
    <th>Departure</th>
    <th>Payment type</th>
    <th>No of adults</th>
    <th>No of children</th>
    <th>Amount</th>
    <th>Status</th>
   </tr>";
    
        
   while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        
       
        echo "<tr>
        <td>".$row['id']."</td>
        <td>" . $row["name"]. "</td>
        <td>" . $row["email"].  "</td>
        
        <td>".$row['mobile']."</td>
        
        <td>".$row['start_date']."</td>
        
        <td>".$row['end_date']."</td>
        
        <td>".$row['payment']."</td>

        <td>".$row['No_adults']."</td>

        <td>".$row['No_children']."</td>

        <td>".$row['amount']."</td>

        <td>".$row['status']."</td>



        
        </tr>";
        
   }
      echo "</table>" . "</br>";

     
    
        
   
  
  
  ?>


</form>



</body>
</html>
