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
<div class="content-aboutus">

Welcome to the Wildflowers Inn! Purchased in 2021, this massive home with incredible
views is now rentable by large groups of guests for friends gatherings, family reunions
or special events. With multiple livings rooms, 10 bedrooms and 10.5 bathrooms our
home can handle any size group! Located only 5 minutes from downtown North Conway,
our home is perfectly situated between North Conway Village and the best hiking/skiing
in the Mt. Washington Valley! Come and make memories here in our little piece of history.
            
                <br><br>
                    <h3>The space</h3>
                    <br>
<p>Fabulous multi-level 1878 Victorian home with unique decor in the heart of North Conway!
Ten Elegant Bedrooms each with gas fireplaces and private baths, some with jacuzzis. Sunroom and
Deck with the most spectacular views of Mount Washington! Featured in The March 1879 issue of "The 
American Architect and Building News" and "Summer Cottages in the White Mountains". Our home is ready
for you to make lifelong memories!
</p>
<p>
This Country Inn was Built in 1878 on a hillside in New Hampshire's beautiful Mount Washington Valley
overlooking the Saco River basin, the Wildflowers Inn commands exceptional panoramic views of the valley
and Mt Washington. Wildflowers Inn is a haven for those who appreciate nature and exceptional hospitality.
</p>
<p>
All rooms have: Private Bathrooms, Fireplaces, Air Conditioners and WIFI, some with jacuzzi tubs,
Cable HD LCD TVs and Apple TVs. Take full advantage of the spectacular views
while enjoying a full country breakfast on our sun porch, relaxing in our library, or enjoying a game of pool or
watching our big screen TV in our great common room.
</p>
<p>
The beautiful back yard features a private hot tub, a large deck, an outdoor dining table,
a fire pit, a gazebo, a picnic table and an outdoor play and swing set.
</p>
<p>
Whether you come to ski, snowmobile, hike, fish, bike, golf, horseback riding,
snowshoeing, or to enjoy any of the many year round activities offered in this lovely 
recreation destination, the Wildflowers Home is the perfect place to experience it all.
</p>
<br>Guest access: You will have access to the entire place.

<br><br>Amenities: Fully equipped kitchen , BBQ grill, Washer, Dryer, AC, Ceiling fans, 
Fireplaces, Wi-fi, Piano, Pool table, board games
<br><br>
  



</body>
</html>