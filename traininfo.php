<?php
	session_start();
	include("dbconnect.php");
  	if(!$_SESSION['username'])
  	{
    	header('location:login.php');
  	}
  	$start = $_POST['startingloc'];
  	$dest = $_POST['endingloc'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>info</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<style type="text/css">
.tablebody
{
	padding-top: 50px;
}
</style>	
</head>
<body>
     <form action="bookticket.php" method="post">
	<div class="wholebody">
		<h2 align="center">Trains</h2>
		<div class="container">
			<div class="tablebody">
				<table border="5px" class="striped">
					<tr>
						<th>Train number</th>
						<th>Train name</th>
						<th>seats</th>
						<th>Arrival time</th>
						<th>Departure time</th>
						<th>Destination</th>
						<th>Date</th>
						<br>
						<?php
						$query = "SELECT * FROM train_info WHERE destination='$dest' AND source='$start'";
						$result = mysqli_query($con,$query);

						while($row = mysqli_fetch_array($result))
						{
							?>
							<tr>
								<td> <?php echo $row['train_number']; ?> </td>
								<td> <a class="trainname" href="bookticket.php"><?php echo $row['train_name']; ?></a> </td>
								<td> <?php echo $row['seats']; ?> </td>
								<td> <?php echo $row['arrivaltime']; ?> </td>
								<td> <?php echo $row['departuretime']; ?> </td>
								<td> <?php echo $row['destination']; ?> </td>
								<td> <?php echo $row['date']; ?> </td>
							</tr>
						<?php
						}
						?>

					</tr>
				</table>
				<br>
				<button type="submit" class="buttons" name="submit">Book Ticket</button>
				</br>
			</div>
		</div>
	</div>

</body>
</html>