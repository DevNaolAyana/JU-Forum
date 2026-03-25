<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php


if (!isset($_SESSION["adminname"])) {
      header("location: ".ADMINURL."/admins/login-admins.php"); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 



$admins = $conn->query("SELECT * FROM admins ");


$admins ->execute();
$allAdmins = $admins -> fetchAll(PDO::FETCH_OBJ);

?>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline"><i class="fas fa-user-shield" style="margin-right: 8px;"></i>Admins</h5>
             <a  href="<?php echo ADMINURL ?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right"><i class="fas fa-plus" style="margin-right: 5px;"></i>Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><i class="fas fa" style="margin-right: 5px;"></i>ID</th>
                    <th scope="col"><i class="fas fa-user" style="margin-right: 5px;"></i>Username</th>
                    <th scope="col"><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($allAdmins as $admin) : ?>
                          <tr>
                            <th scope="row"><?php echo $admin->id ?></th>
                            <td><?php echo $admin->adminname ?></td>
                            <td><?php echo $admin->email ?></td>
                          
                          </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


<?php require "../layouts/footer.php" ?>