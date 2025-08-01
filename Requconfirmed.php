<?php
session_start() ;
$username = $_SESSION['username'] ;
$_SESSION['username'] = $username ;
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
  <div class="typewriter">
    <br>
    <br>
    <br>
    <br>
    <h2>Your Request has been sent. Keep an eye on your profile</h2>
    <br>
    <br>
    <button class="btn"><a href="index.php">Home</a></button>
    <button class="btn"><a href="profile.php">Profile</a></button>
  </div>
  
</body>
<!-- partial -->
  <script src='https://unpkg.co/gsap@3/dist/gsap.min.js'></script>
<script src='https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js'></script>
</body>
</html>
