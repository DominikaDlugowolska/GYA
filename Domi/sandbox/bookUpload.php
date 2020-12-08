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
                <a href="https://www.ntigymnasiet.se/stockholm/"><img id="nti" src="./bilder/nti_logo_svart.svg"
                        alt="nti"></a>
            </div>
            <div class="topnav" id="myTopnav">
                <a href="#" class="active">Collection</a>
                <a href="bookUpload.php">Upload</a>
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
            <form action="#" method="POST">
                <label>Title <input type="text" name="title"></label>
                <label>Author <input type="text" name="author"></input></label>
                <label for="image">Image</label>
                <input type="file" name="image">
                <button>Save</button>
            </form>
        </div>
        <?php
        /* // This is the directory where images will be saved
        $target = "./book-images";
        $target = $target . basename($_FILES['image']); */

        // Ta emot det som skickas
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        /* $pic = ($_FILES['image']); */


        // Om data finns...
        if ($title && $author) {
            // mysql -> insert -> runrik och text -> copy php code
            // Sql satsen
            $sql = "INSERT INTO collection (title, author) VALUES ('$title', '$author')";

            /* // Var filen skall hamna
            $target = "./book-images/$pic";

            // Äntligen! Flytta filen in i mappen
            move_uploaded_file($pic, $target); */


            // Steg 2: nu kör vi sql-saten
            $result = $conn->query($sql);

            // Gick det bra att köra sql-satsen
            if (!$result) {
                die("There is something wrong with SQL-set" . $conn->error);
            } else {
                echo "<p>The post has been succesfully registred</p>";
            }

            // Steg 3: Stänga ned anslutningen
            $conn->close();
        }
        ?>
    </div>
</body>

</html>