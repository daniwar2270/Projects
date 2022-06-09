<?php
 if($_SESSION['role'] == 'admin'){
   
   echo"<a class='button reviews' href='admin_users.php'>View/Edit Users</a>";
   
}

else if($_SESSION['role'] == 'mod'){
  
   echo"";
}

?>