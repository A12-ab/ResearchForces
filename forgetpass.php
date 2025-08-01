<?php

if (isset($_POST['Submit'])) {
  unset($_POST['Submit']) ;
  header('Location: login-signup.php') ;
}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="forget.css">

</head>
<body>

<body>
  <h2 class="titlee">Having a temporary memory lapse? </h2> 
  <div class="typewriter">
    <h2>Let's reset your password.</h2>
  </div>
  <div class="container">

    <form action="" class="form">
      
      <input type="text" placeholder="Name" class="form__input" id="name" />
      <label for="name" class="form__label">Enter username</label>

      <input type="email" placeholder="Email" class="form__input" id="email" />
      <label for="email" class="form__label">Enter email</label>

      <input type="Submit" name="Submit" class="btn" value="Submit" />
      <p>We have sent an email if your email is valid. Please check your inbox.</p>
      
    </form>
  </div>
</body>
<!-- partial -->
  <script src='https://unpkg.co/gsap@3/dist/gsap.min.js'></script>
<script src='https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js'></script>
</body>
</html>
