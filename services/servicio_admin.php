<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/LibrosGenero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Genero.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Anuncio.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Libro.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_index.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_login.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_admin.php";
class servicio_admin
{
    //metodo para listar todos los libros y retornar el array que se genera
    public static function list_books()
    {
        return Libro::find('all', array(
            'joins' => array('autores'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'estado_libro = "ACTIVO"',
        ));
    }

    //buscar un libro especifico y retornarlo
    public static function find_book($id)
    {
        
        $lib = Libro::find('all', array(
            'joins' => array('autores'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'estado_libro = "ACTIVO" AND id_libro =' . $id . ';',
        ));

        return $lib;
    }

    //buscar los generos de un libro especifico(no funcionando)
    public static function gender_book($id)
    {
        $row_genero = LibrosGenero::find('all', array(
            'joins' => array('generos'),
            'select' => 'libros.*, autores.nombre_autor, libros.img_portada',
            'conditions' => 'libros_generos.id_libro =' . $id . ';',
        ));

        $generos = '';
        foreach($row_genero as $row_genero){
            if($generos===''){
                $generos = $row_genero['nombre_genero'];
            }else{
                $generos = $generos.", ".$row_genero['nombre_genero'];
            }
        }
        return $generos;
    }
}
