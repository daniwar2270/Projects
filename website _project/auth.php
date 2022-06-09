<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'test';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT Id, password,name , role FROM user WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();




    if ($stmt->num_rows > 0) {
        $stmt->bind_result($Id, $password,$name,$role);
        $stmt->fetch();
        
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['role'] = 'user';
            
            

            




            if($role=='admin')
            {
            $_SESSION['role'] ='admin';
            }


            if($role=='mod')
            {
            $_SESSION['role'] ='mod';
            }
           
            $_SESSION['name'] = $name;
            $_SESSION['Id'] = $Id;
            $_SESSION['email'] = $email;
            header('Location: main.php?login=success');
        } else {
            // Incorrect password
           
            header('Location: main.php?login=error');
        }
    } else {
        // Incorrect username
        header('Location: main.php?login=error');
    }









	$stmt->close();
}
?>