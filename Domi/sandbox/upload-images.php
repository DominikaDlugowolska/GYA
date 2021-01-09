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
                <input type="file" name="lakasa">
                <button type="submit" name="submit">UPLOAD</button>
            </form>
        </div>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $target_dir = "bilder/";
        $target_file = $target_dir . $_FILES["lakasa"]["name"];

        if (isset($_POST["submit"])) {
            if (move_uploaded_file($_FILES["lakasa"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["lakasa"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
        }
        phpinfo();

        ?>
    </div>
</body>

</html>