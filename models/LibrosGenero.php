<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class LibrosGenero extends ActiveRecord\Model{
    public static $belongs_to = array(
        array("libro"),
        array("genero")
    );
}
?>

