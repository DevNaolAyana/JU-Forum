<?php require "../includes/header.php";
require "../config/config.php";
 ?>
 <?php
if (!isset($_SESSION["username"])) {
      header("location: ".APPURL.""); //if the session is not set take the user to the homepage
    } 

//GRABBING TOPIC 
if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $select = $conn->query("SELECT * FROM replies WHERE id='$id'"); // to know if he has the power to update it 
    $select->execute();

    $reply = $select->fetch(PDO::FETCH_OBJ);//one row at atime
    
      if ($reply->user_id !== $_SESSION["user_id"]) {// nomatch then no access 
       header("location: ".APPURL."");
       }
    
}

if (isset($_POST["submit"])) {  //when u press on ["submit"] 
	if (//the title, category AND TOPIC BODY
		empty($_POST["reply"])){
	echo "<script>alert('one or more inputs are empty');</script>";
	}	else
	 { 
		$reply = $_POST["reply"];// grabing with the super global post
                                



		$update = $conn->prepare("UPDATE replies SET reply = :reply WHERE id='$id'");//updating
		$update->execute([ //grabing handlers
			
			":reply" => $reply,

			]);

			// header("location: create.php "); after subtion righ there 
		header("location: ".APPURL."");//Concatinating  ,after submission comes to the home page
		} 
}
?>
<div class="container" style="margin-top: 60px;">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left"><i class="fas fa-edit" style="margin-right: 10px;"></i>Update a Reply</h1>
						<div class="clearfix"></div>
						<hr>
						<form role="form" method="POST" action="update.php?id=<?php echo $id; ?>">
							<div class="form-group">
								<!--  using name we grab them -->
								<label><i class="fas fa-reply" style="margin-right: 8px;"></i>Reply</label>
								<textarea id="reply" rows="10" cols="80" class="form-control" name="reply" placeholder="Enter Reply"><?php echo $reply->reply; ?></textarea>
								<script>CKEDITOR.replace('reply');</script>
							</div>
							<button type="submit" name="submit" class="color btn btn-default"><i class="fas fa-save" style="margin-right: 8px;"></i>Update</button>
						</form>
					</div>
				</div>
			</div>
			<?php require "../includes/footer.php"; ?>