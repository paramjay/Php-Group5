<?php 
require ('config/dbinit.php');

$db = new Database();
$conn = $db->getConnection();

$sql = "delete FROM tbl_users where user_id='".$_GET['id']."'";

echo $sql;
if($conn->exec($sql)){
  header('Location: userDashboard.php');
  exit();
}else{
  echo 'Error while deleting';
}
?>