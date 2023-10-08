<?php
@session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";

class servicio_index
{
    public static function lasts_anunces()
    {
        $anuncios = Anuncio::find('all', array(
            'joins' => array('INNER JOIN libros ON anuncios.id_libro = libros.id_libro'),
            'select' => 'anuncios.*, libros.nombre, libros.img_portada',
            'order' => 'anuncios.id_libro DESC',
            'limit' => 3
        ));

        $datos = array();
        foreach ($anuncios as $anuncio) {
            $datos[] = $anuncio->attributes();
        }
        return $datos;
    }

    public static function validate_login()
    {
        if (isset($_SESSION["usuario.login"]) ) {
            return unserialize($_SESSION["usuario.login"]);
        }
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        //verificar si la ruta actual es distinta a la que se redirije si no se ha iniciado sesion, sino entra en buqle
        if ($_SERVER['PHP_SELF'] != "/Libread_Gestor_De_Bibliotecas/view/login.php") {
            header("Location: $urlBase");
            exit;
        }
    }
}
