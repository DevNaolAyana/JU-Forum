<?php
session_start();
define("ADMINURL","http://localhost/forum/admin-panel");
?>
<?php 
// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JU Forum Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ADMINURL; ?>/styles/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark" style="background: #0056b3;">
      <div class="container">
<a class="navbar-brand" href="<?php echo ADMINURL; ?>" style="position: absolute; left: 15px;">
    <img src="<?php echo ADMINURL; ?>/../img/main-logo.png" style="height: 35px; margin-right: 10px; vertical-align: middle;">
    JU Forum Admin
</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <?php if(isset($_SESSION['adminname'])) : ?>
        <ul class="navbar-nav side-nav">
          <li class="nav-item">
              <a class="nav-link  <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" style="margin-left: 20px;" href="<?php echo ADMINURL; ?>">
                  <i class="fas fa-home" style="margin-right: 8px;"></i>Home
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'admins.php') ? 'active' : ''; ?>" href="<?php echo ADMINURL; ?>/admins/admins.php" style="margin-left: 20px;">
                  <i class="fas fa-user-shield" style="margin-right: 8px;"></i>Admins
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'show-users.php') ? 'active' : ''; ?>" href="<?php echo ADMINURL; ?>/users-admins/show-users.php" style="margin-left: 20px;">
                  <i class="fas fa-users" style="margin-right: 8px;"></i>Users
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'show-categories.php') ? 'active' : ''; ?>" href="<?php echo ADMINURL; ?>/categories-admins/show-categories.php" style="margin-left: 20px;">
                  <i class="fas fa-folder" style="margin-right: 8px;"></i>Categories
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'show-topics.php') ? 'active' : ''; ?>" href="<?php echo ADMINURL; ?>/topics-admins/show-topics.php" style="margin-left: 20px;">
                  <i class="fas fa-file-alt" style="margin-right: 8px;"></i>Topics
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link <?php echo ($current_page == 'show-replies.php') ? 'active' : ''; ?>" href="<?php echo ADMINURL; ?>/replies-admins/show-replies.php" style="margin-left: 20px;">
                  <i class="fas fa-reply" style="margin-right: 8px;"></i>Replies
              </a>
          </li>
      </ul>
        <?php endif; ?>
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <?php if(!isset($_SESSION['adminname'])): ?>  
        <li class="nav-item">
            <a class="nav-link" href="<?php echo ADMINURL; ?>/admins/login-admins.php">
              <i class="fas fa-sign-in-alt" style="margin-right: 5px;"></i>Login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php else: ?> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-cog" style="margin-right: 5px;"></i><?php echo $_SESSION['adminname']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo ADMINURL; ?>/admins/logout.php">
                <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i>Logout
              </a>
            </div>
          </li>
          <?php endif; ?>                
        </ul>
      </div>
    </div>
    </nav>
    <div class="container-fluid">