<?php
interface IUsuarioCrud
{
    public static function findUser($cedula);
    public static function registerUser($cedula, $clave, $apellido1, $apellido2, $correo, $nombre);
    public static function editUser($nombre, $apellido1, $apellido2, $pass, $correo, $cc, $perfil_edit);
    public static function deleteUser($cedula);
    public static function login($cedula, $clave);
    public static function addPrestamoUser($user);
}
