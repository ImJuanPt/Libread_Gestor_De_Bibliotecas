<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";


$msj = @$_REQUEST["msj"];
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
$result = service_Libro::list_books();
echo "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../Assets/Css/style_index.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_libros.css'>
        <link rel='stylesheet' href='../../Assets/Css/style_vistas.css'>
    <title>Libread</title>
    <script src='script.js'></script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body>
    <div class='content'>
        <div class='logo'>
            <img src='../../assets/Images/Logo/image-removebg-preview.png'>
        </div>
        <div class='container-nav'>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/UsuarioController.php?accion=Perfil'>
                    <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Perfil</p> 
                </a>
            </form>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/LibroController.php?accion=listado_libros_usuario'>
                    <img src='../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Libros</p> 
                </a>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/PrestamoController.php?accion=prestamos_usuario'>
                    <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Prestamos</p> 
                </a>
                </form>
            </div>
            <div class='nav'>
                <a style='cursor: pointer' href = '../../controllers/PrestamoController.php?accion=devoluciones_usuario'>
                    <img src='../../Assets/Images/Botones/devolucion.png' style = 'margin: auto;margin-left: 55%;'>
                    <p>Devoluciones</p> 
                </a>
            </form>
            </div>
            <div class='logout'><a href = '../../controllers/UsuarioController.php?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button><a></div>
        </div>
    </div>
    <div class='home'>
            <a style='cursor: pointer' href = 'index.php'>
                <img src='../../Assets/Images/Botones/separador.png' style = 'margin: auto;margin-left: 55%;'>
            </a>
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
             echo "<div class='libro_content'>
                       <form action='desc_libro_user.php' method='POST'>
                            <input type='hidden' name='id_libro' value='" . $row_libro->id_libro . "'>
                            <p class='titulo' style='cursor: pointer' ><button class='boton_titulo' type='submit'>" . $row_libro->nombre . "</button></p>
                            <button type='submit'><img class='portada' src='../../Assets/" . $row_libro->img_portada . "' title='" . $row_libro->descripcion . "' style='width: 160px; height: 210px; cursor: pointer')'></button><br>
                            <p class='descripcion'>Descripcion: " . $row_libro->descripcion . "</p><br><br>
                            <p class='descripcion'> Autor: " . $row_libro->nombre_autor . "</p>
                            <p class='descripcion'>Stock: " . $row_libro->stock . "</p>
                            <button class='prestar'> <img src='../../Assets/Images/Botones/agregar.png'd></button>
                        </form>
                    </div>";
            }
    
      echo "</div>
        </body>
    </html>";
?>