<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/Gastos/lib/config.php";

class Prestamo extends ActiveRecord\model{
    public static $belongs_to = array(
        array("libro"),
        array("usuario")
    );
}