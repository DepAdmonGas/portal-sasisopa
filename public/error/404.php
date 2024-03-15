<?php 
require('app/help.php');

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=RUTA_CSS2;?>bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <title>Portal SASISOPA</title>
    <script>
        function Regresar(){
            window.history.back();  
        }
    </script>
</head>
<body style="background-color: #5d84c3;">

    <div class="container p-4">
        <div class="p-4 bg-white">

            <div class="row">
                <div class="col-12 col-sm-6">

                <div class="text-center">
                <img src="<?=RUTA_IMG_LOGOS;?>Logo.png" width="250px">
                <p class="fs-2 p-4">Error al encontrar la página que está buscando</p>                
                </div>

                <div class="text-center"><button type="button" class="btn btn-outline-primary" onclick="Regresar()">Regresar a la página anterior</button></div>

                </div>
                <div class="col-12 col-sm-6"></div>
            </div>

        </div>
    </div>

    <script src="<?=RUTA_JS2 ?>bootstrap.min.js"></script>

</body>
</html>