<?php
interface IUsuarioCrud
{
    public static function findUser($cedula);
    public static function registerUser($usuario);
    public static function editUser($usuario);
    public static function deleteUser($cedula);
    public static function login($cedula, $clave);
}
