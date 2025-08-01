<?php 
session_start() ;
@include 'config.php' ;

if(isset($_GET['id'])) {
    $ID = $_GET['id'] ;
}

$sql = "SELECT * FROM resource where rid='$ID' " ;
$res = mysqli_query($conn, $sql) ;
if($res) {
    $row = mysqli_fetch_assoc($res) ;
    $option1 = $row['option1'] ;
    $option2 = $row['option2'] ;
    $dop = $row['dop'] ;
    $resc = $row['rescount'] ;
}

$_SESSION['id'] = $ID ;
$_SESSION['opt1'] = $option1 ;
$_SESSION['opt2'] = $option2 ;
$_SESSION['dop'] = $dop ;
$_SESSION['resc'] = $resc ;

$username = "" ;
$sectext = "Log Out" ;
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ;
    $_SESSION['username'] = $username ;
    $sql = "SELECT * FROM user WHERE username='$username'" ;
    $res = mysqli_query($conn, $sql) ;
    if($res) {
        $row = mysqli_fetch_assoc($res);
        $image = "img/dp/" . $row['dp'] ;
    }
}

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

$title = "" ;
$author = "" ;
$type = "" ;
$dop = "" ;
$description = "" ;
$instructions = "" ;
$rescount = 0 ;

$sql = "SELECT * FROM resource WHERE rid='$ID'" ;
$res = mysqli_query($conn, $sql) ;

if($res) {
    $row = mysqli_fetch_assoc($res) ;
    $title = $row['name'] ;
    $author = $row['author'] ;
    $type = $row['type'] ;
    $dop = $row['dop'] ;
    $dop = date('d M Y, H:i', $dop);
    $description = $row['description'] ;
    $instructions = $row['instructions'] ;
    $rescount = $row['rescount'] ;
}

$btntext = 'Request for Annotate' ;
if(isset($_SESSION['permit'])) {
    $btntext = 'Start Annotating' ;
} 
if($author==$username) {
    $btntext = 'View CSV reports' ;
}


if(isset($_POST['annbtn'])) {
    if(isset($_SESSION['permit'])) {
        unset($_SESSION['permit']);
        header('Location: annoteimg.php') ;
    }
    else if($author==$username) {
        unset($_SESSION['permit']) ;
        header('Location: viewcsv.php') ;
    }
    else {
        $sql = "INSERT INTO requests (rid, username) VALUES ('$ID', '$username')" ;
        mysqli_query($conn, $sql) ;
        unset($_SESSION['permit']);
        header('Location: Requconfirmed.php') ;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $ID;?> | ResearchForces</title>
    <link rel="stylesheet" href="detailstyle.css">
    <script src="detailapp.js"></script>
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

    <div class="card">
        <div class="card-content">
            <h4 class="wttext">Resource ID: <?php echo $ID;?></h4>
            <h2 class="wttext"><?php echo $title;?></h2>
            <p class="wttext"><?php echo $author;?> , <?php echo $dop;?> </p>
            <p class="wttext"><?php echo $type;?></p>
            <br>
            <h3 class="wttext">Description</h3>
            <p class="wttext"><?php echo $description;?></p>
            <br>
            <h3 class="wttext">Instruction</h3>
            <p class="wttext"><?php echo $instructions;?></p>
            <br>
            <br>
            <form method="post">
                <button class="annbtn" name="annbtn"><?php echo $btntext;?></button>
            </form>
        </div>
    </div>

</body>
</html>