<?php 
require ('config/dbinit.php');

$db = new Database();
$conn = $db->getConnection();

$sql = "delete FROM tbl_cars where car_id='".$_GET['id']."'";

echo $sql;
if($conn->exec($sql)){
  header('Location: dashboard.php');
  exit();
}else{
  echo 'Error while deleting';
}
?>