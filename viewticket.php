<?php
  session_start();
  include("dbconnect.php");
  if(!$_SESSION['username'])
  {
    header('location:login.php');
  }
  $date = $_SESSION['date'];
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
        <p style="font-size: 22px;margin-top: 2px;">Book tickets</p>
      </div>
      <form action="logout.php">
        <button style="margin-left: 5in;margin-top: 10px;">Logout</button>
      </form>
    </div>
    <div class="sectionpart w3-container">
      <form action="viewticket.php">
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
            $query = "SELECT * FROM tickets WHERE date='$date'";
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

          <?php
            $query = "SELECT * FROM tickets WHERE date='$date'";
            $res = mysqli_query($con,$query);
            $count = mysqli_num_rows($res);
            $row = mysqli_fetch_array($res);
            $class = $row[6];

            if($class == 'SL')
            {
              $price = 100*$count;
              echo "<BR>";
              echo "Ticket price = 100";
              echo "<BR>";
              echo "Total Price: ".$price;
            }
            elseif($class == '1A')
            {
              $price = 150*$count;
              echo "Ticket price = 150";
              echo "<BR>";
              echo "Total Price: ".$price;
            }
            elseif($class == '2A')
            {
              $price = 200*$count;
              echo "Ticket price = 200";
              echo "<BR>";
              echo "Total Price: ".$price;
            }
            elseif($class == '3A')
            {
              $price = 250*$count;
              echo "Ticket price = 250";
              echo "<BR>";
              echo "Total Price: ".$price;
            }
          ?>
          
          <br>
          <input type="submit" name="pay" value="Pay" onclick="display()" style="margin-top: 5px;">
          <script type="text/javascript">
            function display()
            {
              alert('Payment successfull!');
            }
          </script>
      </form>
      <a href="history.php" style="color: blue;text-decoration: none;">view booking history</a>
    </div>
  </div>
</body>
</html>