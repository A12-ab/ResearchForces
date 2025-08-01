<?php
    @include 'config.php' ;
    $sql = "SELECT * FROM resource WHERE type='survey' ";
    $res = mysqli_query($conn, $sql) ;

    while ($row = mysqli_fetch_assoc($res)) {
        echo "<tr data-id='" . $row['rid'] . "'>";
        echo "<td>" . $row['rid'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><h5>" . $row['author'] . "</h5><h5>" . $row['subtype'] . "</h5></td>";
        echo "</tr>";
    }
?>