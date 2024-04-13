<?php 
require ('configs/dbinit.php');
$sql = "delete FROM shoes where shoe_id='".$_GET['id']."'";

echo $sql;
if($conn->exec($sql)){
  header('Location: dashboard.php');
  exit();
}else{
  echo 'Error while deleting';
}
?>