<?php

require_once '../modelos/Login.php';
$login = new Login();

switch ($_GET['op']) {

    case 'verificar':
        session_start();

        $usuario    = isset($_POST["usuario"])      ? limpiarCadena($_POST["usuario"])      : "";
        $password   = isset($_POST["password"])     ? limpiarCadena($_POST["password"])     : "";

        if ($usuario == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El Usuario es obligatorio'
            );
            echo json_encode($respuesta);
        } else if ($password == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'La contraseña es obligatoria'
            );
            echo json_encode($respuesta);
        } else {
            $pass_hash = hash("SHA256", $password);
            $rspta = $login->verificar($usuario, $pass_hash);
            $fetch = $rspta->fetch_object();

            if (isset($fetch)) {

                $_SESSION["id_usuario"] = $fetch->id_usuario;
                $_SESSION["nombre"]     = $fetch->nombre;
                $_SESSION["apellidos"]  = $fetch->apellidos;
                $_SESSION["telefono"]   = $fetch->telefono;
                $_SESSION["correo"]     = $fetch->correo;
                $_SESSION["tipo"]       = $fetch->tipo;

                $respuesta = array(
                    'estado' => 'exito',
                    'mensaje' => 'Bienvenido',
                    'tipo' => $fetch->tipo
                );
                echo json_encode($respuesta);
            } else {
                $respuesta = array(
                    'estado' => 'error',
                    'mensaje' => 'Los datos no son correctos'
                );
                echo json_encode($respuesta);
            }
        }
        break;

    case 'salir':
        session_start();
        session_unset();
        session_destroy();
        header("location:../index.php");
        break;
}
