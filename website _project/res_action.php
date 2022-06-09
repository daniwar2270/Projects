<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: main.php');
	exit;
}
$res_id= $_POST['Id'];



$status = $_POST['status'];



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
            $insert_query = "UPDATE reservations SET status='$status' WHERE id='$res_id' ";


        if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

    header('Location: admin_reservations.php?check=success');
            }
        else {
            header('Location: admin_reservations.php?check=error');
    //error message

            }
            $mysqli -> close();
        }
        else if(array_key_exists('remove', $_POST)) {
            $insert_query = "DELETE FROM reservations WHERE id='$res_id'";


        if($mysqli->query($insert_query)===TRUE){
    //success message
    
    

                    header('Location: admin_reservations.php?check=success');
            }
        else {
            header('Location: admin_reservations.php?check=error');
    //error message

            }
            $mysqli -> close();
        }
        
    






?>