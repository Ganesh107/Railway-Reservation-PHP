<?php
$con = mysqli_connect('localhost:3306','root','','railway_reservation');
if(!$con)
{
    echo "not connected:".mysqli_connect_error();
}
?>
