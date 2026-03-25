<?php require "../includes/header.php"; ?>
<?php require "../config/config.php";?>
<?php  
if (isset($_GET["name"])) {//getting my name because it is fetched dynamically by names from  footer.php
    $name = $_GET["name"];// get name throught the url
    
    // Check if category exists in database
    $check_cat = $conn->query("SELECT * FROM categories WHERE name = '$name'");
    $check_cat->execute();
    
    if($check_cat->rowCount() == 0) {
        // Category doesn't exist - redirect to 404
        header("location:".APPURL."/404.php");
        exit();
    }

    $topics = $conn->query("SELECT * FROM topics WHERE category = '$name'");
    $topics->execute();
    $allTopics = $topics->fetchAll(PDO::FETCH_OBJ);//fetch all because its more than on row
    //FETCHES it as an object
} else {
    header("location:".APPURL."/404.php");
    exit();
}
?>
    <div class="container" style="margin-top: 60px;">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left"><i class="fas fa-folder-open" style="margin-right: 10px;"></i>Category: <?php echo $name; ?></h1>
						<!-- <h4 class="pull-right">A Simple Forum</h4> -->
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
							<?php if(count($allTopics) > 0): ?>
								<?php foreach($allTopics as $topic): ?>
									<!-- //help us get it  topic is our new opject  and grab the intatians as properties  down-->
								<li class="topic">
								   <div class="row">
										<div class="col-md-2">
											<img class="avatar pull-left" src="../img/<?php echo $topic->user_image; ?>" />
											<!-- user_image is colum name so its an instanciation -->
										</div>
										<div class="col-md-10">
											<div class="topic-content pull-right">
												<h3><a href="../topics/topic.php?id=<?php echo $topic->id; ?>"><i class="fas fa-file-alt" style="margin-right: 8px;"></i><?php echo $topic->title; ?></a></h3>
												<!-- giving parameter dynamically using id so that we can fetch the id and reuse it later by the alias id  -->
												<div class="topic-info" style="font-size: 12px;">
													<a href="<?php echo APPURL; ?>/categories/show.php?name=<?php echo $topic->category; ?>"><i class="fas fa-folder" style="margin-right: 5px;"></i><?php echo $topic->category; ?></a> >> by:
													<a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $topic->user_name; ?>"><i class="fas fa-user" style="margin-right: 5px;"></i><?php echo $topic->user_name; ?></a> >> Posted on: <i class="far fa-calendar-alt" style="margin-right: 5px;"></i><?php echo $topic->created_at; ?>
													
												</div>
											</div>
										</div>
									</div>
								</li>
                         <?php endforeach; ?>
						 <?php else: ?>
							<li class="topic">
								<div class="alert alert-info">
									<i class="fas fa-info-circle" style="margin-right: 5px;"></i> No topics found in this category.
								</div>
							</li>
						 <?php endif; ?>
						</ul>
						
					</div>
				</div>
			</div>
<?php require "../includes/footer.php"; ?>