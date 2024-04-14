<?php

function check_login($pdo)
{
    session_start();

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];

        $sql = "SELECT * FROM tbl_users WHERE user_id = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        // Check if there's a result
        if ($stmt && $stmt->rowCount() > 0) {
            // Fetch the user data
            $user_data = $stmt->fetch();
            return $user_data;
        }
    }

    header("Location: login.php");
    die;
}

?>
