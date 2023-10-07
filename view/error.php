<?php
$msj = @$_REQUEST["msj"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>

    </head>
    <body>
        <center>
            <h1>MENSAJE</h1>
            <hr>
            <span style="color: red;"><?= ($msj != NULL || isset($msj)) ? $msj : ""  ?></span>
        </center>
    </body>
</html>