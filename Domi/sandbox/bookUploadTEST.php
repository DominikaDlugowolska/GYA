<?php

/**
 * 
 * En enkel blogg som använder en databas
 * PHP version 7
 * @category Webbaplikation med databas  
 * @author     Liwia Matuszczak <liwiamatuszczak.@gmail.com>
 * @license    PHP CC
 */
// Update = ändra
// Select, Insert (lägga in), 
// Include är att klistrar in det. Ungefär som css
include "./conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write books</title>
    <link rel="stylesheet" href="./style/collection-styles.css">
    <link rel="stylesheet" href="./style/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css%22%3E">
</head>

<body>
    <header>
        <div>
            <a href="https://www.ntigymnasiet.se/stockholm/"><img id="nti" src="./bilder/nti_logo_svart.svg" alt="nti"></a>
        </div>
        <div class="topnav" id="myTopnav">
            <a href="collection-page.php">Collection</a>
            <a href="collection-page.php" class="active">Collection</a>
            <a href="#">Sing out</a>
            <a href="#">Homepage</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <div class="page-grid">
        <div class="collection">
            <h1>Write new books</h1>
            <form action="#" method="POST" enctype="multipart/form-data">
                <label>Title <input type="text" name="title"></label>
                <label>Author <input type="text" name="author"></label>
                <label for="image">Image</label>
                <input type="file" name="image">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        if (isset($_POST["submit"])) {

            $file = $_FILES["image"]["name"];
            /* $tmpName  = $file['tmp_name'];  */
            //$fileType = $file['type']; // this

            $title = $_POST["title"];
            $author = $_POST["author"];

            /* $delar = explode("/", $fileType);
            $imageType = $delar[1];  //this */

            /* // skapa ett unikt filnamn
            $fileNameNew = uniqid("", true) . ".$imageType"; */
            $uploaddir = "./bilder/";

            /* $fileDestination = $uploaddir . basename($_FILES['image']['name']); //this */

            if (move_uploaded_file($file, $uploaddir)) // this 
            {
                echo "<p>worked perfectly</p>";
            } else {
                echo "<p>didnt work at all</p>";
            }
            // Äntligen! Flytta filen in i mappen


            /* // SQL-satsen
            $sql = "INSERT INTO books (title, author, cover) VALUES ('$title', '$author', '$fileDestination')";

            // Steg 2: Nu kör vi sql-satsen
            $result = $conn->query($sql);

            // Gick det bra att köra SQL-satsen?
            if (!$result) {
                die("Något blev fel med SQL-satsen");
            } else {
                echo "<p class=\"alert alert-success\" role=\"alert\">Inlägget har registrerats</p>";
            }

            
        }
        // Steg 3: Stänga ned anslutningen
        $conn->close(); */
    }


        ?>
    </div>
</body>

</html>