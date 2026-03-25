<?php require "includes/header.php"; ?>
<?php require "config/config.php";?>
<?php     

$topics = $conn->query("SELECT topics.id AS id, 
topics.title AS title, 
topics.category AS category, 
topics.user_name AS user_name, 
topics.user_image AS user_image, 
topics.created_at AS created_at, 
COUNT(replies.topic_id) AS count_replies FROM topics LEFT JOIN replies ON 
topics.id = replies.topic_id GROUP BY topics.id ORDER BY topics.created_at DESC");
//added LEFT allows to grab every topic that we have even if we dont have  a reply for them
//left table is the table after the from
//right table is the table after the "JOIN" key word
$topics->execute();

$allTopics = $topics->fetchAll(PDO::FETCH_OBJ);//fetch all because its more than on row
//FETCHES it as an object

?>
    <div class="container" style="margin-top: 60px;">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left"><i class="fas fa-home" style="margin-right: 10px;"></i>Welcome to  Jimma Universty Forum</h1>
						<!-- <h4 class="pull-right">A Simple Forum</h4> -->
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
							<?php foreach($allTopics as $topic): ?>
								<!-- //help us get it  topic is our new opject  and grab the intatians as properties  down-->
							<li class="topic">
							   <div class="row">
									<div class="col-md-2">
										<img class="avatar pull-left" src="img/<?php echo $topic->user_image; ?>" />
										<!-- user_image is colum name so its an instanciation -->
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<h3><a href="topics/topic.php?id=<?php echo $topic->id; ?>"><i class="fas fa-file-alt" style="margin-right: 8px;"></i><?php echo $topic->title; ?></a></h3>
											<!-- giving parameter dynamically using id so that we can fetch the id and reuse it later by the alias id  -->
											<div class="topic-info" style="font-size: 12px;">
												<a href="<?php echo APPURL; ?>/categories/show.php?name=<?php echo $topic->category; ?>"><i class="fas fa-folder" style="margin-right: 5px;"></i><?php echo $topic->category; ?></a> >> by:
												<a href="<?php echo APPURL; ?>/users/profile.php?name=<?php echo $topic->user_name; ?>"><i class="fas fa-user" style="margin-right: 5px;"></i><?php echo $topic->user_name; ?></a> >> Posted on: <i class="far fa-calendar-alt" style="margin-right: 5px;"></i><?php echo $topic->created_at; ?>
												<span class="color badge pull-right"><i class="fas fa-reply" style="margin-right: 5px;"></i><?php echo $topic->count_replies; ?></span>
											</div>
										</div>
									</div> 
								</div>
							</li>
                         <?php endforeach; ?>
						</ul>
						
					</div>
				</div>
			</div>
<?php require "includes/footer.php"; ?>