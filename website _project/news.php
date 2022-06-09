<?php

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM user WHERE Id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['Id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();



//no need of id (its AUTO INCREMENTED)

$review = $_POST['review'];
$user_id=$_SESSION['Id'];


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
 




$insert_query = "INSERT INTO news (news,user_id) VALUES ('$review', '$user_id');";




if($mysqli->query($insert_query)===TRUE){
    //success message
    
    header('Location:admin_panel.php?news=success');
    
}
else {
    header('Location:admin_panel.php?news=error');
    //error message

}
$mysqli -> close();

	
	




////("INSERT INTO news (news,user_id) VALUES ($review, $user_id);");
?>



