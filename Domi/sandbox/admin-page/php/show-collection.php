<?php
include "../conn.php";
    $sql = "SELECT * FROM books ORDER BY title";
    $result = $conn->query($sql);

    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
     echo "<p$data[0]</p>";
?>