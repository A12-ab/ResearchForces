<?php
@include 'config.php' ;
session_start() ;
$dop = $_SESSION['dop'] ;
$resc = $_SESSION['resc'] ;

$txtfile = 'Annotefiles/' . $dop . '/response'.$resc.'.csv' ;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["options"])) {
    $option = $_POST["options"];
    echo 'ok';
    $csvFilePath = $txtfile; 
    
    $csvData = array($option);
    $csvRow = implode(',', $csvData);
    
    $file = fopen($csvFilePath, 'a');
    if ($file) {
        fwrite($file, $csvRow . PHP_EOL);
        fclose($file);
    } 
} 
?>