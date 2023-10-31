<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";

if(isset($_REQUEST["msj"])){
    $msj = $_REQUEST["msj"];
    echo '<script>alert("'.$msj.'");</script>';
}
servicio_login::type_account();
$result = servicio_admin::list_books();

echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Libros</title>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
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
                        <a href = '../../controllers/Index_adminController?accion=registrar_libro'>
                            <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Registrar libros</p> 
                        </a>
                </div>
            </div>
            <div class='logout2'><a href = '../../controllers/LoginController?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button></a></div>
        </div>
    </div>
    <div class='welcome'>
        <div class = 'consulta'>
                <form action='resultado_busqueda.php' method='post'>
                    <input type='text' name='texto_busqueda'>
                    <select name='opcion_busqueda'>
                        <option value='nombre'>Nombre</option>
                        <option value='nombre_autor'>Autor</option>
                    </select>
                    <button type='submit'>Buscar</button>
                </form>
            </div>
    </div>

            <div class='contenedor2'>";
foreach ($result as $row_libro) {
    echo "  <div class='libro_content' id = 'datos'>
                <form action='desc_libro.php' method='POST'>
                    <input type='hidden' name='id_libro' value='" . $row_libro->id_libro . "'>
                    <p class='titulo' style='cursor: pointer' ><button type='submit'>" . $row_libro->nombre . "</button></p>
                    <img class='portada' src='../../Assets/" . $row_libro->img_portada . "' title='" . $row_libro->descripcion . "' style='width: 160px; height: 210px; cursor: pointer' onclick='submitForm(\"form-libro-" . $row_libro->id_libro . "\")'><br>
                    <p class='descripcion'>Descripcion: " . $row_libro->descripcion . "</p><br><br>
                    <p class='descripcion'> Autor: " . $row_libro->nombre_autor . "</p>
                    <p class='descripcion'>Stock: " . $row_libro->stock . "</p>
                </form>
                
                <form action='../../controllers/Index_adminController.php' method='POST' style='display: inline-block; margin-right: 15px; margin-left: 15px;'>
                    <input type='hidden' name='id_libro' value='" . $row_libro->id_libro . "'>
                    <button class='prestar' title='Eliminar' type='submit' value='Eliminar' name='accion'> <img src='../../Assets/Images/iconos/eliminar.png'></button>
                    <button class='prestar' title='Editar' type='submit' value='Editar' name='accion'><img src='../../Assets/Images/iconos/editar.png' ></button>
                    <button class='prestar' title='Generar prestamo' type='submit' value='Solicitar_prestamo' name='accion'><img src='../../Assets/Images/iconos/generar_prestamo.png'></button>
                    <button class='prestar' title='Generar entrega' type='submit' value='Generar_entrega name='accion'><img src='../../Assets/Images/iconos/prestamos_libros.png'></button>
                </form>
            </div>";
}
echo "</div>
        </body>
    </html>";
