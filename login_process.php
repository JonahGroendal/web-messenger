<?php

//echo var_dump($_POST);

require("dbconfig.php");

try {

	$pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
	//echo "<div>Database connection is good! Redirecting in 5 seconds...<div>";


	//query the database for the username entered
	$sql = $pdo->prepare("SELECT * FROM users WHERE username = :uname");
	$sql->execute(array(':uname' => $_POST["username"]));
	$user = $sql->fetchObject();


	//if we found that user, match the hash of the entered password with the hashed password in the db
	if(!empty($user)) {
		if(password_verify($_POST['password'],$user->password)) {

			echo "<p>valid login! Redirecting in 5 seconds...</p>";
			// added this to start sesssion -Jonah
			session_start();
			$_SESSION['userId'] = $user->id;

			header("refresh:5; url=main.php?uid=".$user->id);

		}else{

			echo "invalid password for user ".$user->username;

		}
	}else{
		echo "username not found";

		//TODO: redirect back to login page, display user not found error
	}


	//header("Refresh: 5; url=main.php");

} catch (PDOException $e) {
	echo 'Database connection failed: ' . $e->getMessage();
}



/*
$sql = 'SELECT username FROM usernames WHERE username=?';
$query = $pdo->prepare($sql);
$query->bindValue(1, $_POST['username']);
$query->execute();

$result = $query->fetch();


if($result) {
	header("Location: mainpage.html");
	die();
}else{
	header("Location: login.html");
	die();
}
*/






?>
