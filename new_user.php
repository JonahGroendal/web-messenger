<?php

require("dbconfig.php");


//echo var_dump($_POST);

try {
	$pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
	echo 'Database connection failed: ' . $e->getMessage();
}


$username = $_POST["username"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];

/* hash the password for insertion into database */
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_DEFAULT);

//echo "hashed pass: ".$hash ;


//check if user already exists in database

$sql = $pdo->prepare("SELECT username FROM users WHERE username = :name");
$sql->bindParam(':name',$username);
$sql->execute();



if($sql->rowCount() > 0) {
	echo "<p>Username ".$username." already exists in database! Cannot insert.</p>";

	//TODO: if username exists, redirect back to registration page and display error there.
}else{

	//insert the new user into the database
	$sql = $pdo->prepare("INSERT INTO USERS (username,first_name,last_name,password) VALUES (:uname,:first,:last,:pass)");

	$status = $sql->execute(array(

		':uname' => $username,
		':first' => $firstName,
		':last' => $lastName,
		':pass' => $hash


		));

	if($status) {
		echo "registration successful!";
	}


}



?>