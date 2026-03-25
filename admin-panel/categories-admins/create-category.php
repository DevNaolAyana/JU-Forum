<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php

if (!isset($_SESSION["adminname"])) {
      header("location: ".ADMINURL."/admins/login-admins.php"); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 



if (isset($_POST["submit"])) {  // Changed from $_GET["submit"]
	if (!empty($_POST["name"])	) {
		
    $name = $_POST["name"];
		$insert = $conn->prepare("INSERT INTO categories  (name) 
	   VALUES(:name)");//preparing handlers
		$insert->execute([ //grabing handlers
			":name" => $name,
			
		]);
		header("location: show-categories.php");
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
              <h5 class="card-title mb-5 d-inline"><i class="fas fa-folder-plus" style="margin-right: 8px;"></i>Create Categories</h5>
          <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Category Name input -->
                <div class="form-outline mb-4 mt-4">
                  <label class="form-label" for="form2Example1"><i class="fas fa-tag" style="margin-right: 5px;"></i>Category Name</label>
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Enter category name" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">
                  <i class="fas fa-plus" style="margin-right: 5px;"></i>Create Category
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php" ?>