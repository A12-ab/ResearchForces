<?php
@include 'config.php' ;
if(isset($_POST['cellData'])) {
    $reqid = $_POST['cellData'] ;
    $sql = "UPDATE requests SET status='accepted' WHERE reqid='$reqid'" ;
    mysqli_query($conn, $sql) ;
}
?>