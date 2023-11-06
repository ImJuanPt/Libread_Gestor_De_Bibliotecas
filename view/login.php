<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
verificacion_sesion_controller::redic_valid_login();
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
                        <p>Ingrese los siguientes datos</p>
                            <input placeholder="Cedula" type="number" name="cc" required> <br>
                            <input placeholder="Contraseña" type="password" name="pass" required> <br>
                            <button type="submit" value="Login" name="accion" id="accion"><img src="" alt="">Iniciar sesion</button>
                            <a href="register_user.html"><button type="button">Registrarse</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>