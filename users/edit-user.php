<?php require "../includes/header.php";
require "../config/config.php";
 ?>
 <?php
if (!isset($_SESSION["username"])) {
      header("location: ".APPURL.""); //if the session is not set take the user to the homepage
    } 

//GRABBING TOPIC 
if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $select = $conn->query("SELECT * FROM users WHERE id='$id'");
    $select->execute();

    $user = $select->fetch(PDO::FETCH_OBJ);//one row at atime
    
      if ($user->id !== $_SESSION["user_id"]) {//changign info only for the session t self 
       header("location: ".APPURL."");
       }
    
}

if (isset($_POST["submit"])) {  //when u press on ["submit"] 
    if (empty($_POST["email"]) OR empty($_POST["about"])){
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST["email"];
        $about = $_POST["about"];
        
        // Handle profile picture update
        $avatar = $user->avatar; // Keep current avatar by default
        
        if(isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
            $new_avatar = $_FILES["avatar"]["name"];
            $target_dir = "../img/";
            $target_file = $target_dir . basename($new_avatar);
            
            // Basic validation
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $avatar = $new_avatar; // Use new avatar
                }
            }
        }
        
        // Update database
        $update = $conn->prepare("UPDATE users SET email = :email, about = :about, avatar = :avatar WHERE id ='$id'");
        $update->execute([
            ":email" => $email,
            ":about"=> $about,
            ":avatar" => $avatar,
        ]);
        
        // UPDATE SESSION VARIABLE WITH NEW AVATAR
        $_SESSION['user_image'] = $avatar;
        
        // Force fresh load with JavaScript
        echo "<script>window.location.href='".APPURL."';</script>";
        exit();
    } 
}
?>
<div class="container" style="margin-top: 60px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left"><i class="fas fa-edit" style="margin-right: 10px;"></i>Edit Profile</h1>
					<div class="clearfix"></div>
					<hr>
					<form role="form" method="POST" action="edit-user.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
						<div class="form-group">
							<label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email</label>
							<input type="text" value="<?php echo $user->email; ?>" class="form-control" name="email" placeholder="Enter Email">
						</div>
						<div class="form-group">
							<label><i class="fas fa-info-circle" style="margin-right: 8px;"></i>About</label>
							<textarea id="body" rows="10" cols="80" class="form-control" name="about"><?php echo $user->about; ?></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
                        <div class="form-group">
                            <label><i class="fas fa-camera" style="margin-right: 8px;"></i>Profile Picture (Optional - JPG/PNG)</label>
                            <input type="file" class="form-control" name="avatar" accept=".jpg,.jpeg,.png">
                            <small class="text-muted">Current: <?php echo $user->avatar; ?> - Leave empty to keep current picture</small>
                        </div>
						<button type="submit" name="submit" class="color btn btn-default"><i class="fas fa-save" style="margin-right: 8px;"></i>Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.container -->

<?php require "../includes/auth-footer.php"; ?>