<?php
 session_start();
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Libro.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/service_Genero.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
 
 verificacion_sesion_controller::redic_valid_login();
 $id_libro = isset($_REQUEST["id_libro"]) ? $_REQUEST["id_libro"] : "";
 $row_libro = service_Libro::find_book($id_libro);
 $generos = service_Genero::gender_book($id_libro);
 echo "
     <!DOCTYPE html>
     <html>
     <head>
         <meta charset='UTF-8'>
         <title>Perfil</title>
         <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
         <script src='../../Assets/JS/script_pass.js'></script>
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
                 <img src='../../Assets/Images/Logo/image-removebg-preview.png'>
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
        <div class='contenedor3'>";
         echo "<div class='libro_content'>
                    <input type='hidden' name='id_libro' value='".$row_libro->id_libro."'><p class='titulo'>".$row_libro->nombre."</p>
                            <img class='portada' src='../../Assets/".$row_libro->img_portada."' title='".$row_libro->descripcion."' style='width: 160px; height: 210px;'><br>
                            <p class='descripcion'>Descripcion: ".$row_libro->descripcion."</p><br><br>
                            <p class='descripcion'> Autor: ".$row_libro->nombre_autor."</p>
                            <p class='descripcion'>Stock: ".$row_libro->stock."</p>
                            <p class='descripcion'>Fecha de publicacion: ".$row_libro->fecha_publicacion."</p>
                            <p class='descripcion'>Generos: ".$generos."</p>
                </div>";
      echo "</div>
        </body>
    </html>";
?>