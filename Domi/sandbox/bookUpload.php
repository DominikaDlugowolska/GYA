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
    <div class="kontainer">
        <h1>Write new books</h1>
        <form action="#" method="POST">
            <label>Title <input type="text" name="title"></label>
            <label>Author <input type="text" name="author"></input></label>
            <label for="image">Image</label>
            <input type="hidden" name="size" value="350000">
            <input type="file" name="image">
            <button>Save</button>
        </form>
        <?php
        // This is the directory where images will be saved
        $target = "./book-images";
        $target = $target . basename($_FILES['image']['name']);

        // Ta emot det som skickas
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
        $pic = ($_FILES['image']['name']);


        // Om data finns...
        if ($title && $author && $pic) {
            // mysql -> insert -> runrik och text -> copy php code
            // Sql satsen
            $sql = "INSERT INTO collection (title, author) VALUES ('$title', '$author', '$pic')";

            // Writes the photo to the server
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {

                // Tells you if its all ok
                echo "The file " . basename($_FILES['uploadedfile']['name']) . " has been uploaded, and your information has been added to the directory";
            } else {
                // Gives and error if its not
                echo "Sorry, there was a problem uploading your file.";
            }

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