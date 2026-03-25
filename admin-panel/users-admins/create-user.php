<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

if (isset($_POST["submit"])) {
    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["username"]) 
        && !empty($_POST["password"]) && !empty($_POST["about"])) {
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $about = $_POST["about"];
        
        // Check about text length (max 200 characters)
        if (strlen($about) > 200) {
            echo "<script>alert('About must be maximum 200 characters');</script>";
        } else {
            // Handle avatar
            $avatar = "gravatar.jpg"; // Default avatar
            if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0 && !empty($_FILES["avatar"]["name"])) {
                $avatar = $_FILES["avatar"]["name"];
                $target_dir = "../../img/";
                $target_file = $target_dir . basename($avatar);
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            }
            
            // Check if username/email exists
            $check = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
            $check->execute();
            
            if ($check->rowCount() > 0) {
                echo "<script>alert('Username or email already exists');</script>";
            } else {
                $insert = $conn->prepare("INSERT INTO users (name, email, username, password, about, avatar) 
                                         VALUES(:name, :email, :username, :password, :about, :avatar)");
                $insert->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":username" => $username,
                    ":password" => $password,
                    ":about" => $about,
                    ":avatar" => $avatar,
                ]);
                
                header("location: ".ADMINURL."/users-admins/show-users.php");
                exit();
            }
        }
    } else {
        echo "<script>alert('Please fill all required fields');</script>";
    }
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4"><i class="fas fa-user-plus" style="margin-right: 8px;"></i>Create New User</h5>
                <form role="form" method="post" action="create-user.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label><i class="fas fa-user" style="margin-right: 8px;"></i>Name *</label> 
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email *</label> 
                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-user-circle" style="margin-right: 8px;"></i>Username *</label> 
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock" style="margin-right: 8px;"></i>Password *</label> 
                        <input type="password" class="form-control" name="password" placeholder="Enter Password (min 6 chars)" minlength="6" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-info-circle" style="margin-right: 8px;"></i>About (max 200 characters)</label> 
                        <textarea class="form-control" name="about" id="about" placeholder="About the user (maximum 200 characters)" rows="3" maxlength="200"></textarea>
                        <small id="charCount" class="form-text text-muted">Characters: <span id="count">0</span>/200</small>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-camera" style="margin-right: 8px;"></i>Profile Picture</label> 
                        <input type="file" class="form-control" name="avatar" accept=".jpg,.jpeg,.png">
                        <small class="text-muted">Optional - Leave empty for default avatar</small>
                    </div>
                    
                    <button name="submit" type="submit" class="btn btn-primary">
                        <i class="fas fa-save" style="margin-right: 5px;"></i>Create User
                    </button>
                    <a href="show-users.php" class="btn btn-secondary">
                        <i class="fas fa-times" style="margin-right: 5px;"></i>Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Simple form validation
function validateForm() {
    var about = document.getElementById("about").value;
    
    // Check about text character count
    var charCount = about.length;
    if (charCount > 200) {
        alert("About must be maximum 200 characters. You have " + charCount + " characters.");
        return false;
    }
    
    return true;
}

// Live character count display
document.getElementById('about').addEventListener('input', function() {
    var length = this.value.length;
    document.getElementById('count').textContent = length;
    
    // Change color if over limit
    if (length > 200) {
        document.getElementById('charCount').style.color = 'red';
    } else {
        document.getElementById('charCount').style.color = 'green';
    }
});
</script>

<?php require "../layouts/footer.php" ?>