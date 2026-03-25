<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php

if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

if(isset($_GET["id"])) {
    $id = $_GET["id"];
}

$topic = $conn->query("SELECT * FROM topics WHERE id='$id' ");
$topic->execute();
$singleTopic = $topic->fetch(PDO::FETCH_OBJ);

// Fetch all categories for dropdown
$categories = $conn->query("SELECT * FROM categories");
$categories->execute();
$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["submit"])) {
    if (!empty($_POST["title"]) && !empty($_POST["category"]) && !empty($_POST["body"])) {
        
        $title = $_POST["title"];
        $category = $_POST["category"];
        $body = $_POST["body"];

        $update = $conn->prepare("UPDATE topics SET title=:title, category=:category, body=:body WHERE id='$id' ");
        
        $update->execute([
            ":title" => $title,
            ":category" => $category,
            ":body" => $body,
        ]);
        
        header("location: show-topics.php");
        exit();
    } else {
        echo "<script>alert('one or more inputs are empty');</script>";
    }
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline"><i class="fas fa-edit" style="margin-right: 8px;"></i>Update Topic</h5>
                <form method="POST" action="update-topics.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                    
                    <!-- ID - Display only, not editable -->
                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label"><i class="fas " style="margin-right: 5px;"></i>Topic ID</label>
                        <input type="text" value="<?php echo $singleTopic->id; ?>" class="form-control" readonly />
                    </div>

                    <!-- Title - Editable -->
                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label"><i class="fas fa-pen" style="margin-right: 5px;"></i>Title</label>
                        <input type="text" value="<?php echo $singleTopic->title; ?>" name="title" class="form-control" placeholder="Enter topic title" />
                    </div>

                    <!-- Category - Dropdown from database -->
                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label"><i class="fas fa-folder" style="margin-right: 5px;"></i>Category</label>
                        <select name="category" class="form-control">
                            <?php foreach($allCategories as $cat): ?>
                                <option value="<?php echo $cat->name; ?>" <?php echo ($cat->name == $singleTopic->category) ? 'selected' : ''; ?>>
                                    <?php echo $cat->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Username - Display only, not editable -->
                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label"><i class="fas fa-user" style="margin-right: 5px;"></i>Username</label>
                        <input type="text" value="<?php echo $singleTopic->user_name; ?>" class="form-control" readonly />
                    </div>

                    <!-- Body - Editable -->
                    <div class="form-outline mb-4 mt-4">
                        <label class="form-label"><i class="fas fa-align-left" style="margin-right: 5px;"></i>Body</label>
                        <textarea name="body" class="form-control" placeholder="Enter topic content" rows="5"><?php echo $singleTopic->body; ?></textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">
                        <i class="fas fa-save" style="margin-right: 5px;"></i>Update Topic
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php" ?>