<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>

<?php
if (!isset($_SESSION["adminname"])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
} 

$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
$users->execute();
$allUsers = $users->fetchALL(PDO::FETCH_OBJ);
?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline"><i class="fas fa-users" style="margin-right: 8px;"></i>Users</h5>
             <a href="<?php echo ADMINURL; ?>/users-admins/create-user.php" class="btn btn-primary mb-4 text-center float-right">
               <i class="fas fa-plus" style="margin-right: 5px;"></i>Create User
             </a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><i class="fas fa-id" style="margin-right: 5px;"></i>ID</th>
                    <th scope="col"><i class="fas fa-user" style="margin-right: 5px;"></i>Name</th>
                    <th scope="col"><i class="fas fa-user-circle" style="margin-right: 5px;"></i>Username</th>
                    <th scope="col"><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email</th>
                    <th scope="col"><i class="fas fa-calendar" style="margin-right: 5px;"></i>Joined</th>
                    <th scope="col"><i class="fas fa-edit" style="margin-right: 5px;"></i>Edit</th>
                    <th scope="col"><i class="fas fa-trash" style="margin-right: 5px;"></i>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allUsers as $user) :?>
                  <tr>
                    <th scope="row"><?php echo $user->id; ?></th>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo date('M d, Y', strtotime($user->created_at)); ?></td>
                    <td>
                      <a href="edit-user.php?id=<?php echo $user->id; ?>" class="btn btn-warning text-white text-center">
                        <i class="fas fa-edit" style="margin-right: 5px;"></i>Edit
                      </a>
                    </td>
                    <td>
                      <a href="delete-user.php?id=<?php echo $user->id; ?>" class="btn btn-danger text-center">
                        <i class="fas fa-trash" style="margin-right: 5px;"></i>Delete
                      </a>
                    </td>
                  </tr>
                <?php endforeach ;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php" ?>