<?php

/**
 * PHP version 7
 * @category   
 * @author     Liwia Matuszczak <liwiamatuszczak.@gmail.com>
 * @license    PHP CC
 */
?>
<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="request-book">
        <div class="title">
            <h2>Request book</h2>
        </div>
        <div class="request-wrapper">
            <form method="post" name="myemailform" action="book-request.php"> Enter a book you wish at our library
                <label for="name">Enter books title</label>
                <input type="text" name="name" > 

                <label for="author">Enter books author</label>
                <input type="text" name="author">

                <input type="submit" value="Send Form">
            </form>
        </div>
    </div>

    <?php


    ?>
</body>

</html>