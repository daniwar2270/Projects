<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: main.php');
	exit;
}

$review_id = $_POST['review'];



$user = 'root';
$password = ''; 
$database = 'test'; 
  
$servername='localhost';
$mysqli = new mysqli($servername, $user, 
                $password, $database);
  
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' . 
    $mysqli->connect_errno . ') '. 
    $mysqli->connect_error);
}



$insert_query = "UPDATE reviews SET is_approved='1' WHERE id=$review_id";



if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

    header('Location: admin_reviews.php');
}
else {
   
    //error message

}
$mysqli -> close();
?>