<?php
    session_start() ;
    @include 'config.php' ;
    $username = $_SESSION['username'] ;
    $sql = "SELECT * FROM requests WHERE username='$username' and (status='accepted' or status='pending')";
    $res = mysqli_query($conn, $sql) ;

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr data-id='" . $row['rid'] . "'>";
        echo "<td>" . $row['rid'] . "</td>";
        $rid = $row['rid'] ;
        $qry = "SELECT * FROM resource WHERE rid='$rid'" ;
        $res1 = mysqli_query($conn, $qry) ;
        if($res1) {
            $roww = mysqli_fetch_assoc($res1) ;
        }
        echo "<td>" . $roww['name'] . "</td>";
        echo "<td><h5>" . $row['status'] . "</h5>";
        echo "</td></tr>" ;
    }
?>