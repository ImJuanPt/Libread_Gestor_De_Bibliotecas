<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/lib/config.php";

class Usuario extends ActiveRecord\Model{
    public static $primary_key = "cedula";
    public static $alias_attribute = array(
        'clave' => 'passw'
    );
}

?>