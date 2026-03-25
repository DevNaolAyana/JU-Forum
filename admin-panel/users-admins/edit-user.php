<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $select = $conn->query("SELECT * FROM users WHERE id='$id'");
    $select->execute();
    $user = $select->fetch(PDO::FETCH_OBJ);
} else {
    header("location: show-users.php");
}

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $about = $_POST["about"];
    
    // Check if password is being changed
    if (!empty($_POST["password"])) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $update_pass = ", password = :password";
    } else {
        $update_pass = "";
    }
    
    // Handle avatar update
    $avatar = $user->avatar;
    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0 && !empty($_FILES["avatar"]["name"])) {
        $new_avatar = $_FILES["avatar"]["name"];
        $target_dir = "../../img/";
        $target_file = $target_dir . basename($new_avatar);
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
        $avatar = $new_avatar;
    }
    
    // Update query - REMOVED username update
    if (!empty($_POST["password"])) {
        $update = $conn->prepare("UPDATE users SET name = :name, email = :email, 
                                 about = :about, avatar = :avatar, password = :password WHERE id ='$id'");
        $update->execute([
            ":name" => $name,
            ":email" => $email,
            ":about" => $about,
            ":avatar" => $avatar,
            ":password" => $password
        ]);
    } else {
        $update = $conn->prepare("UPDATE users SET name = :name, email = :email, 
                                 about = :about, avatar = :avatar WHERE id ='$id'");
        $update->execute([
            ":name" => $name,
            ":email" => $email,
            ":about" => $about,
            ":avatar" => $avatar
        ]);
    }
    
    header("location: show-users.php");
    exit();
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4"><i class="fas fa-edit" style="margin-right: 8px;"></i>Edit User</h5>
                <form role="form" method="post" action="edit-user.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><i class="fas fa-user" style="margin-right: 8px;"></i>Name</label>
                        <input type="text" value="<?php echo $user->name; ?>" class="form-control" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email</label>
                        <input type="email" value="<?php echo $user->email; ?>" class="form-control" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-user-circle" style="margin-right: 8px;"></i>Username</label>
                        <input type="text" value="<?php echo $user->username; ?>" class="form-control" readonly style="background-color: #f8f9fa;">
                        <small class="text-muted">Username cannot be changed</small>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock" style="margin-right: 8px;"></i>New Password (Leave empty to keep current)</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password">
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-info-circle" style="margin-right: 8px;"></i>About</label>
                        <textarea class="form-control" name="about" rows="3"><?php echo $user->about; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-camera" style="margin-right: 8px;"></i>Profile Picture</label>
                        <input type="file" class="form-control" name="avatar" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">Current: <?php echo $user->avatar; ?> - Leave empty to keep current</small>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-warning text-white">
                        <i class="fas fa-save" style="margin-right: 5px;"></i>Update User
                    </button>
                    <a href="show-users.php" class="btn btn-secondary">
                        <i class="fas fa-times" style="margin-right: 5px;"></i>Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../layouts/footer.php" ?>