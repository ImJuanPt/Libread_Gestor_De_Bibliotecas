<?php
 session_start();
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Genero.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
 
 servicio_login::type_account();
 $u = servicio_login::validate_login();
 $id_libro =  $_REQUEST["id_libro"];
 $row_libro = servicio_admin::find_book($id_libro);
 $generos = servicio_admin::gender_book($id_libro);
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
                 <img src='../../assets/Images/Logo/image-removebg-preview.png'>
             </div>
             <div class='container-nav'>
                 <div class='nav'>
                         <a href = '../../controllers/LoginController?accion=Perfil'>
                             <img src='../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                             <p>Perfil</p> 
                         </a>
                 </div>
                     <div class='nav'>
                         <a href = '../../controllers/LoginController?accion=lista_libro'>
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
                    <input type='hidden' name='id_libro' value='".$row_libro[0]->id_libro."'><p class='titulo'>".$row_libro[0]->nombre."</p>
                            <img class='portada' src='../".$row_libro[0]->img_portada."' title='".$row_libro[0]->descripcion."' style='width: 160px; height: 210px;'><br>
                            <p class='descripcion'>Descripcion: ".$row_libro[0]->descripcion."</p><br><br>
                            <p class='descripcion'> Autor: ".$row_libro[0]->nombre_autor."</p>
                            <p class='descripcion'>Stock: ".$row_libro[0]->stock."</p>
                            <p class='descripcion'>Fecha de publicacion: ".$row_libro[0]->fecha_publicacion."</p>
                            <p class='descripcion'>Generos: ".$generos."</p>
                </div>";
      echo "</div>
        </body>
    </html>";
?>