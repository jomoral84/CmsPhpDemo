<?php include "db.php";   ?>

<?php session_start()         // Inicia la session   
?>  
<?php

if (isset($_POST['login'])) {

	$user_username = $_POST['user_username'];
	$user_password = $_POST['user_password'];

	$user_username = mysqli_real_escape_string($connection, $user_username);    // This function is used to create a legal SQL string that you can use in an SQL statement.
	// The given string is encoded to an escaped SQL string, taking into account the current character set of the connection. 
	$user_password = mysqli_real_escape_string($connection, $user_password);


	$query = "SELECT * FROM users WHERE user_username = '{$user_username}'";
	$select_user_query = mysqli_query($connection, $query);


	if (!$select_user_query) {
		die("QUERY FAILED" . mysqli_error($connection));
	}


	while ($row = mysqli_fetch_array($select_user_query)) {

		echo $db_user_id = $row['user_id'];
		echo $db_user_username = $row['user_username'];
		echo $db_user_password = $row['user_password'];
		echo $db_user_firstname = $row['user_firstname'];
		echo $db_user_lastname = $row['user_lastname'];
		echo $db_user_role = $row['user_role'];
	}


	if (password_verify($user_password, $db_user_password)) {     // Esta funcion chequea si el nombre y password ingresados son los mismos que en la DB

		$_SESSION['user_username'] 	= $db_user_username;
		$_SESSION['user_firstname'] = $db_user_firstname;
		$_SESSION['user_lastname'] 	= $db_user_lastname;
		$_SESSION['user_role'] 		= $db_user_role;


		header("Location: ../admin/index.php");
	} else {

		header("Location: ../index.php");
	}
}
