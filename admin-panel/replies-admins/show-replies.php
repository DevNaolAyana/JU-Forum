<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

$replies = $conn->query("SELECT * FROM replies ");
$replies->execute();
$allReplies = $replies->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline"><i class="fas fa-reply" style="margin-right: 8px;"></i>Replies</h5>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col" style="vertical-align: middle; white-space: nowrap; min-width: 80px;">
                                <i class="fas " style="margin-right: 5px;"></i>ID
                            </th>
                            <th scope="col" style="vertical-align: middle;">
                                <i class="fas fa-comment" style="margin-right: 5px;"></i>Reply
                            </th>
                            <th scope="col" style="vertical-align: middle; white-space: nowrap; min-width: 120px;">
                                <i class="fas fa-user" style="margin-right: 5px;"></i>Username
                            </th>
                            <th scope="col" style="vertical-align: middle; white-space: nowrap; min-width: 130px;">
                                <i class="fas fa-external-link-alt" style="margin-right: 5px;"></i>Go to Topic
                            </th>
                            <th scope="col" style="vertical-align: middle; white-space: nowrap; min-width: 100px;">
                                <i class="fas fa-trash" style="margin-right: 5px;"></i>Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allReplies as $reply) : ?>
                        <tr>
                            <th scope="row"><?php echo $reply->id;?></th>
                            <td><?php echo $reply->reply;?></td>
                            <td><?php echo $reply->user_name;?></td>
                            <td>
                                <a href="http://localhost/forum/topics/topic.php?id=<?php echo $reply->topic_id; ?>" class="btn btn-success text-center">
                                    <i class="fas fa-external-link-alt" style="margin-right: 5px;"></i>Go to Topic
                                </a>
                            </td>
                            <td>
                                <a href="delete-replies.php?id=<?php echo $reply->id;?>" class="btn btn-danger text-center">
                                    <i class="fas fa-trash" style="margin-right: 5px;"></i>Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php" ?>