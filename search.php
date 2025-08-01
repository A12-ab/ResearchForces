<?php
@include 'config.php' ;
session_start() ;

$username = "" ;
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ;
    $sql = "SELECT * FROM user WHERE username='$username'" ;
    $res = mysqli_query($conn, $sql) ;
    if($res) {
        $row = mysqli_fetch_assoc($res);
        $image = "img/dp/" . $row['dp'] ;
    }
}

$_SESSION['username'] = $username ;
if(isset($_SESSION['permit'])) {
    unset($_SESSION['permit']) ;
}

$sectext = "Log out" ;

if(isset($_POST['sectextbutton'])) {
    unset($_POST['sectextbutton']) ;
    session_destroy() ;
    header('Location: index.php') ;
}

if(isset($_POST['secbutton'])) {
    unset($_POST['secbutton']) ;
    $_SESSION['username'] = $username ;
    header('Location: profile.php') ;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Search | ResearchForces</title>
    <link rel="stylesheet" href="main-body.css">
    <link rel="stylesheet" href="searchh.css">
    <style>
        img {
            margin-left: 515px ;
            width: 300px ;
            height: 300px ;
        }
    </style>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="app.js"></script>
</head>
<body>
    <header>
        <a href="index.php" class="noref"><div class="refr"><span class="refrs">Research</span>Forces</div></a>

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

    <img src="img/ResearchForces__1_-removebg-preview.png">

    <div id="search">
        <svg viewBox="0 0 420 60" xmlns="http://www.w3.org/2000/svg">
            <rect class="bar"/>
            
            <g class="magnifier">
                <circle class="glass"/>
                <line class="handle" x1="32" y1="32" x2="44" y2="44"></line>
            </g>

            <g class="sparks">
                <circle class="spark"/>
                <circle class="spark"/>
                <circle class="spark"/>
            </g>

            <g class="burst pattern-one">
                <circle class="particle circle"/>
                <path class="particle triangle"/>
                <circle class="particle circle"/>
                <path class="particle plus"/>
                <rect class="particle rect"/>
                <path class="particle triangle"/>
            </g>
            <g class="burst pattern-two">
                <path class="particle plus"/>
                <circle class="particle circle"/>
                <path class="particle triangle"/>
                <rect class="particle rect"/>
                <circle class="particle circle"/>
                <path class="particle plus"/>
            </g>
            <g class="burst pattern-three">
                <circle class="particle circle"/>
                <rect class="particle rect"/>
                <path class="particle plus"/>
                <path class="particle triangle"/>
                <rect class="particle rect"/>
                <path class="particle plus"/>
            </g>
        </svg>
        <input type=search name=q aria-label="Search for inspiration"/>
    </div>

    <div id="results">
        
    </div>
</body>
</html>