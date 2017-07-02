<?php

require('dbconfig.php');

//echo "<p> friends list here </p>";

//echo "<p>current user ID is ".$_GET['uid']."</p>";

//TODO: query mySQL database for friends list and display them

try {
	
	$pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
	//echo "<div>Database connection is good!</div>";

	//tricky sql statement...

	//currently this requires storing 1,2 and 2,1 to get proper friendships between user 1 and user 2.
	
	$sql = $pdo->prepare("SELECT first_name,last_name FROM users, friendships WHERE users.id=friendships.id2 AND friendships.id1=:uid1");

	$sql->execute(array(':uid1' => $_GET['uid']));

	//$friends = $sql->fetchObject();
	$friends = $sql->fetchAll();

	if(!empty($friends)) {

		foreach($friends as $f) {

			echo "<p>".$f['first_name']. " ".$f['last_name']."</p>";

		}

	
	}else{
		echo "<p>Looks like you have no friends.</p>";
	}



	/*
	//query the database for the username entered
	$sql = $pdo->prepare("SELECT * FROM users WHERE username = :uname");
	$sql->execute(array(':uname' => $_POST["username"]));
	$user = $sql->fetchObject();			

	
	//if we found that user, match the hash of the entered password with the hashed password in the db
	if(!empty($user)) {
		if(password_verify($_POST['password'],$user->password)) {

			echo "<p>valid login! Redirecting in 5 seconds...</p>";
			header("refresh:5; url=main.php?uid=".$user->id);

		}else{

			echo "invalid password for user ".$user->username;

		}
	}else{
		echo "username not found";

		//TODO: redirect back to login page, display user not found error
	}

	*/
	//header("Refresh: 5; url=main.php");

} catch (PDOException $e) {
	echo 'Database connection failed: ' . $e->getMessage();
}








?>