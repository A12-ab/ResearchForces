<?php
    session_start() ;
    @include 'config.php' ;
    $username = $_SESSION['username'] ;
    $sql = "SELECT * FROM resource WHERE author='$username' ";
    $res = mysqli_query($conn, $sql) ;

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr data-id='" . $row['rid'] . "'>";
        echo "<td>" . $row['rid'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><h5>" . $row['type'] . "</h5><h5>" . $row['rescount'] . " responsed</h5></td>";
        echo "</tr>";
    }
?>