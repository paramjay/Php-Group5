<?php 
require ('config/dbinit.php');
require('car.php');
$db = new Database();
$conn = $db->getConnection();
$carManager = new Car($db);

if($carManager->deleteCarDetailsById($_GET['id'])){
  header('Location: dashboard.php');
  exit();
}else{
  echo 'Error while deleting';
}
?>