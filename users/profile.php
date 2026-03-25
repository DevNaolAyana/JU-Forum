<?php require "../includes/header.php"; ?>
<?php require "../config/config.php";?>
<?php
// if (!isset($_SESSION["username"])) {
//       header("location: ".APPURL.""); //if the session is not set take the user to the homepage
//     } 

if (isset($_GET["name"])) {

    $name = $_GET["name"];
    $select = $conn->query("SELECT * FROM users WHERE username='$name'");
    $select->execute();

    $user = $select->fetch(PDO::FETCH_OBJ);//one row at atime
    

    //number of topics
    $num_topics = $conn->query("SELECT COUNT(*) AS num_topics FROM topics WHERE user_name='$name'"); 
    $num_topics->execute();

    $all_num_topics = $num_topics->fetch(PDO::FETCH_OBJ);


    //number of replies
    $num_replies = $conn->query("SELECT COUNT(*) AS num_replies FROM replies WHERE user_name='$name'"); 
    $num_replies->execute();

    $all_num_replies = $num_replies->fetch(PDO::FETCH_OBJ);
}
?>

<div class="container" style="margin-top: 60px;">
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2"> 
            <div class="main-col">
                <div class="block">
                    <h1 class="pull-left"><i class="fas fa-user" style="margin-right: 10px;"></i><?php echo $user->name; ?></h1>
                    <div class="clearfix"></div>
                    <hr>
                    <ul id="topics">
                        <li id="main-topic" class="topic topic">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="user-info">
                                        <img class="avatar pull-left" src="../img/<?php echo $user->avatar; ?>" />
                                        <ul>
                                            <li><strong><i class="fas fa-user-circle" style="margin-right: 8px;"></i><?php echo $user->username; ?></strong></li>
                                            <li><a href="profile.php?name=<?php echo $user->username; ?>"><i class="fas fa-id-card" style="margin-right: 8px;"></i>Profile</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="topic-content pull-right">
                                        <p><i class="fas fa-info-circle" style="margin-right: 8px;"></i><?php echo $user->about; ?></p>
                                    </div>
                                    <div style="margin-top: 20px;">
                                        <a class="btn btn-success" href="" role="button"><i class="fas fa-file-alt" style="margin-right: 8px;"></i>Topics: <?php echo $all_num_topics->num_topics ?></a>
                                        <a class="btn btn-primary" href="" role="button"><i class="fas fa-reply" style="margin-right: 8px;"></i>Replies: <?php echo $all_num_replies->num_replies ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../includes/auth-footer.php"; ?>