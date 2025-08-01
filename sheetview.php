<?php
@include 'config.php' ;
session_start() ;
if (isset($_GET['file'])) {
    $csvFile = $_GET['file'];
}

if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'] ;
}

$sql = "SELECT * FROM resource WHERE rid='$id'" ;
$res = mysqli_query($conn, $sql) ;
if($res) {
    $row = mysqli_fetch_assoc($res) ;
    $title = $row['name'] ;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $csvFile;?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@9.0.2/dist/handsontable.full.min.css">
  <style>
    body {
        background-image: url('img/bg111.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    h2 {
        color: #ffffff ;
    }

    .down {
        margin: 1250px;
    }
  </style>
</head>
<body>
  <h2><?php echo $title;?></h2>
  <?php
    if (file_exists($csvFile)) {
      echo '<a class ="down" href="' . $csvFile . '" download><image src="img/icons8-export-excel-48.png"></a>';
      $fileContent = file_get_contents($csvFile);
      echo '<div id="csvTable"></div>';

      // Convert CSV content to a JSON array for use in JavaScript
      echo '<script>';
      echo 'var csvData = ' . json_encode(csv_to_array($fileContent)) . ';';
      echo '</script>';
    } else {
      echo '<p>File not found.</p>';
    }

  // Function to convert CSV content to a PHP array
  function csv_to_array($csvString) {
    $lines = explode(PHP_EOL, $csvString);
    $data = array();
    foreach ($lines as $line) {
      $data[] = str_getcsv($line);
    }
    return $data;
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/handsontable@9.0.2/dist/handsontable.full.min.js"></script>
  <script>
    // Display CSV data in a Handsontable table
    const container = document.getElementById('csvTable');
    const hot = new Handsontable(container, {
      data: csvData,
      colHeaders: true,
      rowHeaders: true,
      autoColumnSize: true,
      stretchH: 'all',
      readOnly: true,
    });
  </script>
</body>
</html>
