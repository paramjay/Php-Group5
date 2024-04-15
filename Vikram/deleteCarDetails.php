<?php
require ('config/dbinit.php');
require ('classes/dao/carDao.php');
$db = new Database();
$conn = $db->getConnection();
$carManager = new CarDAO($db);

if ($carManager->deleteCarDetailsById($_GET['id'])) {
  header('Location: dashboard.php');
  exit();
} else {
  echo 'Error while deleting';
}
?>