<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/controllers/verificacion_sesion_controller.php";
if(isset($_SESSION["lista.prestamos.busqueda"])){
    $lista_prestamos = $_SESSION["lista.prestamos.busqueda"];
    $lista_prestamos = unserialize($lista_prestamos);
}else{
    $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/controllers/PrestamoController.php?accion=null";
    header("Location: $urlBase");
    exit;
}
verificacion_sesion_controller::redic_valid_login();
$u = unserialize($_SESSION["usuario.login"]);
echo "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Perfil</title>
        <link rel='stylesheet' type='text/css' href='../../../Assets/Css/style_insertLibro.css'>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='../../../Assets/JS/script_pass.js'></script>
        <script src='../../../Assets/JS/script.js'></script>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href='../../../Assets/Css/style_index.css'> 
        <link rel='stylesheet' href='../../../Assets/Css/style_tabla_entrega_libro.css'>
        <link rel='stylesheet' href='../../../Assets/Css/style_libros.css'>
        <link rel='stylesheet' href='../../../Assets/Css/style_vistas.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        <meta http-equiv='Cache-Control' content='no-cache, must-revalidate'>
    </head>
        <body>
        <div class='content'>
            <div class='logo'>
                <img src='../../../assets/Images/Logo/image-removebg-preview.png'>
            </div>
                <div class='container-nav'>
                    <div class='nav'>
                            <a href = '../../../controllers/UsuarioController.php?accion=Perfil'>
                                <img src='../../../Assets/Images/Botones/perfil.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Perfil</p> 
                            </a>
                    </div>
                        <div class='nav'>
                            <a href = '../../../controllers/UsuarioController.php?accion=Index'>
                                <img src='../../../Assets/Images/Botones/libro.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Libros</p> 
                            </a>
                        </div>
                    <div class='nav'>
                            <a href = '../../../controllers/LibroController.php?accion=registrar_libro'>
                                <img src='../../../Assets/Images/Botones/prestamo.png' style = 'margin: auto;margin-left: 55%;'>
                                <p>Registrar libros</p> 
                            </a>
                    </div>
                </div>
                <div class='logout2'><a href = '../../../controllers/UsuarioController.php?accion=Logout'>
                    <button><img src='../../../Assets/Images/Botones/salir.png' ></button></a>
                </div>
            </div>
        </div>
        <div class='welcome'>
        <div class = 'consulta'>
                <form action='../../../controllers/PrestamoController.php' method='post'>
                    <input type='text' name='texto_busqueda'>
                    <select name='opcion_busqueda'>
                        <option value='cedula'>Cedula</option>
                        <option value='nombre'>Nombre</option>
                    </select>
                    <button name = 'accion' value = 'busqueda_prestamos' type='submit'>Buscar</button>
                </form>
            </div>
    </div>
        <div class='contenedor2'>
        <table class='rwd-table' style = 'margin-left: 45px;'>
        <tr>
            <th>Nombre prestador</th>
            <th>Cedula</th>
            <th>Nombre libro</th>
            <th>Autor</th>
            <th>Fecha prestamo</th>
            <th>Fecha max entrega</th>
            <th>Estado de prestamo</th>
            <th>Entregar libro</th>
        </tr>";

    if($lista_prestamos){
    foreach ($lista_prestamos as $prestamo){
        
        echo "<tr>
                <td>".$prestamo['nombre_usuario'] . "</td>
                <td>".$prestamo['cedula']. "</td>
                <td>".$prestamo['nombre_libro'] . "</td>
                <td>".$prestamo['nombre_autor']."</td>
                <td>".$prestamo['fecha_prestamo']."</td>
                <td>".$prestamo['fecha_max_devolucion']."</td>
                <td>".$prestamo['estado_prestamo']."</td>";
                if($prestamo['estado_prestamo'] === "NO ENTREGADO"){
                echo "
                <form action='../../../controllers/PrestamoController.php' method='POST' style='display: inline-block; margin-right: 15px; margin-left: 15px;'>
                <td>
                    <input type='hidden' name='id_libro' value='".$prestamo['id_libro']."'>
                    <input type='hidden' name='id_prestamo' value='".$prestamo['id_prestamo']."'>
                    <center><button type = 'submit' name = 'accion' value = 'confirmar_entrega' style='background-color: transparent; border: none;'><img src='../../../Assets/Images/iconos/dar_libro.png' title='Entrega de libro' style='width: 30px; cursor: pointer')'></button><center>
                </td>    
                </form>
            </tr>";
            }
        }
    }else{
        echo "<tr><td>El libro seleccionado no tiene ningun prestamo </td></tr>";
    }
echo "      </table>
        </div>
    </div>
</body>";
?>