<?php
  session_start();
  include("dbconnect.php");
  if(!$_SESSION['username'])
  {
    header('location:login.php');
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
        <img src="images/logo1.png" class="railwaylogo">
      </div>
      <div class="heading">
        <h1 class="headingstyle">Indian Railway</h1>
        <p style="font-size: 22px;margin-top: 2px;">Booking History</p>
      </div>
      <form action="logout.php">
        <button style="margin-left: 4.8in;margin-top: 5px;">Logout</button>
      </form>
    </div>
    <div class="sectionpart w3-container">
      <form action="history.php">
        <table class="w3-table-all w3-centered">
            <tr>
            <th>Ticket number</th>
            <th>Name</th>
            <th>Train name</th>
            <th>Starting</th>
            <th>Ending</th>
            <th>Quota</th>
            <th>Class</th>
            <th>coach number</th>
            <th>berth number</th>
            <th>date</th>
            <br>
            <?php
            $id = $_SESSION['id'];
            $query = "SELECT * FROM tickets WHERE p_id='$id'";
            $result = mysqli_query($con,$query);

            while($row = mysqli_fetch_array($result))
            {
              ?>
              <tr>
                <td> <?php echo $row['ticket_number']; ?> </td>
                <td> <?php echo $row['name']; ?> </td>
                <td> <?php echo $row['train_name']; ?> </td>
                <td> <?php echo $row['starting']; ?> </td>
                <td> <?php echo $row['ending']; ?> </td>
                <td> <?php echo $row['quota']; ?> </td>
                <td> <?php echo $row['class']; ?> </td>
                <td> <?php echo $row['coach_number']; ?> </td>
                <td> <?php echo $row['berth_number']; ?> </td>
                <td> <?php echo $row['date']; ?> </td>
              </tr>
            <?php
            }
            ?>
          	</tr>
        </table>
      	</form>
        <form action="history.php" method="post">
          <label>cancel ticket:</label>
          <input type="submit" name="cancel" value="cancel" onclick="removedata()" style="margin-top:15px;">
        </form>
        <?php
          if(isset($_POST['cancel']))
          {
            $date = $_SESSION['date'];
            $query = "DELETE FROM tickets WHERE date='$date'";
            $result = mysqli_query($con,$query);
            if($result)
            {
              header('location:history.php');
            }
            else
            {
              echo '<script type="text/javascript">alert("errro:try again!")</script>';
            }
          }
        ?>
      </div>
    </div>
    <script type="text/javascript">
      function removedata()
      {
        alert("TICKETS CANCELLED!!!");
      }
    </script>
</body>
</html>
