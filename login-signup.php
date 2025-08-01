<?php
@include 'config.php' ;
session_start() ;

if (isset($_POST['rsubmit'])) {
  unset($_POST['rsubmit']) ;
  $username = $_POST['username'] ;
  $rmail = $_POST['email'] ;
  $pass = $_POST['password'] ;
  $_SESSION['Newuname'] = $username ;

  $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$rmail', '$pass')";
  mysqli_query($conn, $query); 
  header('Location: Regform.php') ;
}
else if (isset($_POST['lgsubmit'])) {
  unset($_POST['lgsubmit']) ;
  $luname = $_POST['lusername'] ;
  $lpass = $_POST['lpassword'] ;
  $errorMessage = '' ;

  $query = "SELECT * from user where username='$luname' and password='$lpass' " ;
  $result = mysqli_query($conn, $query) ;
  if (mysqli_num_rows($result)) {
    $_SESSION['logusername'] = $luname ;
    header('Location: index.php') ;
  } else {
    $errorMessage = "Password error!!! Try again";
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css" />
  <title>Sign in & Sign up Form</title>
</head>
<body>
  <div id="video-background">
    <video autoplay muted loop plays-inline>
      <source src="img/tunnel_-_79764 (1080p).mp4" type="video/mp4">
      <!-- You can add multiple source elements for different video formats -->
      <!-- <source src="path/to/video.webm" type="video/webm"> -->
      <!-- <source src="path/to/video.ogv" type="video/ogg"> -->
    </video>
  </div>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="" class="sign-in-form" method="post">
          <h2 class="title">Sign in</h2>
          <?php if (!empty($errorMessage)) : ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
          <?php endif; ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="lusername" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="lpassword" placeholder="Password" required />
          </div>
        
          <input type="submit" name="lgsubmit" value="Login" class="btn solid" />
          <a href="forgetpass.php" class="forgot"> Forgot Password? </a>
          <p class="social-text">Or Sign in with social platform</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
        <form action="" class="sign-up-form" method="post">
          <h2 class="title">Sign up</h2>
          <input type="text" name="username" id="inputField" placeholder="Username" class="input-container" oninput=checkConditions(this) required/>
          <div id="reasonsDialog"></div>
          <br>
          <input type="email" name="email" placeholder="Email" class="input-container" required/>
          <br>
          <input type="password" name="password" id="inputField1" placeholder="Password" class="input-container" oninput=checkConditions1(this) required/>
          <div id="reasonsDialog1"></div>
          <input type="submit" name="rsubmit" class="btn" value="Sign Up"/>
          <p class="social-text">Or Sign up with social platforms</p>
          <div class="social-media">
            <a href="#" class="social-icon">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-google"></i>
            </a>
            <a href="#" class="social-icon">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here?</h3>
          <p>
            Join with us and explore the benefits of <font style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif"><b>ResearchForces</b></font>.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/ResearchForces__1_-removebg-preview.png" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us?</h3>
          <p>
            Help and Get Helped. That's our motive.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/ResearchForces__1_-removebg-preview.png" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="signin.js"></script>
  <script>
    function checkConditions(input) {
    // Get the input value
    const inputValue = input.value.trim();

    // Regular expression to check for the presence of special characters
    const specialCharsRegex = /[^a-zA-Z0-9]/;

    // Regular expression to check for the presence of at least one number
    const numberRegex = /\d/;

    // Check conditions (not using special characters and at least one number)
    const isCondition1Fulfilled = !specialCharsRegex.test(inputValue);
    const isCondition2Fulfilled = numberRegex.test(inputValue);

    // Set the appropriate class based on condition fulfillment
    if (isCondition1Fulfilled && isCondition2Fulfilled) {
      input.parentElement.classList.remove("invalid");
      input.parentElement.classList.add("valid");

      // Hide the reasons dialogue box if conditions are fulfilled
      document.getElementById("reasonsDialog").style.display = "none";
    } else {
      input.parentElement.classList.remove("valid");
      input.parentElement.classList.add("invalid");

      // Show the reasons in the dialogue box
      let reasons = "The input should:<br>";
      if (!isCondition1Fulfilled) {
        reasons += "- Not use any special characters except letters and numbers.<br>";
      }
      if (!isCondition2Fulfilled) {
        reasons += "- Include at least one number.<br>";
      }
      document.getElementById("reasonsDialog").innerHTML = reasons;
      document.getElementById("reasonsDialog").style.display = "block";
    }
  }

  function checkConditions1(input) {
      // Get the input value
      const inputValue = input.value;

      // Regular expression to check for the presence of numbers
      const numberRegex = /\d/;

      // Regular expression to check for the presence of an uppercase and lowercase letter
      const uppercaseRegex = /[A-Z]/;
      const lowercaseRegex = /[a-z]/;

      // Check conditions (must contain numbers, an uppercase and a lowercase letter, and minimum length is 6 digits)
      const isCondition1Fulfilled = numberRegex.test(inputValue);
      const isCondition2Fulfilled = uppercaseRegex.test(inputValue) && lowercaseRegex.test(inputValue);
      const isCondition3Fulfilled = inputValue.length >= 6;

      // Set the appropriate class based on condition fulfillment
      if (isCondition1Fulfilled && isCondition2Fulfilled && isCondition3Fulfilled) {
        input.parentElement.classList.remove("invalid");
        input.parentElement.classList.add("valid");

        // Hide the reasons dialogue box if conditions are fulfilled
        document.getElementById("reasonsDialog1").style.display = "none";
      } else {
        input.parentElement.classList.remove("valid");
        input.parentElement.classList.add("invalid");

        // Show the reasons in the dialogue box
        let reasons = "The input should:<br>";
        if (!isCondition1Fulfilled) {
          reasons += "- Contain numbers.<br>";
        }
        if (!isCondition2Fulfilled) {
          reasons += "- Contain both an uppercase and a lowercase letter.<br>";
        }
        if (!isCondition3Fulfilled) {
          reasons += "- Have a minimum length of 6 characters.<br>";
        }
        document.getElementById("reasonsDialog1").innerHTML = reasons;
        document.getElementById("reasonsDialog1").style.display = "block";
      }
    }
  </script>
</body>
</html>
