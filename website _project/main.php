<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if(!isset($_SESSION['role']))$_SESSION['role']='guest';
//checks if you are trying to access home page while loggeed in

//checks if you just registered successfuly to display success message

?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="navbar.js"></script>
<link rel="stylesheet" type="text/css" href="main.css" />




<div class="topnav" id="myTopnav">
  <!--<img src="logo.png" href="main.php" class="nav_logo"></img>-->
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





<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="register.php" method="post">
    <div class="container-signup">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter you name" name="name" required>

      
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <label for="password_repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="password_repeat" required>
      
      

      <p>Already have a registration? <a class="login" onclick="document.getElementById('id02').style.display='block' ;document.getElementById('id01').style.display='none'"   style="color:dodgerblue">Log in</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn" >Sign Up</button>
      </div>
    </div>
  </form>
</div>

<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
  <form class="modal-content" action="auth.php" method="post">
    <div class="container-signup">
      <h1>Log in</h1>
      <p>Please fill in this form to Log in.</p>
      <hr>
            
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

     
      
      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <!--<p>Already have a registration? <a class="login" onclick="document.getElementById('id02').style.display='block'" style="color:dodgerblue">Log in</a>.</p>-->

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Log in</button>
      </div>
    </div>
  </form>
</div>
</head>

<body>
<div class="testimonials">
        <h1>Testimonials</h1>
        <div class="test-body">
        <?php






try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
    $sql='SELECT name, review,rating,date,is_approved FROM reviews ORDER BY  id DESC LIMIT 3';
    $result = $conn-> query($sql);
  
    
   
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        
      if($row['is_approved']=='1') {       
        echo"
        <div class=item>
        
        <div class=name>".$row['name']."</div>
        <small class=desig>".$row['date']."</small><br>
        <small class=rating >Rated: ".$row['rating']."/5</small>
        <p>".$row['review']."</p>
    </div>";
        
       
        
      }
    }
    ?>
         </div>
            
    </div>
  
<?php
    if (isset($_GET['register'])) {
  if ($_GET['register']=='passnomatch') {
      echo "<div class=error>Password do not match!</div>";
      }
      else if ($_GET['register']=='emailtaken') {
          echo "<div class=error>Email already registered!</div>";
          }
  
          else if ($_GET['register']=='success') {
              echo "<div class=success>Successfuly registered!</div>";
              }
  
              
  
      }


      if (isset($_GET['login'])) {
        if ($_GET['login']=='success') {
            echo "<div class=success>Successfuly Logged in !</div>";
            }
            else if ($_GET['login']=='error') {
                echo "<div class=error>Incorrect username and/or password!</div>";
                }
        
               
        
                    
        
            }
      ?>


<div class="content">
<div  style="color:white; font-size:16px;">

<?php 
try {
  $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
  }
  
  catch (PDOException $e){
      $errorInfo= $e->errorInfo;
      echo "There is an error with the database connection: " . $errorinfo[1];
  }

$stmt = $conn->prepare("SELECT id,news,date FROM news ORDER BY id DESC LIMIT 20 ");

$stmt->execute();
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);


$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




if( ! $rows)
{
  echo 'No reservations made';
}

else {
  echo"<h3>News and Updates:</h3>";

  
  foreach ($rows as $row) {	
  
      
 //
      
     
      echo "<h2>".$row['date']."</h2><br>".$row['news']." ";
     
      
 
}
   



}

?>


          </div>
          </div>

</body>
</html>

