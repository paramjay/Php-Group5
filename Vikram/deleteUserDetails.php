<?php
require ('config/dbinit.php');
require ('classes/dao/userDao.php');
$db = new Database();
$conn = $db->getConnection();
$userManager = new UserDAO($db);

if ($userManager->deleteUserDetailsById($_GET['id'])) {
  header('Location: userDashboard.php');
  exit();
} else {
  echo 'Error while deleting';
}
?>