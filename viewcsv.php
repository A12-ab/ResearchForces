<?php
session_start();
@include 'config.php';
$dop = 0 ;
$id = 0 ;
if(isset($_SESSION['dop'])) {
    $dop = $_SESSION['dop'] ;
}
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'] ;
}
// Function to read the data from a CSV file and return as an array
function readCSV($filename) {
    $data = [];
    if (($handle = fopen($filename, "r")) !== false) {
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            $data[] = $row[0];
        }
        fclose($handle);
    }
    return $data;
}

// Function to merge the CSV files into one
function mergeCSVFiles() {
    $dop = 0 ;
    if(isset($_SESSION['dop'])) {
        $dop = $_SESSION['dop'] ;
    }

    $folderPath = "Annotefiles/".$dop; // Replace this with the actual folder path
    $outputFilePath = "Annotefiles/".$dop."/Final.csv" ;
    $mergedData = [];

    // Get a list of CSV files in the folder
    $csvFiles = glob($folderPath . "/*.csv");

    // Read data from each CSV file and store it in the mergedData array
    foreach ($csvFiles as $csvFile) {
        $csvData = readCSV($csvFile);
        $fileName = pathinfo($csvFile, PATHINFO_FILENAME);
        $mergedData[$fileName] = $csvData;
    }

    // Determine the maximum number of rows in any CSV file
    $maxRows = max(array_map('count', $mergedData));

    // Write the data to the new merged CSV file with column headings
    $fileHandle = fopen($outputFilePath, 'w');
    fputcsv($fileHandle, array_keys($mergedData));

    for ($i = 0; $i < $maxRows; $i++) {
        $rowData = [];
        foreach ($mergedData as $data) {
            $rowData[] = isset($data[$i]) ? $data[$i] : '';
        }
        fputcsv($fileHandle, $rowData);
    }

    fclose($fileHandle);
}

$id = 0 ;
if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'] ;
    $_SESSION['id'] = $id ;
}
$sql = "SELECT * FROM resource WHERE rid='$id'" ;
$res = mysqli_query($conn, $sql) ;
if($res) {
    $row = mysqli_fetch_assoc($res) ;
    $fileprepared = $row['finalcsvprepared'] ;
    if($fileprepared==1) {
        $showmcsv = 1 ;
    } 
}
if(isset($_POST['merge'])) {
    mergeCSVFiles() ;
    $showmcsv = 1 ;
    $sql = "UPDATE resource set finalcsvprepared=1 where rid='$id'" ;
    mysqli_query($conn, $sql) ;
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Responses of <?php echo $id;?></title>
  <style>
    body {
        background-image: url('img/bg111.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    h2 {
        color: #ffffff ;
    }
    
    .container {
        background: #ffffff2d ;
        width: 400px ;
        height: 500px ;
        margin-left: 450px ;
        margin-top: 70px ;
        padding-left: 50px ;
        padding-top: 20px ;
        border-radius: 30px ;
    }
    a {
        text-decoration: none ;
        color: #ffffff ;
    }
  </style>
</head>
<body>
  <div class="container">
  <h2>List of Response files:</h2>
    <?php
    $folderPath = 'Annotefiles/'.$dop; // Replace this with the actual folder path
    $csvFiles = glob($folderPath . '/*.csv');

    if (count($csvFiles) > 0) {
        echo '<ul>';
        foreach ($csvFiles as $csvFile) {
        echo '<li><a href="csvview.php?file=' . urlencode($csvFile) . '" target="_blank">' . basename($csvFile) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No CSV files found in the folder.</p>';
    }
    ?>
    <br>
    <br>
    <br>
    <?php if(!isset($showmcsv)) {echo '<form action="" method="post">
        <button name="merge">prepare final report</button>
    </form>'; }?>
  </div>
</body>
</html>