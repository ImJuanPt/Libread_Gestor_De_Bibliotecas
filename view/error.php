<?php
$msj = @$_REQUEST["msj"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../Assets/Css/style_login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;1,400&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="container">
            <div>
        </div>
        <div class="container-login">
            <div class="container-logo">
                <div class="titulo">
                    <p>Iniciar sesión</p>
                </div>
               <a href="index.html"><img src="../Assets/Images/Logo/image-removebg-preview.png" alt=""></a> 
            </div>
            <form action="../controllers/LoginController.php" method="post">
                <div class="container-form">
                    <div class="register_camp">
                        <p><?= $msj ?></p>
                        <a href="login.php"><button type="button">Volver</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>