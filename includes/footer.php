<?php 
$topics = $conn->query("SELECT COUNT(*) AS all_topics FROM topics");
$topics->execute();
$allTopics = $topics->fetch(PDO::FETCH_OBJ);

$categories = $conn->query("SELECT categories.id AS id, categories.name AS name,
  COUNT(topics.category) AS count_category FROM categories LEFT JOIN topics
   ON categories.name = topics.category GROUP BY (topics.category)");
$categories->execute();
$allCategories = $categories->fetchALL(PDO::FETCH_OBJ);

$users = $conn->query("SELECT COUNT(*) AS count_users FROM users");
$users->execute();
$allUsers = $users->fetch(PDO::FETCH_OBJ);

$topics = $conn->query("SELECT COUNT(*) AS count_topics FROM topics");
$topics->execute();
$allTopics_count = $topics->fetch(PDO::FETCH_OBJ);

$categories_count = $conn->query("SELECT COUNT(*) AS categories_count FROM categories");
$categories_count->execute();
$allCategorie_count = $categories_count->fetch(PDO::FETCH_OBJ);

// Add this query for replies count
$replies = $conn->query("SELECT COUNT(*) AS count_replies FROM replies");
$replies->execute();
$allReplies_count = $replies->fetch(PDO::FETCH_OBJ);

?>
<div class="col-md-4">
    <div class="sidebar">
                <div class="block">
            <h3><i class="fas fa-folder-open" style="color: #0056b3; margin-right: 8px;"></i> Categories</h3>
            <div class="list-group block">
                <?php 
                $current_category = isset($_GET['name']) ? $_GET['name'] : '';
                $is_homepage = !isset($_GET['name']);
                ?>
                
                <a href="<?php echo APPURL;?>" 
                class="list-group-item <?php echo $is_homepage ? 'active' : ''; ?>">
                    <i class="fas fa-layer-group" style="color: #0056b3; margin-right: 8px;"></i> All Topics 
                    <span class="color badge pull-right"><?php echo $allTopics->all_topics;?></span>
                </a>
                
                <?php foreach($allCategories as $category): ?>
                    <a href="<?php echo APPURL; ?>/categories/show.php?name=<?php echo $category->name; ?>" 
                    class="list-group-item <?php echo ($current_category == $category->name) ? 'active' : ''; ?>">
                        <i class="fas fa-folder" style="color: #0056b3; margin-right: 8px;"></i> <?php echo $category->name; ?>
                        <span class="color badge pull-right"><?php echo $category->count_category; ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

            <div class="block" style="margin-top: 20px;">
                <h3><i class="fas fa-chart-bar" style="color: #0056b3; margin-right: 8px;"></i> Forum Statistics</h3>
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <i class="fas fa-users" style="color: #0056b3; margin-right: 8px;"></i> Total Number of Users:
                        <span class="color badge pull-right"><?php echo $allUsers->count_users; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fas fa-comments" style="color: #0056b3; margin-right: 8px;"></i> Total Number of Topics:
                        <span class="color badge pull-right"><?php echo $allTopics_count->count_topics; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fas fa-reply" style="color: #0056b3; margin-right: 8px;"></i> Total Number of Replies:
                        <span class="color badge pull-right"><?php echo $allReplies_count->count_replies; ?></span>
                    </a>
                    <a href="#" class="list-group-item">
                        <i class="fas fa-folder" style="color: #0056b3; margin-right: 8px;"></i> Total Number of Categories:
                        <span class="color badge pull-right"><?php echo $allCategorie_count->categories_count; ?></span>
                    </a>
                </div>
            </div>
    </div>
</div>
</div>
</div>
</div><!-- /.container -->

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Jimma University External Relations and Communications</h3>
                <p>Email: <a href="mailto:ero@ju.edu.et">ero@ju.edu.et</a></p>
                <p>Website: <a href="https://www.ju.edu.et" target="_blank">www.ju.edu.et</a></p>
                <p>Tel: +251-(0)47-111-2202</p>
                <p>POBox: 378</p>
                <p>President Building</p>
                
                <div class="social-icons">
                    <a href="https://web.facebook.com/JimmaUniv/?_rdc=1&_rdr#"><i class="fab fa-facebook"></i></a>
                    <a href="https://x.com/JimmaUniv"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.youtube.com/channel/UCtyhlHBXkxzIsS20ZPd3vow"><i class="fab fa-youtube"></i></a>
                    <a href="https://www.linkedin.com/school/jimma-university/posts/?feedView=all"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <h3>Important Links</h3>
                <ul>
                    <li><a href="https://ju.edu.et/tuition-fee-2/">Tuition fee</a></li>
                    <li><a href="https://ju.edu.et/application-for-graduate-admission/">Application form</a></li>
                    <li><a href="https://ju.edu.et/contact-us/">Contact Us</a></li>
                    <li><a href="https://ju.edu.et/admission/">Admission</a></li>
                    <li><a href="https://ju.edu.et/women-and-youth-affairs-office-2/">Women and Youth Affairs Office</a></li>
                    <li><a href="https://ju.edu.et/ju-library/">Library</a></li>
                    <li><a href="https://ju.edu.et/student-union/">Student Union</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h3>Colleges & Institutes</h3>
                <ul>
                    <li><a href="https://ju.edu.et/jit/">Institute of Technology</a></li>
                    <li><a href="https://ju.edu.et/agri/">Agri & veterinary medicine</a></li>
                    <li><a href="https://ju.edu.et/health-institute/">Health Institutes</a></li>
                    <li><a href="https://ju.edu.et/natural-sciences/">Natural Science</a></li>
                    <li><a href="https://ju.edu.et/social-sciences-and-humanities/">Social Science</a></li>
                    <li><a href="https://ju.edu.et/college-of-business-and-conomics/">Business & Economics</a></li>
                    <li><a href="https://ju.edu.et/law-and-governance/">Law & Governance</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h3>Featured Links</h3>
                <ul>
                    <li><a href="https://www.asti.cgiar.org/ethiopia">ASTI Ethiopia</a></li>
                    <li><a href="https://ju.edu.et/academic-calendar/">Academic Calendar</a></li>
                    <li><a href="https://ju.edu.et/community-radio/">Community Radio</a></li>
                    <li><a href="https://ju.edu.et/plan-and-programme-budget/">JU Legislations & Others</a></li>
                    <li><a href="https://ju.edu.et/budget-utilization/">Budget Utilization</a></li>
                    <li><a href="https://ju.edu.et/jimma-university-procurement-property-administration-directorate-office/">Procurement & Property</a></li>
                    <li><a href="https://ju.edu.et/ict/">ICT Development Office</a></li>
                    <li><a href="https://ju.edu.et/jimma-medical-center/">Jimma Medical Center</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Add Font Awesome CDN before using icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo APPURL; ?>/js/bootstrap.js"></script>
</body>
</html>