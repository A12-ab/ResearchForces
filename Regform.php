<?php
@include 'config.php' ;
session_start() ;

$username = "" ;
if(isset($_SESSION['Newuname'])) {
  $username = $_SESSION['Newuname'] ;
  $_SESSION['logusername'] = $username ;
}

if(isset($_POST['skip'])) {
  unset($_POST['skip']) ;
  header('Location: index.php') ;
}

if(isset($_POST['Submit'])) {
    unset($_POST['Submit']) ;

    if(isset($_POST['fname'])) {
      $fname = $_POST['fname'] ;
      $query = "UPDATE user Set fullname='$fname' where username='$username' ";
      mysqli_query($conn, $query);
    }

    if(isset($_POST['country'])) {
      $country = $_POST['country'] ;
      $query = "UPDATE user Set country='$country' where username='$username' ";
      mysqli_query($conn, $query);
    }

    if(isset($_POST['org'])) {
      $org = $_POST['org'] ;
      $query = "UPDATE user Set org='$org' where username='$username' ";
      mysqli_query($conn, $query);
    }

    if(isset($_POST['interest'])) {
      $interest = $_POST['interest'] ;
      $query = "UPDATE user Set interest='$interest' where username='$username' ";
      mysqli_query($conn, $query);
    }

    header('Location: index.php') ;
}


?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Profile Informations</title>
  <link rel="stylesheet" href="regform.css">

</head> 
<body>

<body>
  <div class="typewriter">
    <h2>Hi <?php echo $username;?>, Welcome to ResearchForces! Dive into the world of collaborative research!!!</h2>
    <div class="head3 inline-container">Let's Complete your Profile <form action="" class="inline-form" method="post"> <input type="submit" class="skipbtn hover4" name="skip" placeholder="skip" value="Skip for now"/> </form></div>
  </div>
  <div class="container">

    <form action="" class="form" method="post">
      
      <input type="text" placeholder="Name" class="form__input" name="fname" id="name" />
      <label for="name" class="form__label">Full Name</label>

      <input type="text" placeholder="country" class="form__input" name="country" id="email" />
      <label for="email" class="form__label">Country</label>

      <input type="text" placeholder="org" class="form__input" name="org" id="email" />
      <label for="email" class="form__label">Organization/University</label>

      <input type="text" placeholder="interest" class="form__input" name="interest" id="email" />
      <label for="email" class="form__label">5 Field of Interest</label>

      <input type="Submit" name="Submit" class="btn" value="Submit" />
      <p class="btmtxt">Have a Happy Research Journey!!!</p>
      
    </form>
  </div>
</body>
<!-- partial -->
  <script src='https://unpkg.co/gsap@3/dist/gsap.min.js'></script>
<script src='https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js'></script>
</body>
</html>
