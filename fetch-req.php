<?php
    session_start() ;
    @include 'config.php' ;
    $username = $_SESSION['username'] ;
    $sql = "SELECT * FROM resource INNER JOIN requests ON resource.rid = requests.rid WHERE resource.author = '$username' and requests.status='pending' ";
    $res = mysqli_query($conn, $sql) ;

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr data-id='" . $row['reqid'] . "'>";
        echo "<td>" . $row['reqid']. "</td>" ;
        echo "<td>" . $row['rid'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><h5>" . $row['username'] . "</h5>";
        echo "<input type='button' value='Accept' id='accept' class='accept' />" ;
        echo "</td></tr>" ;
    }
?>