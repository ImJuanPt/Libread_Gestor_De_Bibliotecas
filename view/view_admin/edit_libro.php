<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Autor.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";

if(isset($_REQUEST["id_libro"])){
    $id = $_REQUEST["id_libro"];
    $book = service_Libro::find_book($id);
    $autor = service_Autor::findAutor($book->id_autor);
}
verificacion_sesion_controller::redic_valid_login();
$result = service_Libro::list_books();

echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Libros</title>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <script src='../../Assets/JS/script.js'></script>
        <link rel='stylesheet' href='../../Assets/Css/style_index.css'>
        <link rel='stylesheet' type='text/css' href='../../Assets/Css/style_insertLibro.css'>
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
                <div class='logout2'><a href = '../../controllers/UsuarioController.php?accion=Logout'>
                    <button><img src='../../Assets/Images/Botones/salir.png' ></button></a></div>
                </div>
            </div>
            <div class='contenedor'>
                <div class='libro_content_insert' id = 'datos'>
                    <form action='../../controllers/LibroController.php' method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='id_libro' value='".$book->id_libro."'>
                        <label class='labe' for='nombre'>Nombre</label>
                        <input class='labe' type='text' name='nombre' value = '".$book->nombre."' required>
                        <label class='labe' for='desc'>Descripcion</label>
                        <input class='labe' type='text' name='desc' value = '".$book->descripcion."' required>
                        <label class='labe' for='autor'>Autor</label>
                        <input class='labe' type='text' name='autor' value = '".$autor->nombre_autor."' required>
                        <label class='labe' for='stock'>Stock</label>
                        <input class='labe' type='number' name='stock' value = '".$book->stock."' required><br>
                        <label class='checkbx'>Seleccione uno o varios geneross:</label>
                        <div class='contenedor_checkbox'>";
                                $generos_libro = service_Genero::list_gender_on_book($book->id_libro); // array para almacenar los nombres de los géneros que tiene el libro
                                $result_generos = service_Genero::list_gender();
                                $i = 0;
                                foreach ($result_generos as $row_generos) {
                                    if ($i % 5 == 0) {
                                        echo "<div class='columna_chck'>";
                                    }
                                    $checked = (count(array_intersect($generos_libro, array($row_generos->nombre_genero))) > 0) ? "checked" : "";
                                    echo "<div>
                                            <label style='cursor: pointer'><input class='checkbox' type='checkbox' name='generos[]' value='" . $row_generos->id_genero . "' $checked>" . $row_generos->nombre_genero . "</label></div>";
                                    $i++;
                                    if ($i % 5 == 0) {
                                    echo "</div>";
                                    }
                                }
                                echo "
                                    </div>
                        </div>  
                        <label class='labe' for='nombre'>Portada</label>
                        <img class='imagen_register' id='vista-previa' src='#' alt='Vista previa de imagen' style='display: none; width: 112px; margin-rigth: 100%;'><br>
                        <input type='file' name='imagen' id='imagen' accept='image/*'>
                        <button name = 'accion' value = 'Editar_insert' class='labe' id='btn_registrar' type='submit' class='btn btn-primary'>
                            Editar libro
                        </button>
                    </form>
                </div>
            </div>
        </body>
</html>
";

if(isset($_REQUEST["msj"])){
    $msj = $_REQUEST["msj"];
    echo '<script>alert("'.$msj.'");</script>';
}

