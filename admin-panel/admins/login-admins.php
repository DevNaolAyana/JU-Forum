<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php 

    if (isset($_SESSION["adminname"])) { // THIS TO CLOSE THE ablity to acces with writing directories
      header("location:".ADMINURL."");
    }


if (isset($_POST["submit"])) { //email and password validation
	if (empty($_POST["email"]) || empty($_POST["password"])) {
       echo "<script>alert('one or inputs are empty');</script>";
  }  else {
    // getting the data
    $email = $_POST["email"]; 
    $password = $_POST["password"];
 
    //writing query validate only email
    $login = $conn->query("SELECT * FROM admins WHERE email='$email'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);//FETCH IT AS AN ASSOCIATIVE ARRAY 
    //VALIDATE EMAIL
    if($login->rowCount()>0) {
      // if it is greater 0 means it is the right email (its returning an email)
            if(password_verify($password, $fetch["password"])) { //takes two parameters password is what the user enteredn and , the fetch one is from  the data base . 
                echo"<script>alert('LOGGED IN ')</script>";

                $_SESSION['adminname']=$fetch['adminname'];// Starting session in the header.php since it is in every php file 
                $_SESSION['email']=$fetch['email'];
               

                header("location: ".ADMINURL."");

                 echo "<script>alert('LOGGED IN');</script>";
            }else {
              echo"<script>alert('email or password wrong')</script>";
            }
    } else {
       echo"<script>alert('email or password wrong')</script>";
    }
  }
}

?>

      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mt-5"><i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Login</h5>
              <form method="POST" class="p-auto" action="login-admins.php">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1"><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email Address</label>
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Enter your email address" />
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example2"><i class="fas fa-lock" style="margin-right: 5px;"></i>Password</label>
                    <input type="password" name="password" id="form2Example2" placeholder="Enter your password" class="form-control" />
                  </div>

                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">
                    <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Login
                  </button>
                </form>
            </div>
            </div>
        </div>
 </div>
 <?php require "../layouts/footer.php" ?>