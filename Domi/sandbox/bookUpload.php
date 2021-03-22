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
    <title>Admin Page</title>
    <link rel="stylesheet" href="./style/admin-styles.css">
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
            <a href="./collection-page.php">Collection</a>
            <a href="#">Log out</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
    </header>
    <main>
        <div class="page-grid">
            <div class="collection-row">
                <div class="title">
                    <h2>Collection</h2>
                </div>
                <div class="wrapper-horizontal-collection">
                    <form action="#" method="post">
                        <?php
                        $sql = "SELECT * FROM books ORDER BY title";
                        //$conn->query($sql) kör koden
                        $result = $conn->query($sql);


                        echo "<div class=\"horizontal-collection\">";


                        while ($row = $result->fetch_assoc()) {
                            echo "<div class=\"row-collection\">";

                            echo "<div><img src=\"$row[cover]\"></div>";

                            echo "<div class=\"book-title\">
                                <h3>$row[title]</h3>
                                <p>$row[author]</p>";

                            echo "</div>";
                            //echo "<button><a href=\"delete-action.php?rn=$row[bookID]\">Delete</p>";
                            echo "<input type=\"checkbox\" name=\"checkedId[]\" value=\"$row[id]\">";
                            echo "</div>";
                        }


                        ?>
                        <button style="margin-top: 20px" type="submit" name="deleteBtn">DELETE</button>
                        <!-- <input style="display: none;" name="deleteBtn" value="DELETE"> -->
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['deleteBtn'])) {

                $book_id = $_POST['checkedId'];


                //if id array is NOT empty
                if (!empty($_POST['checkedId'])) {

                    //convert selected ids into string
                    $idStr = implode(',', $book_id);
                    // Delete from db
                    $delete = "DELETE FROM books WHERE id = '$idStr' ";
                    // Kör koden för att det ska fungera
                    $dResult = $conn->query($delete);



                    //if delete is successful
                    if ($dResult) {
                        echo "<p>Selected books have been deleted</p>";
                    } else {
                        echo "<p>'Something went wrong, please try again'</p>";
                    }
                } else {
                    echo "<p>'Select at least one book to remove from collection'</p>";
                }
                // Stäng ner anslutningen
                $conn->close();
            }
            ?>
        </div>
        <div class="form">
            <h2>Upload new book</h2>
            <div class="form-wrapper">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <label>Title: <input type="text" name="title"></label>
                    <br>
                    <label>Author: <input type="text" name="author"></input></label>
                    <br>
                    <label>Genre: <input type="text" name="genre"></input></label>
                    <br>
                    <label for="image">Image: </label>
                    <input type="file" name="image">
                    <button type="submit" name="submit">SAVE</button>
                </form>
            </div>
        </div>
        </div>
    </main>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

    <?php
    if (isset($_POST['submit'])) {

        // Ta emot filen
        $file = $_FILES["image"];
        //  Filens namn
        $fileName = $file["name"];
        $fileSize = $file["size"];
        $fileType = $file["type"];
        $fileTempName = $file["tmp_name"];
        $error = $file["error"];

        $author = $_POST["author"];
        $title = $_POST["title"];
        // Tillåtna filtyper
        $allowed = ["jpg", "png", "jpeg"];


        // Bildens filtyp
        $delar = explode("/", $fileType);
        $imageType = $delar[1];

        // Är filen tillåten?
        if (in_array($imageType, $allowed)) {

            // Blev det något felmeddelande?
            if ($error === 0) {

                // Är filen för stor? eller for liten, whatever
                if ($fileSize <= 200000) {

                    // Skapa ett unikt namn
                    $fileNewName = uniqid("", true) . "$imageType";

                    // vart filen skall hamna
                    $fileDestination = "photo/$fileNewName";

                    $path = "photo/";
                    // Äntligen! Flytta filen in i mappen
                    move_uploaded_file($fileTempName, $fileDestination);
                    $sql = "INSERT INTO books (title, author, cover) VALUES ('$title', '$author', '$fileDestination')";
                    $conn->query($sql);

                    echo "<p>Filen är uppladdat </p>";
                
                } else {
                    echo "<p>Filen är fööööööör stor!</p>";
                }
            } else {
                echo "<p>Något blev fel</p>";
            }
        } else {
            echo "<p>Sorry, du får bara ladda upp jpg, png eller gif!.</p>";
        }
        $conn->close();
    }
    ?>
    </div>
</body>

</html>