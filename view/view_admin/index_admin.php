<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

if(isset($_REQUEST["msj"])){
    $msj = $_REQUEST["msj"];
    echo '<script>alert("'.$msj.'");</script>';
}
verificacion_sesion_controller::redic_valid_login();
$result = service_Libro::list_books();

echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Libros</title>
        <script src='../../Assets/JS/script.js'></script>
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
                        <a href = '../../controllers/UsuarioController.php?accion=Perfil'>
                            <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Perfil</p> 
                        </a>
                </div>
                    <div class='nav'>
                        <a href = '../../controllers/UsuarioController.php?accion=Index'>
                            <img src='../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Libros</p> 
                        </a>
                    </div>
                <div class='nav'>
                        <a href = '../../controllers/LibroController.php?accion=registrar_libro'>
                            <img src='../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                            <p>Registrar libros</p> 
                        </a>
                </div>
            </div>
            <div class='logout2'><a href = '../../controllers/UsuarioController.php?accion=Logout'><button><img src='../../Assets/Images/Botones/salir.png' ></button></a></div>
        </div>
    </div>
    <div class='welcome'>
        <div class = 'consulta'>
                <form action='index_resp_busqueda.php' method='post'>
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
                    <p class='titulo' style='cursor: pointer' ><button class='boton_titulo' type='submit'>" . $row_libro->nombre . "</button></p>
                    <button type='submit'><img class='portada' src='../../Assets/" . $row_libro->img_portada . "' title='" . $row_libro->descripcion . "' style='width: 160px; height: 210px; cursor: pointer')'></button><br>
                    <p class='descripcion'>Descripcion: " . $row_libro->descripcion . "</p><br><br>
                    <p class='descripcion'> Autor: " . $row_libro->nombre_autor . "</p>
                    <p class='descripcion'>Stock: " . $row_libro->stock . "</p>
                </form> 
                
                <form id='eliminarForm' action='../../controllers/LibroController.php' method='POST' style='display: inline-block; margin-right: 15px; margin-left: 15px;'>
                    <input type='hidden' name='id_libro' value='" . $row_libro->id_libro . "'>
                    <button class='libroCrud' title='Eliminar' type='submit' value='Eliminar' name='accion' onclick='return confirmAction()'> <img src='../../Assets/Images/iconos/eliminar.png'></button>
                    <button class='libroCrud' title='Editar' type='submit' value='Editar' name='accion'><img src='../../Assets/Images/iconos/editar.png' ></button>
                </form>
                <form action='../../controllers/PrestamoController.php' method='POST' style='display: inline-block; margin-right: 15px; margin-left: 15px;'>
                    <input type='hidden' name='id_libro' value='" . $row_libro->id_libro . "'>
                    <button class='prestar' title='Generar prestamo' type='submit' value='Solicitar_prestamo' name='accion'><img src='../../Assets/Images/iconos/generar_prestamo.png'></button>
                    <button class='prestar' title='Generar entrega' type='submit' value='lista_prestamos' name='accion'><img src='../../Assets/Images/iconos/prestamos_libros.png'></button>
                </form>
            </div>";
}
echo "</div>
        </body>
    </html>";
?>

















































































<html>
<script>
    function confirmAction() {
        return confirm("¿Estás seguro de que deseas eliminar este libro?");
    }
</script>
</html>

    
