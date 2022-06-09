<?php

session_start();





//no need of id (its AUTO INCREMENTED)
$name = $_SESSION['name'];
$review = $_POST['review'];
$date = date("Y.m.d");
$email =$_SESSION['email'];
$user_id = $_SESSION['Id'];

try {
    $conn = new PDO("mysql:host=localhost; dbname=test", 'root', '');
    }
    
    catch (PDOException $e){
        $errorInfo= $e->errorInfo;
        echo "There is an error with the database connection: " . $errorinfo[1];
    }
 
	$stmt = $conn->prepare("SELECT id, name, email,mobile,start_date,end_date,payment,No_adults,No_children,amount,status FROM reservations WHERE user_id='$user_id' ");
	
	$stmt->execute();
	$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
	

	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	

 
	
	if( ! $rows)
	{
        header('Location: user_review.php?rating_check=nores');
        exit();
	}




if(strlen($_POST['rating'])<=0)
{
    header('Location: user_review.php?rating_check=failed');
    
}

$rating = $_POST['rating'];


//$hashed_password=password_hash($user_password,PASSWORD_DEFAULT);
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
 


if(strlen($_POST['rating'])>0){

$insert_query = "INSERT INTO reviews (name,review,rating,date,email,user_id) 

VALUES ('$name','$review','$rating','$date','$email','$user_id')";




if($mysqli->query($insert_query)===TRUE){
    //success message
    
    header('Location:user_review.php?rating_check=success');
    
}
else {
    header('Location:user_review.php?rating_check=dupeid');
    //error message

}
$mysqli -> close();
}
?>



