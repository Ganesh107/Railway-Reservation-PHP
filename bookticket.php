<?php
	session_start();
	include("dbconnect.php");
  	if(!$_SESSION['username'])
  	{
    	header('location:login.php');
  	}
  	
  	 
  	if( !empty($_POST['name']) && !empty($_POST['age']) && is_array($_POST['name']) && is_array($_POST['age']) &&
    count($_POST['name']) === count($_POST['age']))
  	{
  		$id = $_SESSION['id'];
  		$train = $_POST['trainselect'];
  		$quota = $_POST['quota'];
  		$clas  = $_POST['classname'];
  		$_SESSION['tnum'] = $_POST['tno'];
  		$tnum = $_SESSION['tnum'];
  		$_SESSION['date']  = $_POST['dte'];
  		$date = $_SESSION['date'];
  		$name_array = $_POST['name'];
  		$age_array = $_POST['age'];

  		$sqli = "SELECT * FROM train_info WHERE train_name='$train'";
  	 	$result = mysqli_query($con,$sqli);
    	while($rows = $result->fetch_assoc())
    	{
        	$_SESSION['num'] = $rows['train_number'];
	        $_SESSION['start'] = $rows['source'];
	        $_SESSION['end'] = $rows['destination'];
	        $start = $_SESSION['start'];
	  	    $end = $_SESSION['end'];
  		}

  		for ($i = 0; $i < $tnum; $i++)
  		{ 	
  			if($clas == 'SL')
  			{
  				$query = "SELECT * FROM sl_class ORDER BY RAND() LIMIT 15";
  				$result = mysqli_query($con,$query);
  				$row = mysqli_fetch_array($result);
				$coach = $row['coach_number'];
				$berth = $row['berth_number'];

  			}
  			elseif($clas == '1A')
  			{
  				$query = "SELECT * FROM 1a_class ORDER BY RAND() LIMIT 15";
  				$result = mysqli_query($con,$query);
  				$row = mysqli_fetch_array($result);
				$coach = $row['coach_number'];
				$berth = $row['berth_number'];
  			}
  			elseif($clas == '2A')
  			{
  				$query = "SELECT * FROM 2a_class ORDER BY RAND() LIMIT 15";
  				$result = mysqli_query($con,$query);
  				$row = mysqli_fetch_array($result);
				$coach = $row['coach_number'];
				$berth = $row['berth_number'];
  			}
  			else
  			{
  				$query = "SELECT * FROM 3a_class ORDER BY RAND() LIMIT 15";
  				$result = mysqli_query($con,$query);
  				$row = mysqli_fetch_array($result);
				$coach = $row['coach_number'];
				$berth = $row['berth_number'];	
  			}
  			$sqli = "SELECT seats FROM train_info WHERE train_name='$train'";
  	 		$result = mysqli_query($con,$sqli);
    		while($rows = $result->fetch_assoc())
    		{
        		$_SESSION['seat'] = $rows['seats'];
       	 	}
       	 	$seat=$_SESSION['seat'];
       		$number=count($name_array);
       		$final=$seat-$number;
       		 

  				  		
		    $name = mysqli_real_escape_string($con,$name_array[$i]);
		    mysqli_query($con,"INSERT INTO tickets VALUES('','$name','$train','$start','$end','$quota','$clas','$coach','$berth','$date','$id')");
		    header('location:viewticket.php');
        }  
  	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>tickets</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="bookticket.css">
</head>
<body>
	<div class="fullbody">
		<div class="headpart">
			<div class="logoparts">
				<img src="symbol.webp" class="railwaylogo">
			</div>
			<div class="heading">
				<h1 class="headingstyle">Indian Railway</h1>
			</div>
			<form action="logout.php">
				<button class="log">Logout</button>
			</form>
		</div>
			<div class="sectionpart w3-container">
				<div class="formparts">
					<form action="bookticket.php" method="POST" id="formid"> 
						<h2>Book your tickets</h2>
						<label class="para">Select Train </label>
							<?php
								$query = "SELECT * FROM train_info";
								$result = mysqli_query($con,$query);
							?>
							<select name="trainselect" class="test">
							<?php
								while($row = $result->fetch_assoc())
								{
									$name = $row['train_name'];
									echo "<option value='$name'>$name</option>";
								}
							?>
							</select>
						<br>
						<label class="para">Select quota</label>
						<select name="quota"> 
							<option>General</option>
							<option>Tatkal</option>
							<option>Ladies</option>
						</select>
						<br>
						<label class="para">Select class</label>
						<select name="classname" class="test1">
							<option>SL</option>
							<option>1A</option>
							<option>2A</option>
							<option>3A</option>
						</select>
						<br>
						<label class="para">Select date</label>
						<input type="date" name="dte" style="margin-left: 13px;">
						<br>
						<h2>Passenger Details</h2>
						<table class="w3-table-all w3-centered">
							<tr>
								<th>SI.NO</th>
								<th>Name</th>
								<th>Age</th>
								<th>sex</th>
							</tr>
							<tr>
								<td>1</td>
								<td>
									<input type="text" name="name[]">
								</td>
								<td>
									<input type="text" name="age[]" style="width: 66px;">
								</td>
								<td>
									<select name="sexa">
										<option>Male</option>
										<option>Female</option>
										<option>Transgender</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>
									<input type="text" name="name[]">
								</td>
								<td>
									<input type="text" name="age[]" style="width: 66px;">
								</td>
								<td>
									<select name="sexb">
										<option>Male</option>
										<option>Female</option>
										<option>Transgender</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>
									<input type="text" name="name[]">
								</td>
								<td>
									<input type="text" name="age[]" style="width: 66px;">
								</td>
								<td>
									<select name="sexc">
										<option>Male</option>
										<option>Female</option>
										<option>Transgender</option>
									</select>
								</td>
							</tr>
							<tr>
						</table>
						<br>
						<p style="color: red;">Note:<label style="color: black;">(No Tickets required for children below 5 years)</label></p>
						<label class="para">Enter number of tickets</label>
						<input type="text" name="tno" style="width: 30px;" required>
						<label><input type="submit" name="submits" value="Book" onclick="next()"></label>
						<br>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function next()
		{
			alert("Proceed to pay?");
		}
	</script>
</body>
</html>