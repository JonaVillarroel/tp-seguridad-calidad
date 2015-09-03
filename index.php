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
        <div>

            <?php
            include_once (__DIR__."/templates/header.php");
            ?>

            <div class="container">
            <h4>Mi Wall</h4>
            <div>
                <div class="col-md-2"><img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle" width="40%"/></div>
                <div class="col-md-10"><textarea class="form-control" id="feedbox" rows="3" placeholder="Publica un mensaje!"></textarea><br>
                    <button type="button" id="button" class="btn btn-default">Publicar</button>
                </div>
            </div>

            <div class="row publication" >
                <div class="col-md-2"><img src="http://7-themes.com/data_images/out/60/6976065-dark-colors-abstract.jpg" class="img-circle" width="40%"/></div>
                <div class="col-md-10">
                    <div><b>Lucas Rodríguez </b>

                        <div>Hola Laura!</div>
                        <div class="text-muted"> <small>Hace 1 hora</small></div>
                    </div>
                </div>
            </div>

            <div class="row publication">
                <div class="col-md-2"><img src="http://packetcode.com/apps/wall-design/image.jpg" class="img-circle" width="40%"/></div>
                <div class="col-md-10">
                    <div><b>Laura Gutierrez </b>

                        <div>Primera publicación</div>
                        <div class="text-muted"> <small>Hace 3 horas</small></div>
                    </div>
                </div>
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


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/main.js"></script>
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>