<?php
$conn = mysqli_connect('localhost', 'root', '', 'database1');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
