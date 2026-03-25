<?php require "../includes/header.php";
require "../config/config.php";
 

if (isset($_SESSION["username"])) {
      header("location: ".APPURL.""); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 



if (isset($_POST["submit"])) {  // Changed from $_GET["submit"]
	if (
		!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["username"])
		&& !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["about"])
	) {
		// Check if passwords match
		if ($_POST["password"] !== $_POST["confirm_password"]) {
			echo "<script>alert('Passwords do not match');</script>";
		}
		// Check password length
		else if (strlen($_POST["password"]) < 6) {
			echo "<script>alert('Password must be at least 6 characters long');</script>";
		}
		// Check about text length (max 200 characters)
		else if (strlen($_POST["about"]) > 200) {
			echo "<script>alert('About yourself must be maximum 200 characters');</script>";
		}
		// Check if picture is uploaded
		else if (!isset($_FILES["avatar"]) || $_FILES["avatar"]["error"] != 0 || empty($_FILES["avatar"]["name"])) {
			echo "<script>alert('Please select a profile picture');</script>";
		} else {
			$name = $_POST["name"];// grabing with the super global post
			$email = $_POST["email"];
			$username = $_POST["username"];
			$password = password_hash($_POST["password"], PASSWORD_DEFAULT);  // hashing passwords not to display the password to the admins 
			$about = $_POST["about"];
			
			// Check if username already exists - DO THIS FIRST!
			$check_username = $conn->query("SELECT * FROM users WHERE username='$username'");
			$check_username->execute();

			if ($check_username->rowCount() > 0) {
				echo "<script>alert('Username already taken. Please choose another one.');</script>";
			} else {
				// Handle file upload - ONLY IF USERNAME IS AVAILABLE
				$avatar = $_FILES["avatar"]["name"];
				$target_dir = "img/"; 
				$target_file = $target_dir . basename($avatar);
				move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

				//users is the the table name
				$insert = $conn->prepare("INSERT INTO users (name, email, username, password, about, avatar) 
							  VALUES(:name, :email, :username, :password, :about, :avatar)");//preparing handlers
				$insert->execute([ //grabing handlers
					":name" => $name,
					":email" => $email,
					":username" => $username,
					":password" => $password,
					":about" => $about,
					":avatar" => $avatar,
				]);
				// header("location: login.php");
				header("location: login.php?registered=success");
				exit();
			}
		}
	} else {
		echo "<script>alert('one or more inputs are empty');</script>";
	}
}
?>



<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="main-col">
                <div class="block">
                    <h1 class="text-center"><i class="fas fa-user-plus" style="margin-right: 10px;"></i>Register</h1>
                    <hr>
                    <form role="form" method="post" action="register.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label><i class="fas fa-user" style="margin-right: 8px;"></i>Name</label> 
                            <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email Address</label> 
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-user-circle" style="margin-right: 8px;"></i>Username</label> 
                            <input type="text" class="form-control" name="username" placeholder="Enter A Username" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-lock" style="margin-right: 8px;"></i>Password </label> 
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter A Password (min 6 characters)" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-lock" style="margin-right: 8px;"></i>Confirm Password</label> 
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Your Password" required>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-info-circle" style="margin-right: 8px;"></i>About Yourself </label> 
                            <textarea class="form-control" name="about" id="about" placeholder="Tell us about yourself (maximum 200 characters)" required maxlength="200"></textarea>
                            <small id="charCount" class="form-text text-muted">Characters: <span id="count">0</span>/200</small>
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-camera" style="margin-right: 8px;"></i>Profile Picture (Required)</label> 
                            <input type="file" class="form-control" name="avatar" required>
                        </div>

                        <button name="submit" type="submit" class="color btn btn-default btn-block">
                            <i class="fas fa-user-plus" style="margin-right: 8px;"></i>Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple form validation
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var about = document.getElementById("about").value;
    
    // Check password length
    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
    }
    
    // Check password match
    if (password !== confirmPassword) {
        alert("Passwords do not match");
        return false;
    }
    
    // Check about text character count
    var charCount = about.length;
    if (charCount > 200) {
        alert("About yourself must be maximum 200 characters. You have " + charCount + " characters.");
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

<?php require "../includes/auth-footer.php"; ?>