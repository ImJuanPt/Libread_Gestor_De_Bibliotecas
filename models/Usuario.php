<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Libread_Gestor_De_Bibliotecas/library/config.php";

class Usuario extends ActiveRecord\Model{
    public static $primary_key = "cedula";
    public static $has_many = array(array("prestamos"));//un usuario tiene muchos gastos
}

?>