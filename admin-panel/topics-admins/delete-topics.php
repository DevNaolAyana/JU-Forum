<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
      header("location: ".ADMINURL."/admins/login-admins.php"); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 


if(isset($_GET["id"])){
    $id = $_GET["id"];
    $delete = $conn->query("DELETE FROM topics WHERE id='$id'");
    $delete->execute();

    header("location: show-topics.php");

}


?>
