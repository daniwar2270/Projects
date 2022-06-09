<?php

if(isset($_SESSION['role'])){
if($_SESSION['role'] == 'user'){
   
}


else if($_SESSION['role'] == 'admin'){
   
    echo"<a href=upload.php class=upload-image>Upload Image</a>";
}

else if($_SESSION['role'] == 'mod'){
   
    echo"<a href=upload.php class=upload-image>Upload Image</a>";
}
}

?>