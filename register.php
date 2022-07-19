<?php
	include("dbconnect.php");
	if(isset($_POST['submit']))
	{
		$name = $_POST['fname'];
		$age = $_POST['age'];
		$address = $_POST['adrs'];
		$num = $_POST['pno'];
		$pswd = $_POST['psw'];
		$cnfrm = $_POST['confirm'];
		if($pswd == $cnfrm)
		{
			$sqli = "SELECT * FROM passengers WHERE phone_number='$num'";
			$run = mysqli_query($con,$sqli);
			if(mysqli_num_rows($run) > 0)
			{
				echo '<script type="text/javascript">alert("phone number is already registered....Try another!")</script>';	
			}
			else
			{
			$query = "INSERT INTO passengers VALUES('','$name','$address','$age','$num','$pswd')";
			$result = mysqli_query($con,$query);
			echo '<script type="text/javascript">alert("Registration successfull")</script>';
			echo '<script type="text/javascript">alert("click cancel to exit")</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">alert("Paswords does not match")</script>';
			echo '<script type="text/javascript">alert("Registration Failed")</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<div class="fullbody">
		<div class="headpart">
			<div class="logoparts">
				<img src="symbol.webp" class="railwaylogo">
			</div>
			<div class="heading">
				<h1 class="headingstyle">Indian Railway</h1>
				<p style="font-size: 25px;margin-top: -24px;margin-left: 36px;">Registration Page</p>
			</div>
		</div>
		<div class="sectionpart w3-container">
			<div class="formpart">
				<form action="register.php" style="border:1px solid #ccc" method="POST">
					<div class="container">
					    <h1>Sign Up</h1>
					    <p>Please fill in this form to create an account.</p>
					    <hr>

					    <label for="name"><b>Name</b></label>
					    <input type="text" placeholder="Enter Name" name="fname" required>

					    <label for="age"><b>Age</b></label>
					    <input type="text" placeholder="Enter Age" name="age" required>

					    <label for="address"><b>Address</b></label>
					    <input type="text" placeholder="Enter Address" name="adrs" required>

					    <label for="pno"><b>Phone number</b></label>
					    <input type="text" placeholder="Enter Phone:no" name="pno" required>

					    <label for="psw"><b>Password</b></label>
					    <input type="password" placeholder="Enter Password" name="psw" required minlength="8">

					    <label for="confirm"><b>Confirm Password</b></label>
					    <input type="password" placeholder="Confirm Password" name="confirm" required minlength="8">

					    <label>
					      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
					    </label>

					    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

					    <div class="clearfix">
					      <button type="button" class="cancelbtn" onclick="location.href='login.php'">Cancel</button>
					      <button type="submit" class="signupbtn" name="submit">Sign Up</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>