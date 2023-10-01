<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/library/config.php";

class Libros_genero extends ActiveRecord\Model{
    public static $belongs_to = array(
        array("libro"),
        array("genero")
    );
}
?>

