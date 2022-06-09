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
<?php
// We need to use sessions, so you should always start sessions using the below code.

// If the user is not logged in redirect to the login page...


$review_id = $_POST['edit'];



$user = 'root';
$password = ''; 
$database = 'test'; 
  


try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
    $sql="SELECT Id, name, email,role FROM user WHERE Id = '$review_id'";
    $result = $conn-> query($sql);
   
    $row = $result->fetch(PDO::FETCH_ASSOC)



      
    ?>


<br>
<form method="post" action="update_user.php">
  
  


  <?php 


  echo"<h3>USER DETAILS:</h3>";

  echo"<br>";
   echo "<table id='reviews'>"; 
   echo "<tr>
    <th>Id</th>
    <th>Name</th>
    <th>email</th>
    <th>Role</th>
    
   </tr>";
    
        

        
       
        echo "<tr><td>"  . $row["Id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"].  "</td>
        
        <td>".$row['role']."</td></tr>";
        
      
      echo "</table>" . "</br>";

     
    
        
   echo"<h3>EDIT USER DETAILS:</h3>";

        
   echo "<table  id='reviews'>"; 
   echo "<tr>
    <th>Id</th>
    <th>Name</th>
    <th>email</th>
    <th>Role</th>
    
   </tr>";
        echo "<tr><td>  <input readonly type=search id=Id name='Id' value=".$row['Id'] ." placeholder='Input Id'> </td><td><input type=text id=name name='name' value=\"" . $row['name'] . "\" placeholder='Input name'></td><td><input type=search id=email name=email value=".$row['email'] ." placeholder='Input email'></td>
        
        <td> <select name='role' >
        <option value=".$row['role'] ."> Select an option </option>
        <option value='user'>User</option>
        <option value='mod'>Moderator</option>
        
        </select> </td></tr>";
        
      
      echo "</table>" . "</br>";
 
  echo"<br>";

 
  
  
  ?>

<input class=button reviews type=submit name=update value=UPDATE>
<input class=button reviews type=submit style="background-color:darkred" name=remove value=REMOVE>
</form>



</body>
</html>
