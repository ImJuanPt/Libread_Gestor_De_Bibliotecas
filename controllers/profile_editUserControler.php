<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Libread_Gestor_De_Bibliotecas/services/servicio_profileEdit.php";
class profile_editUserController
{
    public static function ejecutarAccion()
    {
        $accion = @$_REQUEST["accion"];
        switch ($accion) {
            case "insert_edit_profile":
                profile_editUserController::editar_perfil();
                break;
            case "profile":
                header("Location: ../view/view_user/profile_editar_user.php");
                exit;
                break;
            case "Logout":
                break;
            default:
                header("Location:../view/error.php?msj=Accion no permitida");
                exit;
        }
    }

    public static function editar_perfil() 
    {
        $cedula = isset($_REQUEST["cedula"]) ? $_REQUEST["cedula"] : "";
        $clave = isset($_REQUEST["contra"]) ? $_REQUEST["contra"] : "";
        $apellido1 = isset($_REQUEST["apellido1"]) ? $_REQUEST["apellido1"] : "";
        $apellido2 = isset($_REQUEST["apellido2"]) ? $_REQUEST["apellido2"] : "";
        $correo = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
        $nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
        if ($cedula !== "" && $clave !== "" && $apellido1 !== "" && $apellido2 !== "" && $correo !== "" && $nombre !== "") {
            $answ = servicio_profileEdit::edit_profile($nombre, $apellido1, $apellido2, $clave, $correo, $cedula);
            if($answ[1]){
                echo '';
                header("Location:../view/view_user/profile_user.php?msj=".$answ[2]);
                exit;
            }else{
                header("Location:../view/error.php?msj=".urldecode($answ[2]));
                exit;
            }
        } else {
            header("Location:../view/error.php?msj=Debe llenar todos los campos para continuar");
            exit;
        } 
    }

}
profile_editUserController::ejecutarAccion();
?>