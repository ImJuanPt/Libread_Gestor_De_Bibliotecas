<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/models/Usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Libread_Gestor_De_Bibliotecas/persistence/Usuario/UsuarioCrud.php";
class service_Usuario
{
    public static function register($cedula, $clave, $apellido1, $apellido2, $correo, $nombre)
    {
        $array_respuesta = array();

        try {
            $u = UsuarioCrud::findUser($cedula);
            //se verifica que se encuentre un usuario, si no hay una instancia de tipo usuario significa que lo que contiene es un mensaje definitido 
            //en el metodo findUser
            if (!$u instanceof Usuario) {
                $user = UsuarioCrud::registerUser($cedula, $clave, $apellido1, $apellido2, $correo, $nombre);
                //si se cumple el registro deja una instancia de tipo usuario, si no contiene un mensaje de error la variable $user
                if ($user instanceof Usuario) {
                    $_SESSION["usuario.login"] = serialize($user);
                    $array_respuesta[1] = true;
                    $array_respuesta[2] = "Registro Exitoso";
                    $_SESSION["register.respuesta"] = serialize($array_respuesta);
                } else {
                    throw new Exception($user);
                }
            } else {
                throw new Exception("Hubo un error, la cedula que intenta ingresar ya se encuentra registrada, intente Iniciar Sesion");
            }
        } catch (Exception $error) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "Hubo un error al intentar registrar el usuario: " . $error->getMessage();
            $_SESSION["register.respuesta"] = serialize($array_respuesta);
        }
    }

    public static function edit_profile($nombre, $apellido1, $apellido2, $pass, $correo, $cc)
    {
        $array_respuesta = array();
        $perfil_edit = unserialize($_SESSION["usuario.login"]);
        try {
            $respuesta = UsuarioCrud::editUser($nombre, $apellido1, $apellido2, $pass, $correo, $cc, $perfil_edit);
            if ($respuesta instanceof Usuario) {
                $_SESSION["usuario.login"] = serialize($respuesta);
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Usuario Editado";
                $_SESSION["edit_profile.respuesta"] = serialize($array_respuesta);
            } else {
                throw new Exception($respuesta);
            }
        } catch (Exception $error) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = $error->getMessage();
            $_SESSION["edit_profile.respuesta"] = serialize($array_respuesta);
        }
    }

    public static function login($cedula, $clave)
    {
        $array_respuesta = array();
        try {
            $u = UsuarioCrud::findUser($cedula);
            if ($u instanceof Usuario) {
                if ($u->clave == $clave) {
                    $u = serialize($u);
                    $_SESSION["usuario.login"] = $u;
                    $array_respuesta[1] = true;
                    $array_respuesta[2] = "Inicio de Sesion exitoso";
                    $_SESSION["login.respuesta"] = serialize($array_respuesta);
                } else {
                    throw new Exception("Password Incorrecto");
                }
            } else {
                throw new Exception($u);
            }
        } catch (Exception $error) {
            $msj = "Ocurrio un error al Iniciar Sesion: " . $error->getMessage();
            $_SESSION["usuario.login"] = NULL;
            $array_respuesta[1] = false;
            $array_respuesta[2] = $msj;
            $_SESSION["login.respuesta"] = serialize($array_respuesta);
        }
    }

    public static function validate_login()
    {
        $user = unserialize(isset($_SESSION["usuario.login"]) ? $_SESSION["usuario.login"] : null);
        if ($user != null) {
            return $user;
        } else {
            return false;
        }
    }

    public static function Logout()
    {
        $_SESSION["usuario.login"] = null;
    }

    public static function findUser($id_usuario)
    {
        return UsuarioCrud::findUser($id_usuario);
    }

    public static function addPrestamoUser($user)
    {
        return UsuarioCrud::addPrestamoUser($user);
    }
}
