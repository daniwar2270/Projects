<?php

if(!isset($_SESSION['loggedin'])){



    echo "<button class='signup-btn' onclick=document.getElementById('id01').style.display='block' style=width:auto;>Sign Up</button>

  <button class='signup-btn' onclick=document.getElementById('id02').style.display='block' style='width:auto;'>Login</button>";
}




if($_SESSION['role'] == 'user'){
    echo"<a href=profile.php>Profile</a>";
    echo"<a href=logout.php>Log out</a>";
}

else if($_SESSION['role'] == 'admin'){
   
    echo"<a href=admin_panel.php>Admin Panel</a>";
    echo"<a href=logout.php>Log out</a>";
}

else if($_SESSION['role'] == 'mod'){
   
    echo"<a href=admin_panel.php>Moderator Panel</a>";
    echo"<a href=logout.php>Log out</a>";
}

?>