<?php require "../includes/header.php";
require "../config/config.php";
 ?>
 <?php
if (!isset($_SESSION["username"])) {
      header("location: ".APPURL.""); //if the session is not set take the user to the homepage
    } 



if (isset($_POST["submit"])) {  //when u press on ["submit"] 
	if (//the title, category AND TOPIC BODY
		empty($_POST["title"]) OR empty($_POST["category"]) OR empty($_POST["body"])){
	echo "<script>alert('one or more inputs are empty');</script>";
	}	else
	 {
		$title = $_POST["title"];// grabing with the super global post
		$category = $_POST["category"];
		$body = $_POST["body"];
		$user_name= $_SESSION["username"];
		$user_image= $_SESSION["user_image"];

		//has time stamp at the back with "created_at"
		//topics is the the table name
		$insert = $conn->prepare("INSERT INTO topics (title, category, body, user_name, user_image) 
	                      VALUES(:title, :category, :body, :user_name, :user_image)");//preparing handlers
		$insert->execute([ //grabing handlers
			
			":title" => $title,
			"category"=> $category,
			":body" => $body,
			":user_name" => $user_name,
			"user_image"=> $user_image,
			]);
			// header("location: create.php "); after subtion righ there 
		header("location: ".APPURL."");//Concatinating  ,after submission comes to the home page
		} 
}


//dynamicaly chose categories
$categories_select = $conn->query("SELECT * FROM categories");
$categories_select->execute();

$allCats = $categories_select->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container" style="margin-top: 60px;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left"><i class="fas fa-plus-circle" style="margin-right: 10px;"></i>Create A Topic</h1>
					<div class="clearfix"></div>
					<hr>
					<form role="form" method="POST" action="create.php">
						<div class="form-group">
							<label><i class="fas fa-pen" style="margin-right: 8px;"></i>Topic Title</label>
							<input type="text" class="form-control" name="title" placeholder="Enter Post Title">
						</div>
						<div class="form-group">
							<label><i class="fas fa-folder" style="margin-right: 8px;"></i>Category</label>
							<select name="category" class="form-control">
								<?php foreach($allCats as $cat) : ?>
								<option value="<?php echo $cat->name ?>"><?php echo $cat->name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label><i class="fas fa-file-alt" style="margin-right: 8px;"></i>Topic Body</label>
							<textarea id="body" rows="10" cols="80" class="form-control" name="body"></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
						<button type="submit" name="submit" class="color btn btn-default"><i class="fas fa-check" style="margin-right: 8px;"></i>Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "../includes/auth-footer.php"; ?>