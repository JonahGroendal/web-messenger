<?php

require_once("dbconfig.php");



?>

	<title>Web Chat Login</title>
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="spike.css">

<body>
	<div id="header">
		<h1>Web Chat</h1>
	</div>

	<div id="parent">
		<div id="main-column">


			<h2>Welcome to Web Chat</h2>


			<form id="login-form" action="login_process.php" method="post"> 


				<label for="inputUserName" class="sr-only">Username</label>
				<input type="text" name="username" required id="inputUserName" class="form-control" placeholder="Username">

				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" required id="inputPassword" class="form-control" placeholder="Password">

				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>












			</form>

      <a href="register.php">Don't have an account? Register</a>
			
		</div>
	</div>



</body>
</html>