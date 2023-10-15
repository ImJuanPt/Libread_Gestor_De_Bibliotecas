<?php
class servicio_login
{
    //metodo para validar inicio de sesion
    public static function login($cedula, $clave)
    {
        //array que se va a retornar con las respuestas de la ejecucion del metodo, en la posicion 1 si se cumplio true, si no false. 
        //en la posicion 2 la respuesta de la ejecucion
        $array_respuesta = array();
        try {
            //se busca en la bd a un usuario con la cedula que se recibe como parametro en el metodo
            $u = Usuario::find($cedula);
            //si se encuentra se verifica que la clave de dicho usuario encontrado sea igual a la que tambien se recibe como parametro en el metodo
            if ($u->clave == $clave) {
                //se serializa y se guarda en la sesion usuario.login y se manda la respuesta de true y con un mensaje de que todo funciono
                $u = serialize($u);
                $_SESSION["usuario.login"] = $u;
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Inicio de Sesion exitoso";
            } else {
                $_SESSION["usuario.login"] = null;
                $array_respuesta[1] = false;
                $array_respuesta[2] = "Password Incorrecto";
            }
            return $array_respuesta;
        } catch (Exception $error) {
            if (strstr($error->getMessage(), $cedula)) {
                $msj = "El usuario con Cedula: $cedula no existe";
            } else {
                $msj = "Ocurrio un error al Iniciar Sesion: " . $error->getMessage();
            }
            $_SESSION["usuario.find"] = NULL;
            $array_respuesta[1] = false;
            $array_respuesta[2] = $msj;
            return $array_respuesta;
        }
    }

    public static function register($user)
    {
        $array_respuesta = array();
        try {
            if (!Usuario::find_by_pk($user->cedula)) {
                $user->save();
                $array_respuesta[1] = true;
                $array_respuesta[2] = "Registro Exitoso";
            } else {
                $array_respuesta[1] = false;
                $array_respuesta[2] = "Hubo un error, la cedula que intenta ingresar ya se encuentra registrada, intente Iniciar Sesion";
            }
            return $array_respuesta;
        } catch (Exception $error) {
            $array_respuesta[1] = false;
            $array_respuesta[2] = "Hubo un error al intentar registrar el usuario: " . $error->getMessage();
            return $array_respuesta;
        }
    }

    //metodo para cerrar sesion
    public static function Logout()
    {
        $_SESSION["usuario.login"] = null;
    }

    //metodo para verificar que haya una sesion iniciada, si no se devuelve para el login
    public static function validate_login()
    {
        if (isset($_SESSION["usuario.login"])) {
            return unserialize($_SESSION["usuario.login"]);
        }
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/login.php";
        //verificar si la ruta actual es distinta a la que se redirije si no se ha iniciado sesion, sino entra en buqle
        if ($_SERVER['PHP_SELF'] != "/Libread_Gestor_De_Bibliotecas/view/login.php") {
            header("Location: $urlBase");
            exit;
        }
    }

    //metodo para verificar si la cuenta es de tipo administrador o default
    public static function type_account()
    {
        $urlBase = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/Libread_Gestor_De_Bibliotecas/view/error.php?msj=No tiene los permisos para acceder a esta pagina";
        $u = servicio_login::validate_login();
        return $u->tipo_usuario === "ADMIN" ? true :  header("Location: $urlBase");
    }
}
