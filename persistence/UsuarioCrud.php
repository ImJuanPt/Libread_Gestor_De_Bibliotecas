<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/IUsuarioCrud.php";

class UsuarioCrud implements IUsuarioCrud
{
    public static function findUser($cedula)
    {
        try {
            $u = Usuario::find(array('cedula' => $cedula));
            if ($u == null) {
                throw new Exception("No existe el usuario");
            }
            return $u;
        } catch (Exception $e) {
            return "Ocurrió un error: " . $e->getMessage();
        }
    }

    public static function registerUser($usuario)
    {
        // Implementa la lógica para registrar un usuario
    }

    public static function editUser($usuario)
    {
        // Implementa la lógica para editar un usuario
    }

    public static function deleteUser($cedula)
    {
        // Implementa la lógica para eliminar un usuario
    }

    public static function login($cedula, $clave)
    {
        // Implementa la lógica para realizar el inicio de sesión
    }
}