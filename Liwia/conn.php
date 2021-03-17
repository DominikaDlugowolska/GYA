<?php

$host = "localhost";
$db = "skolbibliotek";
$user = "skolbibliotek";
$pass = "TYRBERqsVwTH1b0I";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Has the connection succeed?
if ($conn->connect_error) {
    die("Couldn't connect: " . $conn->error);
} else {
    echo "<p>The conection succeed.</p>";
}

?>