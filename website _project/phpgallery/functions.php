<?php
session_start();



function pdo_connect_mysql() {
    // The below variables should reflect your MySQL credentials
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'test';
    try {
        // Connect to MySQL using the PDO extension
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and output the error.
    	exit('Failed to connect to database!');
    }
}

function template_header($title) {
    echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>$title</title>
            <link href="../main.css" rel="stylesheet" type="text/css">
            <script src="../navbar.js"></script>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        </head>
        <body>
        <div class="topnav" id="myTopnav">


        <a href="../main.php" class="active">Home</a>
  
        <a href="gallery.php">Gallery</a>
        <a href="../about.php">About</a>

    EOT;


          require "checking_role.php"; 
    echo <<<EOT
       
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
        <form class="modal-content" action="../register.php" method="post">
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
        <form class="modal-content" action="../auth.php" method="post">
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
      
        
      
    EOT;
    }



    function template_footer() {
        echo <<<EOT
            </body>
        </html>
        EOT;
        }
        
?>

