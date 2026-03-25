<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php

if (!isset($_SESSION["adminname"])) {
      header("location: ".ADMINURL."/admins/login-admins.php"); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 



if (isset($_POST["submit"])) {  // Changed from $_GET["submit"]
	if (!empty($_POST["email"]) && !empty($_POST["adminname"]) 
    && !empty($_POST["password"])	) {
		$email = $_POST["email"];
		$adminname = $_POST["adminname"];
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);  // hashing passwords not to display the password to the admins 
	
		$insert = $conn->prepare("INSERT INTO admins (email, adminname, password) 
	   VALUES(:email, :adminname, :password)");//preparing handlers
		$insert->execute([ //grabing handlers
			":email" => $email,
			":adminname" => $adminname,
			":password" => $password,
			
		]);
		header("location: admins.php");
		exit();
	} else {
		echo "<script>alert('one or inputs are empty');</script>";
	}
}
?>


       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline"><i class="fas fa-user-plus" style="margin-right: 8px;"></i>Create Admins</h5>
          <form method="POST" action="create-admins.php" >
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <label class="form-label" for="form2Example1"><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email Address</label>
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Enter email address" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example1"><i class="fas fa-user" style="margin-right: 5px;"></i>Admin Name</label>
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="Enter admin name" />
                </div>
                
                <div class="form-outline mb-4">
                  <label class="form-label" for="form2Example1"><i class="fas fa-lock" style="margin-right: 5px;"></i>Password</label>
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="Enter password" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">
                  <i class="fas fa-user-plus" style="margin-right: 5px;"></i>Create Admin
                </button>

              </form>

            </div>
          </div>
        </div>
      </div>
  
<?php require "../layouts/footer.php" ?>