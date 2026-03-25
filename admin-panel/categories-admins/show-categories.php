<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php" ?>
<?php


if (!isset($_SESSION["adminname"])) {
      header("location: ".ADMINURL."/admins/login-admins.php"); //used if onece we logged in we canot get back to the log in page even if we change the directory on the top the vrowser (both in register and login page)
    } 



 $categories = $conn->query("SELECT * FROM categories");
 $categories->execute();
 $allCategories = $categories->fetchALL(PDO::FETCH_OBJ);

?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline"><i class="fas fa-folder" style="margin-right: 8px;"></i>Categories</h5>
             <a  href="<?php echo ADMINURL; ?>/categories-admins/create-category.php" class="btn btn-primary mb-4 text-center float-right">
               <i class="fas fa-plus" style="margin-right: 5px;"></i>Create Categories
             </a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><i class="fas " style="margin-right: 5px;"></i>ID</th>
                    <th scope="col"><i class="fas fa-tag" style="margin-right: 5px;"></i>Name</th>
                    <th scope="col"><i class="fas fa-edit" style="margin-right: 5px;"></i>Update</th>
                    <th scope="col"><i class="fas fa-trash" style="margin-right: 5px;"></i>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allCategories as $category) :?>
                  <tr>
                    <th scope="row"><?php echo $category->id; ?></th>
                    <td><?php echo $category->name; ?></td>
                    <td>
                      <a href="update-category.php?id=<?php echo $category->id; ?>" class="btn btn-warning text-white text-center">
                        <i class="fas fa-edit" style="margin-right: 5px;"></i>Update
                      </a>
                    </td>
                    <td>
                      <a href="delete-category.php?id=<?php echo $category->id; ?>" class="btn btn-danger text-center">
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