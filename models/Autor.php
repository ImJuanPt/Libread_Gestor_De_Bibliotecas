<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Autor extends ActiveRecord\Model{
    static $table_name = 'autores';
    public static $primary_key = "id_autor";
    public static $has_many = array(
        array("libros") // Un libro tiene muchos generos
    );
}
?>

