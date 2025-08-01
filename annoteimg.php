<?php
session_start() ;
@include 'config.php' ;
$option1 = $_SESSION['opt1'] ;
$option2= $_SESSION['opt2'] ;
$rid = $_SESSION['id'] ;
$dop = $_SESSION['dop'] ;
$resc = $_SESSION['resc'] ;
$_SESSION['resc'] = $resc ;
$username = $_SESSION['username'] ;

$sql = "SELECT * FROM user WHERE username='$username'" ;
$res = mysqli_query($conn, $sql);  
if($res) {
  $row = mysqli_fetch_assoc($res) ;
  $pts = $row['point'] ;
}

$pts = $pts + 20 ;

$qry = "UPDATE user set point='$pts' WHERE username='$username'" ;
mysqli_query($conn, $qry) ;
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $rid;?> | ResearchForces</title>
  <style>
    /* Add your custom CSS styles here */
    body {
        background-image: url('img/bg111.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
    img {
      width: 700px;
      height: 500px;
    }

    p {
      display: none ;
      color: #ffffff ;
    }
    input {
      color: #ffffff ;
    }
  </style>
</head>
<body>
  <div id="imageContainer">
    <img id="currentImage" src="" alt="Image">
  </div>
  <form action="" id="optionsForm">
    <input type="radio" name="options" value="<?php echo $option1; ?>" id="option1"> <label for="option1"><?php echo $option1; ?></label>
    <input type="radio" name="options" value="<?php echo $option2; ?>" id="option2"> <label for="option2"><?php echo $option2; ?></label>
    <br>
    <button type="button" id="nextButton">Next</button>
  </form>

  <p id='final'>Thanks a lot for collaboration. You have earned 20 point. <br>Go to <a href='index.php'>Home</a></p>
  <?php 
    @include 'config.php' ;
    $resc = $resc + 1 ;
    $sql = "UPDATE resource SET rescount='$resc' WHERE rid='$rid'" ;
    mysqli_query($conn, $sql) ;
    $qry = "UPDATE requests SET status='finished' WHERE rid='$rid' and username='$username'" ;
    mysqli_query($conn, $qry) ;
  ?>

  <script>
    // Replace 'imageFolderPath' with the path to your local folder containing images.
    const imageFolderPath = 'Annotefiles/'+ '<?php echo $dop;?>' + '/';
    let imageFiles = [];
    let currentImageIndex = 0;

    function fetchImages() {
      fetch(imageFolderPath)
        .then((response) => response.text())
        .then((html) => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const links = Array.from(doc.querySelectorAll('a'));

          imageFiles = links
            .filter((link) => link.href.match(/\.(jpe?g|png|gif)$/i))
            .map((link) => link.href.split('/').pop());

          showImage();
        })
        .catch((error) => {
          console.error('Error fetching images:', error);
        });
    }

    function showImage() {
      const imageContainer = document.getElementById('currentImage');
      imageContainer.src = imageFolderPath + imageFiles[currentImageIndex];
    }

    function onNextClick() {
      const selectedOption = document.querySelector('input[name="options"]:checked');
      if (!selectedOption) {
        alert('Please select an option.');
        return;
      }

      const formData = new FormData();
      formData.append('options', selectedOption.value);

      fetch('process.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Output any response from the PHP script (optional)
      })
      .catch(error => {
        console.error('Error sending data to PHP:', error);
      });

      currentImageIndex++;

      if (currentImageIndex < imageFiles.length) {
        showImage();
        resetOptions();
      } else {
        document.getElementById('imageContainer').style.display = 'none';
        document.getElementById('optionsForm').style.display = 'none';
        document.getElementById('nextButton').style.display = 'none';
        document.getElementById('final').style.display = 'block' ;
        alert('Your response has been recorded. Thanks a lot for collaboration.');
      }
    }

    function resetOptions() {
      const selectedOption = document.querySelector('input[name="options"]:checked');
      if (selectedOption) {
        selectedOption.checked = false;
      }
    }

    document.getElementById('nextButton').addEventListener('click', onNextClick);

    fetchImages();
  </script>
</body>
</html>
