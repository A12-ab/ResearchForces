<?php
@include 'config.php' ;
session_start() ;

$level = "" ;
$username = "" ;
$image = "" ;
$country = "" ;
$point = 0 ;
$contribution = 0 ;
$fullname = "" ;
$email = "" ;
$org = "" ;
$interest = "" ;


if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ;
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

$sql = "SELECT * FROM user WHERE username='$username'" ;
$res = mysqli_query($conn, $sql) ;

if($res) {
    $row = mysqli_fetch_assoc($res);
    $level = $row['level'] ;
    $fullname = $row['fullname'] ;
    $country = $row['country'] ;
    $point = $row['point'] ;
    $email = $row['email'] ;
    $org = $row['org'] ;
    $interest = $row['interest'] ;
    $image = "img/dp/" . $row['dp'] ;
}

if (isset($_POST['submitBtn'])) {
    $targetDir = "img/dp/";
    $filename = basename($_FILES['file']['name']) ;
    $targetFile = $targetDir . $filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);

    $query = "UPDATE user Set dp='$filename' where username='$username' ";
    mysqli_query($conn, $query);
    header('Location: profile.php') ;
}

$cown = 0 ;
$creq = 0 ;
$greq = 0 ;

$qry = "SELECT * FROM resource WHERE author='$username'" ;
$res = mysqli_query($conn, $qry) ;
if($res) {
    $cown = mysqli_num_rows($res) ;
} 

$qry = "SELECT * FROM resource INNER JOIN requests ON resource.rid = requests.rid WHERE resource.author = '$username' and requests.status='pending'" ;
$res2 = mysqli_query($conn, $qry) ;
if($res2) {
    $greq = mysqli_num_rows($res2) ;
}

$qry = "SELECT * FROM requests WHERE username='$username' and (status='accepted' or status='pending')" ;
$res1 = mysqli_query($conn, $qry) ;
if($res1) {
    $creq = mysqli_num_rows($res1) ;
}

 
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username ?> | ResearchForces</title>
    <link rel="stylesheet" href="main-body.css">
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

    <nav class="navstyle">
        <h5>Manage Resources:</h5> &nbsp;&nbsp;&nbsp;
        <h5><a href="own.php">Own<?php if($cown) {echo '('.$cown.')';}else{echo "";}?></a></h5> &nbsp;&nbsp;&nbsp;
        <h5><a href="requested.php">Requested<?php if($greq) {echo '('.$greq.')';}else{echo "";}?></a></h5> &nbsp;&nbsp;&nbsp;
        <h5><a href="sentrequ.php">Sent Requests<?php if($creq) {echo '('.$creq.')';}else{echo "";}?></a></h5>
    </nav>

    <div class="card">
        <div class="card-content">
            <div class="left-column">
                <h5><?php echo $level; ?></h5>
                <h1><?php echo $username;?></h1>
                <p><?php echo $fullname; ?> <?php if($fullname != "" && $country != ""){echo ",";}?> <?php echo $country; ?> <br> <?php echo $org; ?></p>
                <br>
                <div class="point"><img src="img/icons8-gold-50.png" width="25px" height="25px"> &nbsp; Usable Point: &nbsp; <span class="numeric"> <?php echo $point;?> </span></div>
                <div class="point"><img src="img/icons8-task-50.png" width="25px" height="25px"> &nbsp; Contribution: &nbsp; <span class="numeric"> <?php echo $contribution;?> </span></div>
                <div class="point"><img src="img/icons8-email-50.png" width="25px" height="25px"> &nbsp; Email: &nbsp; <span> <?php echo $email;?> </span></div>
                <div class="point"><img src="img/icons8-friend-64.png" width="25px" height="25px"> &nbsp; Friend of: 21 User</div>
                <p>Field of Interest: <?php echo $interest; ?></p>
            </div>
            <div class="right-column">
                <img src="<?php echo $image;?>"/>
                <button class="buttonss btn" onclick="showUpload()">change</button>
                <form id="uploadForm" class="hidden" method="POST" enctype="multipart/form-data">
                    <div class="button-container">
                        <input type="file" name="file" id="fileInput" onchange="showFileName()" />
                        <button type="button" class="bttn" onclick="removeFile()">Cancel</button>
                        <button type="submit" name="submitBtn" class="bttn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="chart">
        <p>Contribution Chart:</p>
        <img src="img/con-chart.png" />
    </div>

</body>
</html>