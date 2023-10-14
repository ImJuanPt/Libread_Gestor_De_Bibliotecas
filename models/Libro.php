<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Libro extends ActiveRecord\Model{
    public static $primary_key = "id_libro";
    public static $has_many = array(
        array("libros_generos"), // Un libro tiene muchos generos
        array("generos", "through" => "libros_generos"), //generos a través de libros_generos
        array("anuncios") // Un libro tiene muchos anuncios
    );
    public static $belongs_to = array(
        array('autores', 'class_name' => 'Autor', 'foreign_key' => 'id_autor') // Un autor pertence a un libro
    );
}
?>

