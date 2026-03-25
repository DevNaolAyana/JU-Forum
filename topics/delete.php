<?php require "../includes/header.php";
require "../config/config.php";?>

<?php

if (isset($_GET["id"])) 
    {
        $id = $_GET["id"];
        
         
         $select = $conn->query("SELECT * FROM topics WHERE id='$id'");
         $select->execute();

        $topic = $select->fetch(PDO::FETCH_OBJ);

        if ($topic->user_name !== $_SESSION["username"]) {
       header("location: ".APPURL."");
       }else{
        // First delete all replies for this topic
        $deleteReplies = $conn->prepare("DELETE FROM replies WHERE topic_id = :topic_id");
        $deleteReplies->execute([':topic_id' => $id]);
        
        // Then delete the topic
        $delete = $conn->prepare("DELETE FROM topics WHERE id = :id");
        $delete->execute([':id' => $id]);
        
        header("location: ".APPURL."");//concating and leads to index page after deleting
       }
    

     
    }

?>