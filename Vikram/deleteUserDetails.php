<?php 
require ('config/dbinit.php');
require('user.php');
$db = new Database();
$conn = $db->getConnection();
$userManager = new User($db);

if($userManager->deleteUserDetailsById($_GET['id'])){
  header('Location: userDashboard.php');
  exit();
}else{
  echo 'Error while deleting';
}
?>