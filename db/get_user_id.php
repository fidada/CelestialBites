<?php
require_once 'db.php';
require_once 'user.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $user = new User();
    $user->username = $username;
    $result = $user->getUserByUsername();
    
    if ($result) {
        $data = $result->fetch_assoc();
        echo json_encode(['user_id' => $data['user_id']]);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}
?>
