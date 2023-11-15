<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Anuncio/IAnuncioCrud.php";

class AnuncioCrud implements IAnuncioCurd
{
    public static function findAnunces()
    {
        try {
            $anuncios = Anuncio::find('all', array(
                'joins' => array('INNER JOIN libros ON anuncios.id_libro = libros.id_libro'),
                'select' => 'anuncios.*, libros.nombre, libros.img_portada',
                'order' => 'anuncios.id_libro DESC',
                'limit' => 3
            ));
            return $anuncios;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Mi método personalizado.
     *
     * @param array $parametro3 Descripción del tercer parámetro.
     *   Uso: solo usar "add" para agregar un anuncio, "del" para hacer un anuncio de eliminacion y "update" para hacer un anuncio de actualizacion.
     */
    public static function createAnunce($id_libro, $nombre, $tipo_anuncio)
    {
        switch ($tipo_anuncio) {
            case "add":
                $tipo_anuncio = "agregado";
                break;
            case "del":
                $tipo_anuncio = "eliminado";
                break;
            case "update":
                $tipo_anuncio = "actualizado";
                break;
        }
        try {
            $anuncio = Anuncio::create([
                'id_libro' => $id_libro, 'tipo_anuncio' => 'Nuevo libro',
                'descripcion' => $nombre . ' ha sido ' . $tipo_anuncio . ' en nuestra biblioteca, puede que sea de su agrado'
            ]);
            return $anuncio;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
