<?php require "../includes/header.php"; ?>
<?php require "../config/config.php";?>
<?php 
    if (isset($_SESSION["username"])) {
      header("location:".APPURL."");
    }

// Check if redirected from successful registration
if (isset($_GET['registered']) && $_GET['registered'] == 'success') {
    $showSuccess = true;
}

if (isset($_POST["submit"])) { //email and password validation
	if (empty($_POST["email"]) || empty($_POST["password"])) {
       echo "<script>alert('one or inputs are empty');</script>";
  }  else {
    // getting the data
    $email = $_POST["email"];
    $password = $_POST["password"];
 
    //writing query validate only email
    $login = $conn->query("SELECT * FROM users WHERE email='$email'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);//FETCH IT AS AN ASSOCIATIVE ARRAY 
    //VALIDATE EMAIL
    if($login->rowCount()>0) {
      // if it is greater 0 means it is the right email
            if(password_verify($password, $fetch["password"])) { //takes two parameters password is what the user enteredn and , the fetch one is from  the data base . 
                // echo"<script>alert('LOGGED IN ')</script>";
                $_SESSION['username']=$fetch['username'];// Starting session in the header.php since it is in every php file 
                $_SESSION['name']=$fetch['name'];//later used in creating topics 
                $_SESSION['user_id']=$fetch['id'];
                $_SESSION['email']=$fetch['email'];
                $_SESSION['user_image']=$fetch['avatar'];

                header("location: ".APPURL."");

            }else {
              echo"<script>alert('email or password wrong')</script>";
            }
    } else {
       echo"<script>alert('email or password wrong')</script>";
    }
  }
}

?>
   

<div class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php if (isset($showSuccess) && $showSuccess): ?>
                <!-- boottrap nootification for succeful registration -->
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="fas fa-check-circle" style="margin-right: 5px;"></i>
                Successfully registered! Please login to continue.
            </div>
            <?php endif; ?>
            
            <div class="main-col">
                <div class="block">
                    <h1 class="text-center"><i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i>Login</h1>
                    <hr>
                    <form role="form" method="post" action="login.php">
                        <div class="form-group">
                            <label><i class="fas fa-envelope" style="margin-right: 8px;"></i>Email Address</label> 
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address">
                        </div>

                        <div class="form-group">
                            <label><i class="fas fa-lock" style="margin-right: 8px;"></i>Password</label> 
                            <input type="password" class="form-control" name="password" placeholder="Enter A Password">
                        </div>

                        <button name="submit" type="submit" class="color btn btn-default btn-block">
                            <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i>Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/auth-footer.php"; ?>