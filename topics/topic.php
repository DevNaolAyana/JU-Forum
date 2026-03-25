<?php require "../includes/header.php";
require "../config/config.php"; ?>
<?php 

if(isset($_GET["id"])){
    $id = $_GET["id"];

    $topic = $conn->query("SELECT * FROM topics WHERE id='$id'");
    $topic->execute();  

    $singleTopic = $topic->fetch(PDO::FETCH_OBJ);

    $topicCount = $conn->query("SELECT COUNT(*) AS count_topics FROM topics WHERE user_name='$singleTopic->user_name'");
    $topicCount->execute();

    $count = $topicCount->fetch(PDO::FETCH_OBJ);

    $reply = $conn->query("SELECT * FROM replies WHERE topic_id='$id'");
    $reply->execute();

    $allReplies = $reply->fetchALL(PDO::FETCH_OBJ);
} else {
    header("location:".APPURL."/404.php");
}

if (isset($_POST["submit"])) {
    if (!isset($_SESSION["username"])) {
        echo "<script>alert('You must be logged in to reply');</script>";
    } else if (empty($_POST["reply"])) {
        echo "<script>alert('reply is empty');</script>";
    } else {
        $reply = $_POST["reply"];
        $user_id = $_SESSION["user_id"];
        $user_image = $_SESSION["user_image"];
        $topic_id = $id;
        $user_name = $_SESSION["username"];

        $insert = $conn->prepare("INSERT INTO replies (reply, user_id, user_image, topic_id, user_name) 
                    VALUES(:reply, :user_id, :user_image, :topic_id, :user_name)");
        $insert->execute([
            ":reply" => $reply,
            ":user_id" => $user_id,
            ":user_image" => $user_image,
            ":topic_id" => $topic_id,
            ":user_name" => $user_name,
        ]);
        header("location: ".APPURL."/topics/topic.php?id=".$id."");
        exit();
    }
}
?>

<div class="container" style="margin-top: 60px;">
    <div class="row">
        <div class="col-md-8">
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><i class="fas fa-file-alt" style="margin-right: 10px;"></i><?php echo $singleTopic->title; ?> </h1>
                    <!-- <h4 class="pull-right"><i class="fas fa-comments" style="margin-right: 5px;"></i>A Simple Forum</h4> -->
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="../img/<?php echo $singleTopic->user_image; ?>" />
                                        <ul>
                                            <li><strong><i class="fas fa-user" style="margin-right: 5px;"></i><?php echo $singleTopic->user_name; ?></strong></li>
                                            <li><i class="fas fa-file" style="margin-right: 5px;"></i><?php echo $count->count_topics?> Posts</li>
                                            <li><a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $singleTopic->user_name; ?>"><i class="fas fa-id-card" style="margin-right: 5px;"></i>Profile</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="topic-content pull-right">
                                        <p><?php echo $singleTopic->body; ?></p>
                                    </div>
                                    <?php if(isset($_SESSION["username"])):?>
                                        <?php if($singleTopic->user_name == $_SESSION['username'] ): ?>
                                            <a class="btn btn-danger" href="delete.php?id=<?php echo $singleTopic->id; ?>" role="button"><i class="fas fa-trash" style="margin-right: 5px;"></i>Delete</a>
                                            <a class="btn btn-warning" href="update.php?id=<?php echo $singleTopic->id; ?>" role="button"><i class="fas fa-edit" style="margin-right: 5px;"></i>Update</a>
                                        <?php endif; ?>
                                    <?php endif; ?>      
                                </div>
                            </div>
                        </li>
                        <?php foreach($allReplies as $reply): ?>
                            <li class="topic topic">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="user-info">
                                            <img class="avatar pull-left" src="../img/<?php echo $reply->user_image; ?>" />
                                            <ul>
                                                <li><strong><i class="fas fa-user" style="margin-right: 5px;"></i><?php echo $reply->user_name; ?></strong></li>
                                                <li><a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $reply->user_name; ?>"><i class="fas fa-id-card" style="margin-right: 5px;"></i>Profile</a>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="topic-content pull-right">
                                            <p><?php echo $reply->reply; ?></p>
                                        </div>
                                        <?php if(isset($_SESSION["username"])):?>
                                            <?php if($reply->user_id == $_SESSION['user_id'] ): ?>
                                                <a class="btn btn-danger" href="../replies/delete.php?id=<?php echo $reply->id; ?>" role="button"><i class="fas fa-trash" style="margin-right: 5px;"></i>Delete</a>
                                                <a class="btn btn-warning" href="../replies/update.php?id=<?php echo $reply->id; ?>" role="button"><i class="fas fa-edit" style="margin-right: 5px;"></i>Update</a>
                                            <?php endif; ?>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>           
                    </ul>
                    
                    <!-- Only show reply form if logged in -->
                    <?php if(isset($_SESSION["username"])): ?>
                        <h3 style="font-size: 18px; color: #0056b3;"><i class="fas fa-reply" style="margin-right: 10px;"></i>Reply To Topic</h3>                        <form role="form" method="POST" action="topic.php?id=<?php echo $id; ?>">              
                            <div class="form-group">
                                <textarea id="reply" rows="10" cols="80" class="form-control" name="reply"></textarea>
                                <script>
                                    CKEDITOR.replace('reply');
                                </script>
                            </div>
                            <button type="submit" name="submit" class="color btn btn-default"><i class="fas fa-paper-plane" style="margin-right: 5px;"></i>Reply</button>
                        </form>
                    <?php else: ?>
                        <p class="alert alert-info"><i class="fas fa-info-circle" style="margin-right: 5px;"></i>Please <a href="<?php echo APPURL; ?>/auth/login.php" style="color: blue; text-decoration: underline;">login</a> to reply to this topic.</p>
                    <?php endif; ?>
					
                </div>
            </div>
        </div>
<?php require "../includes/footer.php"; ?>