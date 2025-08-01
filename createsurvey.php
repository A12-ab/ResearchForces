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

if (isset($_POST['submitBtn'])) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['instruction']) && isset($_POST['opt1']) && isset($_POST['opt2']) && isset($_POST['noi'])) {
        $title = $_POST['title'] ;
        $desc = $_POST['description'] ;
        $ins = $_POST['instruction'] ;
        $author = $username ;
        $type = "annotation" ;
        $dop = time() ;
        $option1 = $_POST['opt1'] ;
        $option2 = $_POST['opt2'] ;
        $noi = $_POST['noi'] ;
        $sql = "INSERT INTO resource (type, name, author, dop, description, instructions, imgquantity, option1, option2) VALUES ('$type', '$title', '$author', '$dop', '$desc', '$ins', '$noi', '$option1', '$option2')" ;
        mysqli_query($conn, $sql);

        $foldername="Annotefiles"."/".$dop;
        if(!is_dir($foldername)) mkdir($foldername);
        foreach($_FILES['files']['name'] as $i => $name)
        {
            if(strlen($_FILES['files']['name'][$i]) > 1)
            {  move_uploaded_file($_FILES['files']['tmp_name'][$i],$foldername."/".$name);
            }
        }
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Create Survey | ResearchForces</title>
    <link rel="stylesheet" href="createannotestyle.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="app.js"></script>
</head>
<body>
    <header>
        <a href="index.php" class="noref"><div class="refr"><span class="refrs">Research</span>Forces</div></a>
        <div class="profile">
          <img class="avatar" src="<?php echo $image; ?>">
        </div>
    </header>
    
    <div class="container">
        <nav class="menu">
            <ul class="main-menu">
                <li><a href="surveylist.php">List</a></li>
                <li class="active">Create</li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Search</a></li>
            </ul>
        </nav>
        <article> 
                <form action="" method="post" enctype="multipart/form-data">
                    <label> &nbsp;&nbsp;&nbsp; Title</label>
                    <input type="text" placeholder="A Beautiful title attracts all" name="title" />
                    <br>
                    <label> &nbsp;&nbsp;&nbsp; Description</label>
                    <input type="text" placeholder="Explain about your work" name="description" />
                    <br>
                    <label> &nbsp;&nbsp;&nbsp; Instructions</label>
                    <input type="text" placeholder="Clear and Concise Instruction will provide best collaboration" name="instruction" />
                    <br>
                    <label> &nbsp;&nbsp;&nbsp; Add Questions</label>
                    <div id="wrapper">
                    <div id="field_div">
                    <button class="bttn" onclick="add_field();">+</button>
                    </div>
                    </div>
                    <button type="submit" name="submitBtn" class="btn">Submit</button>
                </form>
        </article>
    </div>

    <script>
        function add_field()
        {
        var total_text=document.getElementsByClassName("input_text");
        total_text=total_text.length+1;
        document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
        "<p id='input_text"+total_text+"_wrapper'><input type='text' id='input_text"+total_text+"' placeholder='Enter question'><input type='text' class='input_text' id='input_opt1"+total_text+"' placeholder='Option1'><input type='text' class='input_text' id='input_opt2"+total_text+"' placeholder='Option2'><button class='rmvbtn' onclick=remove_field('input_text"+total_text+"');>-</button></p>";
        }
        function remove_field(id)
        {
        document.getElementById(id+"_wrapper").innerHTML="";
        }
    </script>

</body>
</html>