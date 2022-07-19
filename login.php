<?php
	session_start();
	include("dbconnect.php");
	if(isset($_POST['submit']))
	{
		$user = $_POST['uname'];
		$pass = $_POST['psswd'];
		$query = "SELECT * FROM passengers WHERE name='$user' AND password='$pass'";
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		if($count == 1)
     	{
     		$_SESSION['username'] = $user;
     		header('location:home.php');
     	}
     	else
     	{
     		$message = "please enter the correct details";
     		echo "<script type='text/javascript'>alert('$message');</script>";
     	}
     	$sqli = "SELECT p_id FROM passengers WHERE name='$user' AND password='$pass'";
  	 	$result = mysqli_query($con,$sqli);
    	while($rows = $result->fetch_assoc())
    	{
        	$_SESSION['id'] = $rows['p_id'];
        }
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
			<link href="login.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="whole-body">
			<div class="container">
				<div class="logopart">
					<img src="symbol.webp" class="logo">
				</div>
				<div class="formpart">
					<form class="loginform" action="login.php" method="post">
						<label class="loginhead">Login</label>
						<label><input type="text" name="uname" placeholder="username" id="username" required></label>
						<label><input type="password" name="psswd" placeholder="password" id="password" required minlength="8"></label>
						<label><input type="submit" name="submit" value="Login" class="loginbutton"></label>
					</form>
					<br>
					<form action="register.php">
						<label><p style="color: black;font-weight: bold;font-size: 17px;margin-left: -106px;margin-bottom: -27px;">do not have an account?</p>
						<input type="submit" name="submit" value="Register" class="registerbutton" style="width: 72px;margin-left: -104px;">Register</label>
					</form>		
				</div>
			</div>
		</div>
	</body>
</html>