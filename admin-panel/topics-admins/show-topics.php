<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php

if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

$topics = $conn->query("SELECT * FROM topics ");
$topics->execute();
$allTopics = $topics->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4 d-inline"><i class="fas fa-file-alt" style="margin-right: 8px;"></i>Topics</h5>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fas " style="margin-right: 5px;"></i>ID</th>
                            <th scope="col"><i class="fas  fa-pen" style="margin-right: 5px;"></i>Title</th>
                            <th scope="col"><i class="fas fa-folder" style="margin-right: 5px;"></i>Category</th>
                            <th scope="col"><i class="fas fa-user" style="margin-right: 5px;"></i>User</th>
                            <th scope="col"><i class="fas fa-edit" style="margin-right: 5px;"></i>Update</th>
                            <th scope="col"><i class="fas fa-trash" style="margin-right: 5px;"></i>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allTopics as $topic): ?>
                        <tr>
                            <th scope="row"><?php echo $topic->id; ?></th>
                            <td><?php echo $topic->title; ?></td>
                            <td><?php echo $topic->category; ?></td>
                            <td><?php echo $topic->user_name; ?></td>
                            <td>
                                <a href="update-topics.php?id=<?php echo $topic->id; ?>" class="btn btn-warning text-white text-center">
                                    <i class="fas fa-edit" style="margin-right: 5px;"></i>Update
                                </a>
                            </td>
                            <td>
                                <a href="delete-topics.php?id=<?php echo $topic->id; ?>" class="btn btn-danger text-center">
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