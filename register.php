<?php





?>

<title>Registration</title>
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" type="text/css" href="spike.css">

<body>

	<div id="header">
		<h1>Web Chat</h1>
	</div>


	<div id="parent">
		<div id="main-column">


			<h2>Welcome to Web Chat</h2>
			<p>Enter your information: </p><br>


			<form id="registration-form" action="new_user.php" method="post"> 


				<label for="inputUserName" class="sr-only">Username</label>
				<input type="text" name="username" required id="inputUserName" class="form-control" placeholder="Username">

				<label for="inputPassword1" class="sr-only">Password</label>
				<input type="password" name="password" required id="inputPassword1" class="form-control" placeholder="Password">

				<label for="inputPassword2" class="sr-only">Retype password:</label>
				<input type="password" name="password" required id="inputPassword2" class="form-control" placeholder="Password">

				<label for="firstName" class="sr-only">First Name</label>
				<input type="text" name="firstName" required id="firstName" class="form-control">

				<label for="lastName" class="sr-only">Last Name</label>
				<input type="text" name="lastName" required id="lastName" class="form-control">


				<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>












			</form>


			
		</div>
	</div>











</body>
