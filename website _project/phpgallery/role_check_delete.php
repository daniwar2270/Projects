


<?php

if(isset($_SESSION['role'])){
if($_SESSION['role'] == 'user'){
   
}


else if($_SESSION['role'] == 'admin'){

   echo'
   
   <a href=delete.php?id=${img_meta.dataset.id} class=trash title=Delete Image><i class="fas fa-trash fa-xs"></i></a>
    ';
}

else if($_SESSION['role'] == 'mod'){
   
    echo'
   
    <a href=delete.php?id=${img_meta.dataset.id} class=trash title=Delete Image><i class="fas fa-trash fa-xs"></i></a>
     ';
}
}

?>

