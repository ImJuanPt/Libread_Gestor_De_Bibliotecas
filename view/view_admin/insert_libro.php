<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
if(isset($_REQUEST["msj"])){
    $msj = $_REQUEST["msj"];
    echo '<script>alert("'.$msj.'");</script>';
}

echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Perfil</title>
        <link rel='stylesheet' type='text/css' href='../../Assets/Css/style_insertLibro.css'>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='../../Assets/JS/script_pass.js'></script>
        <script src='../../Assets/JS/script.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../Assets/Css/style_index.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_libros.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_vistas.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <meta http-equiv='Cache-Control' content='no-cache, must-revalidate'>
    </head>
        <body>
        <div class='content'>
            <div class='logo'>
                <img src='../../assets/Images/Logo/image-removebg-preview.png'>
            </div>
            <div class='container-nav'>
                <div class='nav'>
                        <a href = '../../controllers/Index_adminController.php?accion=Perfil'>
                            <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Perfil</p> 
                        </a>
                </div>
                    <div class='nav'>
                        <a href = '../../controllers/Index_adminController.php?accion=index_admin'>
                            <img src='../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Libros</p> 
                        </a>
                    </div>
                <div class='nav'>
                        <a href = '../../controllers/LoginController?accion=registrar_libro'>
                            <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Registrar libros</p> 
                        </a>
                </div>
            </div>
            <div class='logout2'><a href = '../../controllers/LoginController?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button></a></div>
        </div>
    </div>
            <div class='contenedor'>";
             echo "<div class='libro_content_insert' id = 'datos'>
             <form action='../../controllers/index_adminController.php' method='post' enctype='multipart/form-data'>
             <label class='labe' for='nombre'>Nombre</label>
             <input class='labe' type='text' name='nombre' required>
             <label class='labe' for='desc'>Descripcion</label>
             <input class='labe' type='text' name='desc' required>
             <label class='labe' for='autor'>Autor</label>
             <input class='labe' type='text' name='autor' required>
             <label class='labe' for='stock'>Stock</label>
             <input class='labe' type='number' name='stock' required><br>
             <label class='checkbx'>Seleccione uno o varios generos:</label>
             <div class='contenedor_checkbox'>";
                 $i = 0;
                 $generos = servicio_admin::list_gender();
                 foreach ($generos as $row) {
                   if ($i % 5 == 0) {
                     echo "<div class='columna_chck'>";
                   }
                   echo "<div><label style = 'cursor: pointer'><input class='checkbox' type='checkbox' name='generos[]' value='".$row->id_genero."'>".$row->nombre_genero."</label></div>";
                   $i++;
                   if ($i % 5 == 0) {
                     echo '</div>';
                   }
                 }
     echo"    </div>
     </div>
             <label class='labe' for='nombre'>Portada</label>
             <img class='imagen_register' id='vista-previa' src='#' alt='Vista previa de imagen' style='display: none; width: 112px; margin-rigth: 100%;'><br>
             <input type='file' name='imagen' id='imagen' accept='image/*' required>
             <button value = 'registrar_libro_insert' name = 'accion' class='labe' id='btn_registrar' type='submit' class='btn btn-primary'>
                 Registrar libro
             </button>
         </form>
                    </div>";
      echo "</div>
        </body>
</html>
";
