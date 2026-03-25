<?php require "layouts/header.php" ?>
<?php require "../config/config.php" ?>
<?php    
if (!isset($_SESSION["adminname"])) { //cant get in without logging in 
      header("location:".ADMINURL."/admins/login-admins.php");
    }

    $topics = $conn->query("SELECT COUNT(*) AS count_topics FROM topics");
    $topics->execute();
    $allTopics = $topics->fetch(PDO::FETCH_OBJ);


    $categories = $conn->query("SELECT COUNT(*) AS count_categories FROM categories");
    $categories->execute();
    $allCategories = $categories->fetch(PDO::FETCH_OBJ);

     $admins = $conn->query("SELECT COUNT(*) AS count_admins FROM admins");
    $admins->execute();
    $allAdmins = $admins->fetch(PDO::FETCH_OBJ);


     $replies = $conn->query("SELECT COUNT(*) AS count_replies FROM replies");
    $replies->execute();
    $allReplies = $replies->fetch(PDO::FETCH_OBJ);

    // Add users count
    $users = $conn->query("SELECT COUNT(*) AS count_users FROM users");
    $users->execute();
    $allUsers = $users->fetch(PDO::FETCH_OBJ);

    ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-file-alt" style="margin-right: 8px;"></i>Topics</h5>
              <p class="card-text">number of topics: <?php echo $allTopics->count_topics ?></p>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-folder" style="margin-right: 8px;"></i>Categories</h5>
              <p class="card-text">number of categories: <?php echo $allCategories->count_categories ?></p>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-user-shield" style="margin-right: 8px;"></i>Admins</h5>
              <p class="card-text">number of admins: <?php echo $allAdmins->count_admins ?></p>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-reply" style="margin-right: 8px;"></i>Replies</h5>
              <p class="card-text">number of replies: <?php echo $allReplies->count_replies ?></p>
            </div>
          </div>
          
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-users" style="margin-right: 8px;"></i>Users</h5>
              <p class="card-text">number of users: <?php echo $allUsers->count_users ?></p>
            </div>
          </div>
        </div>
      </div>
<?php require "layouts/footer.php" ?>