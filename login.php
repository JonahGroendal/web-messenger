<?php

echo var_dump($_POST);

require("dbconfig.php");

try {

	$pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
	echo "<div>Database connection is good! Redirecting in 5 seconds...<div>";


	header("Refresh: 5; url=main.php");

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
