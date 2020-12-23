<?php
include "./conn.php";
include "./bookUpload.php";
/* include "./bookUpload.php"; */
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection</title>
    <link rel="stylesheet" href="./style/collection-styles.css">
    <link rel="stylesheet" href="./style/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <a href="#">Collection</a>
                <a href="#">Homepage</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
    </header>
    <main>
        <div class="page-grid">
            <div class="genres">
                <div class="title">
                    <h2>Genres</h2>
                </div>
                <div class="genres-wrapper">
                    <button class="genre" name="thriller">Thriller</button>
                    <button class="genre" name="horror">Horror</button>
                    <button class="genre" name="romance">Romance</button>
                    <button class="genre" name="drama">Drama</button>
                    <button class="genre" name="sciFi">Sci-fi</button>
                </div>
            </div>
            <div class="collection">
                <div class="title">
                    <h2>Collection</h2>
                </div>
                
                    <?php

                    echo "<div>";
                    
                    $sql = "SELECT * FROM collection";
                    $result = $conn->query($sql);

                    // Check if everything went alright
                    if (!$result) {
                        die("Something went wrong with SQL: " . $conn->error);
                    } else {
                        echo "<p>Found " . $result->num_rows . " uploaded books.</p>";
                    }
                    echo "</div>";

                    echo "<div class=\"book-card-wrapper\">";
                    
                    while ($row = $result->fetch_assoc()) {
                    echo "<div class=\"book-card-holder\">";
                    echo "<div class=\"book-card\">";
                    echo "<div><img src=\"$row[image]\"></div>";
                    
                    echo "<div class=\"book-title\">
                            <h3>$row[title]</h3>
                            <p>$row[author]</p>";
                    echo "</div>";
                    echo "<button></button>";
                    echo "</div>";
                    echo "</div>";
                    }
                    echo "</div>";
                    ?>
            
            </div>
            <div class="request-book">
                <div class="title">
                    <h2>Request book</h2>
                </div>
                <div class="request-wrapper">
                    <button class="genre">Thriller</button>
                    <button class="genre">Horror</button>
                    <button class="genre">Romance</button>
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
</body>
</html>