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
            <form action="#" method="POST" nctype="multipart/form-data">
                <label>Title <input type="text" name="title"></label>
                <label>Author <input type="text" name="author"></input></label>
                <label for="image">Image</label>
                <input type="file" name="image">
                <button>Save</button>
            </form>
        </div>

        <?php
        if (isset($_POST['title'], $_POST['author'])) {

            // Ta emot filen
            $file = $_FILES['image'];
            var_dump($file);

            $title = $_POST['title'];
            $author = $_POST['author'];


            //  Filens namn
            $fileName = $file["name"];
            $fileSize = $file["size"];
            $fileType = $file["type"];
            $fileTempName = $file["tmp_name"];
            $error = $file["error"];

            // Tillåtna filtyper
            $allowed = ["jpeg", "png", "jpg"];


            // Bildens filtyp
            $delar = explode(".", $fileType);
            $imageType = $delar[1];
            var_dump($imageType);

            // Är filen tillåten?
            if (in_array($imageType, $allowed)) {

                // Blev det något felmeddelande?
                if ($error === 0) {

                    // Är filen för stor? eller for liten, whatever
                    if ($fileSize <= 3000000) {

                        // Skapa ett unikt namn
                        $fileNewName = uniqid("", true) . "$imageType";

                        // vart filen skall hamna
                        $fileDestination = "bilder/$fileNewName";

                        // Äntligen! Flytta filen in i mappen
                        move_uploaded_file($fileTempName, $fileDestination);
                        echo "<p>Filen är uppladdat </p>";
                        var_dump($fileDestination);

                        // Sql satsen
                        var_dump($fileDestination);
                        $sql = "INSERT INTO books (title, author, cover) VALUES ('$title', '$author', '$fileTempName')";

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
                    } else {
                        echo "<p>Filen är fööööööör stor!</p>";
                    }
                } else {
                    echo "<p>Något blev fel</p>";
                }
            } else {
                echo "<p>Sorry, du får bara ladda upp jpg, png eller gif!.</p>";
            }
        }
        ?>
    </div>
</body>

</html>