<?php
session_start();
define("APPURL", "http://localhost/forum");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome To JU Forum</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo APPURL; ?>/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo APPURL; ?>/css/custom.css" rel="stylesheet">
</head>

<body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="<?php echo APPURL; ?>/img/main-logo.png" style="height: 45px; margin-top: 10px; margin-right: 10px; float: left;"> 
                <a class="navbar-brand" href="<?php echo APPURL; ?>">
                 <!-- <img src="<?php echo APPURL; ?>/img/main-logo.png" style="height: 30px; display: inline-block; margin-right: 10px; vertical-align: middle;">  -->
                    
                </a>

            </div>
            <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="<?php echo APPURL; ?>"><i class="fas fa-home" style="margin-right: 5px;"></i>Home</a></li>
                    <?php if(isset($_SESSION['username'])) : ?>
                   
                   
                    <li><a href="<?php echo APPURL; ?>/topics/create.php" style="margin-left: 15px;"><i class="fas fa-plus-circle" style="margin-right: 5px;"></i>Create Topic</a></li>
                    <li class="dropdown" style="margin-left: 15px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo APPURL; ?>/img/<?php echo $_SESSION['user_image']; ?>" style="width:35px;height:35px;border-radius:50%;margin-right:5px;">
                        <?php echo $_SESSION['username'];  ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $_SESSION['username']; ?>"><i class="fas fa-id-card" style="margin-right: 5px;"></i>Public Profile </a></li>
                        <li><a href="<?php echo APPURL; ?>/users/edit-user.php?id=<?php echo $_SESSION['user_id']; ?>"><i class="fas fa-edit" style="margin-right: 5px;"></i>Edit Profile</a></li>
                        
                        <li><a href="<?php echo APPURL; ?>/auth/logout.php"><i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Logout</a></li>
                    </ul>
                    </li>
                    <?php else: ?>
                     <li><a href="<?php echo APPURL; ?>/auth/register.php" style="margin-left: 15px;"><i class="fas fa-user-plus" style="margin-right: 5px;"></i>Register</a></li>
                     <li><a href="<?php echo APPURL; ?>/auth/login.php" style="margin-left: 15px;"><i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Login</a></li>
                     <?php endif; ?>
                    </ul>
            </div>
        </div>
    </div>

    <!--   **** This from Bootstrap 3 FYI(https://getbootstrap.com/docs/3.3/components/#navbar) ****
                        
                         <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li> -->