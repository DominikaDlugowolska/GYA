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

        <?php
        if (isset($_POST['title'], $_POST['author'], $_POST['genre'])) {

            // Ta emot filen
            $file = $_FILES['image'];
            var_dump($file);

            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];

            //  Filens namn
            $fileName = $file["name"];
            $fileSize = $file["size"];
            $fileType = $file["type"];
            $fileTempName = $file["tmp_name"];
            $error = $file["error"];

            // Tillåtna filtyper
            $allowed = ["jpeg", "png"];
            

            // Bildens filtyp
            $delar = explode("/", $fileType);
            $imageType = $delar[1];
            var_dump($imageType);

            // Är filen tillåten?
            if (in_array($imageType, $allowed)) {

                // Blev det något felmeddelande?
                if ($error === 0) {
                    
                    // Är filen för stor? eller for liten, whatever
                    if ($fileSize <= 3000000) {
                        
                        // Skapa ett unikt namn
                        $fileNewName = uniqid("", true). "$imageType";

                        // vart filen skall hamna
                        $fileDestination = "bilder/$fileNewName";

                        // Äntligen! Flytta filen in i mappen
                        move_uploaded_file($fileTempName, $fileDestination);
                        echo "<p>Filen är uppladdat </p>";
                        var_dump($fileDestination);
                    } 
                    else {
                        echo "<p>Filen är fööööööör stor!</p>";
                    }
                }else {
                    echo "<p>Något blev fel</p>";
                }
                
            } else {
                echo "<p>Sorry, du får bara ladda upp jpg, png eller gif!.</p>";
            }
             // Sql satsen
            var_dump($fileDestination);
            $sql = "INSERT INTO collection (title, author, genre, image) VALUES ('$title', '$author', '$genre', '$fileTempName')";

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
    