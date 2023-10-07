<?php
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
}