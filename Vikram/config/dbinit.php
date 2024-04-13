<?php
//server credentials 
$servername = "localhost";
$username = "root";
$password = "";

try {
    // connect to database
    $conn = new PDO("mysql:host=$servername;dbname=db_vikram", $username, $password);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>