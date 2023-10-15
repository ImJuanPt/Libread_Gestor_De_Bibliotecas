<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Libro extends ActiveRecord\Model{
    public static $primary_key = "id_libro";
    static $table_name = 'libros';
    public static $belongs_to = array(
        array('autores', 'class_name' => 'Autor', 'foreign_key' => 'id_autor') // Un autor pertence a un libro
    );

    static $has_many = array(
        array('libros_generos'),
        array('generos', 'through' => 'libros_generos'),
        array("anuncios") // Un libro tiene muchos anuncios

    );
}
?>

