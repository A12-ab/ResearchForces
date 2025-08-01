<?php
@include 'config.php' ;
session_start() ;

$username = "Sign In" ;
$sectext = "Sign Up" ;
$image = "img/icons8-person-64.png" ;

if(isset($_SESSION['logusername'])) {
  $username = $_SESSION['logusername'] ;
  $_SESSION['username'] = $username ;
  $sql = "SELECT * FROM user WHERE username='$username'" ;
  $res = mysqli_query($conn, $sql) ;
  if($res) {
    $row = mysqli_fetch_assoc($res);
      $image = "img/dp/" . $row['dp'] ;
  }
  $sectext = "Log out" ;
}

if(isset($_POST['sectextbutton'])) {
  if($sectext=='Log out') {
    unset($_POST['sectextbutton']) ;
    session_destroy() ;
    header('Location: index.php') ;
  } else {
    unset($_POST['sectextbutton']) ;
    header('Location: login-signup.php') ;
  }
} 

if(isset($_POST['secbutton'])) {
  if($sectext=='Log out') {
    unset($_POST['secbutton']) ;
    header('Location: profile.php') ;
  } else {
    unset($_POST['secbutton']) ;
    header('Location: login-signup.php') ;
  }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="main-body.css">
    <script src="app.js"></script>
</head>
<body>
    <header>
        <div class="refr"><span class="refrs">Research</span>Forces</div> 

        <nav>
              <button class="env" onclick="scrollToContent('annotate')">Annotation</button>
              <button class="env" onclick="scrollToContent('survey')">Survey</button>
              <button class="env" onclick="scrollToContent('dataset')">Dataset</button>
              <button class="env" onclick="scrollToBottom()">About Us</button>
        </nav>

        <div class="profile">
          <img class="avatar" src="<?php echo $image; ?>">
          <form action="" class="nvsign" method="post">
            <input type="submit" class="ssnvsign" name='secbutton' value='<?php echo $username; ?>'/>
          </form>
          <p class="nvsign"> | </p>
          <form action="" class="nvsign" method="post">
            <input type="submit" class="ssnvsign" name='sectextbutton' value='<?php echo $sectext; ?>'/>
          </form>
        </div>
    </header>

    <div class="main-body">
        <div>
            <img class="logocls" src="img/ResearchForces__1_-removebg-preview.png" alt="abid">
        </div>
        <div class="main-body-first">
            <h1 class="hover-text">ResearchForces</h1>
        </div>
        <div class="main-body-second">
            <h4 class="xxx">Dedicated expert teams</h4>
        </div>
        
        <div>
            <h1 class="x1">Looking for high-quality ground truth data with precise</h1>
            <h1 class="main-body-third-second">labels in order to train your AI models?</h1>
        </div>

        <div class="second-part" id="annotate">
            <div class="second-part-first-div">
                <h2 class="hover">
                <?php
                  if($username=='Sign In') {
                    echo "<p style='color: red'>You are not Signed In, Please Sign In First</p>" ;
                  } else {
                    echo "<a href='annotelist.php'>" ;
                  }
                ?>
                Get Annotated Data</a></h2>
                <hr>
                <p class="second-part-first-p hover-para">We offer a wide variety of annotation types, including bounding boxes,
                     polygons, keypoints, 3D annotation, and video annotation. The data is 
                    labeled according to your requirements and custom 
                    taxonomy in quick iterations 
                    in order to reach maximum quality.</p>
            </div>
            <div class="second-part-second">
                  <img class="img1" src="img/dataannotate.jpg" alt="abid saharia">
            </div>
        </div>

        <div class="third-part" id="survey">
            <div class="third-part-third">
                <img class="img2" src="img/survey.jpg" alt="">
            </div>
            <div class="third-part-first-div">
                <h2 class="hover2"><a href="surveylist.php">Get High Quality Survey Data</a></h2>
                <hr>
                <p class="third-part-first-p hover-para">
                 Survey data is defined as the resultant data that is collected from a sample of respondents that took a survey. This data is comprehensive information gathered from a target audience about a specific topic to conduct research.
                </p>
            </div>
        </div>

        <div class="fourth-part" id="dataset">
            <div class="fourth-part-first-div">
                <h2 class="hover3">Vast & Diversified Dataset</h2>
                <hr>
                <p class="fourth-part-first-p hover-para">We are swimming in an ocean of data. From social posts to reviews, news stories to message boards, the digital landscape provides an unprecedented amount of information.</p>
            </div>
            <div class="fourth-part-fourth">
                  <img class="img3" src="img/dataset.png" alt="">
            </div>
        </div>
    </div>

    <div class="footer-body" id="footer">
        <footer>
          <div class="row">
            <div class="col">
             <div class="justifycontent">
              <img class="logo" src="img/dark-logo.PNG" alt="abid">
            </div>
              <p>This is a Project of CSE-326 Internet Programming (Sessional) under the supervision of Md. Rashaduzzaman sir (Lecturer, Dept.of CSE, CUET).</p>
            </div>
            <div class="col">
              <h3>Office <div class="underline"><span></span></div></h3>
              <p>Sheikh Kamal IT Business Incubator</p>
              <p>CUET, Raozan</p>
              <p>Chittagong, PIN 5600</p>
              <p class="email-id">support@researchforces.com</p>
              <h4>+8801787382932</h4>
            </div>
            <div class="col">
              <h3>Links <div class="underline"><span></span></div></h3>
              <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Features</a></li>
                <li><a href="">Contacts</a></li>
              </ul>
            </div>
            <div class="col">
              <h3>Newsletter <div class="underline"><span></span></div></h3>
              <form>
                <i class="env"></i>
                <input type="email" placeholder="Enter your email id">
                <button type="submit" class="Fbutton"></button>
              </form>
              <h2>Find us on...</h2>
              <div>
                <img src="img/icons8-facebook-100.png" class="social-icons">
                <img src="img/icons8-linkedin-100.png" class="social-icons">
                <img src="img/icons8-github-100.png" class="social-icons">
                <img src="img/icons8-twitter-100.png" class="social-icons">
              </div>
            </div>
          </div>
          <hr>
          <p class="copyright">&copy; Ahmed Abid Saharia & Arefin Labib</p>
        </footer>
      </div>

</body>
</html>