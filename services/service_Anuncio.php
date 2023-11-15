<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Anuncio/AnuncioCrud.php";

class service_Anuncio
{
    //metodo para obtener los ultimos tres anuncios y retornarlos en un array
    public static function lasts_anunces()
    {
        $anuncios = AnuncioCrud::findAnunces();
        $datos = array();
        if(is_array($anuncios)){
            foreach ($anuncios as $anuncio) {
                $datos[] = $anuncio->attributes();
            }
        }
        return $datos;
    }

    public static function createAnunce($id_libro, $nombre, $tipoAnuncio){
        return AnuncioCrud::createAnunce($id_libro, $nombre, $tipoAnuncio);
    }

}
