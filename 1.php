<?php
$dbh = mysqli_init();
$conn = mysqli_real_connect($dbh, 'localhost:3306', 'root', '123456');
#$conn = mysqli_connect( 'localhost:3306', 'root', '123456');
var_dump($conn);
?>
