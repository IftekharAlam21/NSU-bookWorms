<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "useraccounts";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
  echo "DB problem";
  die("Connection failed: ".mysqli_connect_error());
}
