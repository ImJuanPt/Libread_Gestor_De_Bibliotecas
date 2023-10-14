<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Genero extends ActiveRecord\Model{
    public static $primary_key = "id_genero";
    public static $has_many = array(
        array("libros_generos"), // Un genero tiene muchos libros
        array("libros", "through" => "libros_generos")
    );
}
?>

