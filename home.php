<?php
  session_start();
  include("dbconnect.php");
  if(!$_SESSION['username'])
  {
    header('location:login.php');
  }

  if(isset($_POST['submit']))
  {
    $starting = $_POST['startingloc'];
    $ending = $_POST['endingloc'];
  }
  ?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="home.css" type="text/css" rel="stylesheet">
</head>

<body>
  <div class="logopart">
    <img src="symbol.webp" class="logo">
  </div>
    <form action="traininfo.php" method="post">
      <h1 class="head">SEARCH TRAINS</h1>
      <label for="uname"><b class="starting">Starting Point </b></label>
        <?php
          $sqli = "SELECT * FROM route";
          $result = mysqli_query($con,$sqli);
        ?>
        <select name="startingloc">
          <?php
            while($rows = $result->fetch_assoc())
            {
              $start = $rows['start'];
              echo "<option value='$start'>$start</option>";
            }
          ?>
        </select>
        <br>
        <label for="uname"><b class="starting pos">Ending  Point </b></label>
        <?php
          $sqli = "SELECT * FROM route";
          $result = mysqli_query($con,$sqli);
        ?>
        <select name="endingloc">
          <?php
            while($rows = $result->fetch_assoc())
            {
              $end = $rows['end'];
              echo "<option value='$end'>$end</option>";
            }
          ?>
        </select>
        <br>
        <button type="submit" class="buttons" name="submit">Search</button>
    </form>
  </div>
</body>
</html>