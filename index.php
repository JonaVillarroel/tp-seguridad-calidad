<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>On Wall</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css"></link>
        <link rel="stylesheet" type="text/css" href="css/main.css"></link>
    </head>

    <body>
        <div class="bg" id="wrapper">

            <?php
            include_once (__DIR__."/templates/header.php");
            ?>

            <div class="container" id="content">
                <?php
                    if(($_SESSION["usuario"])){
                        include_once (__DIR__."/templates/wall.php");
                    }else{
                        include_once (__DIR__."/templates/welcome.php");
                    }
                ?>
            </div>

            <?php
            include_once (__DIR__."/templates/footer.php");
            ?>

            <?php
            include_once (__DIR__."/templates/modalLogin.php");
            ?>

            <?php
            include_once (__DIR__."/templates/modalSignUp.php");
            ?>
        </div>

        <script src="lib/jquery-ui/external/jquery/jquery.js"></script>
        <script src="lib/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>