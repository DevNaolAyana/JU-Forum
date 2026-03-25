<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // First, get the username to delete related topics/replies
    $get_user = $conn->query("SELECT username FROM users WHERE id='$id'");
    $get_user->execute();
    $user_data = $get_user->fetch(PDO::FETCH_OBJ);
    $username = $user_data->username;
    
    // Delete user's replies (uses user_id in replies table)
    $delete_replies = $conn->prepare("DELETE FROM replies WHERE user_id = :id");
    $delete_replies->execute([":id" => $id]);
    
    // Delete user's topics (uses user_name in topics table)
    $delete_topics = $conn->prepare("DELETE FROM topics WHERE user_name = :username");
    $delete_topics->execute([":username" => $username]);
    
    // Finally delete the user
    $delete = $conn->prepare("DELETE FROM users WHERE id = :id");
    $delete->execute([":id" => $id]);
    
    header("location: ".ADMINURL."/users-admins/show-users.php");
    exit();
} else {
    header("location: ".ADMINURL."/users-admins/show-users.php");
}
?>