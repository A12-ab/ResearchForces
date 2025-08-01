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
    <title>CSV File Viewer</title>
    <style>
        body {
            background-image: url('img/bg111.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
        table {
            background-color: #ffffff2d ;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 50px ;
            padding-right: 50px ; 
            border-color: #ffffff ;
            border-radius: 50px ;
        }
        th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            width: 30px; /* Set the fixed width for the columns */
        }
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            width: 30px; /* Set the fixed width for the columns */
            color: #ffffff ;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            color: #ffffff ;
        }
        .down {

        }
    </style>
</head>
<body>
    <h1>CSV File Viewer</h1>
    <a class ="down" href="<?php echo $csvFile;?>" download><image src="img/icons8-export-excel-48.png"></a>
    <table>
        <?php
        $csvFilePath = $csvFile;
        if (($handle = fopen($csvFilePath, 'r')) !== false) {
            $rowCounter = 0;
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                echo '<tr>';
                $cellTag = ($rowCounter === 0) ? 'th' : 'td';
                foreach ($data as $cellData) {
                    echo "<$cellTag>$cellData</$cellTag>";
                }
                echo '</tr>';
                $rowCounter++;
            }
            fclose($handle);
        } else {
            echo 'Error: Unable to open the CSV file.';
        }
        ?>
    </table>
</body>
</html>