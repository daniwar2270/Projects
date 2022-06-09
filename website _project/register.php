<?php

session_start();
//no need of id (its AUTO INCREMENTED)
$name = $_POST['name'];
$user_password = $_POST['password'];
$user_password_repeat = $_POST['password_repeat'];
$email = $_POST['email'];


$hashed_password=password_hash($user_password,PASSWORD_DEFAULT);
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
if ($user_password === $user_password_repeat) {
    // success!
    
 }
 else {
    header('Location: main.php?register=passnomatch');
    exit();
 }

$check_query = "SELECT email FROM user WHERE email='$email'  ";
$res = mysqli_query($mysqli, $check_query);
if(mysqli_num_rows($res) > 0){
    header('Location: main.php?register=emailtaken');
    exit();
}
$insert_query = "INSERT INTO user (name,password,email) 

VALUES ('$name','$hashed_password','$email')";

if($mysqli->query($insert_query)===TRUE){
    //success message
    
    $_SESSION['registered'] = TRUE;

    header('Location: main.php?register=success');
}
else {
   
    //error message

}
$mysqli -> close();
?>



