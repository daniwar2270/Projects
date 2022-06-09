<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: main.php');
	exit;
}
$user_id= $_POST['Id'];
$user_name= $_POST['name'];

$user_email = $_POST['email'];
$user_role = $_POST['role'];



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








        if(array_key_exists('update', $_POST)) {
            $insert_query = "UPDATE user SET name='$user_name',email='$user_email',role='$user_role' WHERE Id='$user_id'";


        if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

                    header('Location: admin_users.php');
            }
        else {
   
    //error message

            }
            $mysqli -> close();
        }
        else if(array_key_exists('remove', $_POST)) {
            $insert_query = "DELETE FROM user WHERE Id='$user_id'";


        if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

                    header('Location: admin_users.php');
            }
        else {
   
    //error message

            }
            $mysqli -> close();
        }
        
    





if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

    header('Location: admin_users.php');
}
else {
   
    //error message

}
$mysqli -> close();
?>