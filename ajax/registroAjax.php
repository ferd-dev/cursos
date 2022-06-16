<?php

require_once '../modelos/Registro.php';
$registro = new Registro();

switch ($_GET['op']) {

    case 'registrar':
        session_start();

        $nombre    = isset($_POST["nombre"])      ? limpiarCadena($_POST["nombre"])      : "";
        $apellidos = isset($_POST["apellidos"])   ? limpiarCadena($_POST["apellidos"])   : "";
        $telefono  = isset($_POST["telefono"])    ? limpiarCadena($_POST["telefono"])    : "";
        $matricula = isset($_POST["matricula"])   ? limpiarCadena($_POST["matricula"])   : "";
        $correo    = isset($_POST["correo"])      ? limpiarCadena($_POST["correo"])      : "";
        $password  = isset($_POST["password"])    ? limpiarCadena($_POST["password"])    : "";
        $password2 = isset($_POST["password2"])   ? limpiarCadena($_POST["password2"])   : "";

        if ($nombre == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El nombre es obligatorio'
            );
            echo json_encode($respuesta);
        } else if ($apellidos == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'Los apellidos son obligatorios'
            );
            echo json_encode($respuesta);
        } else if ($telefono == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El teléfono es obligatorio'
            );
            echo json_encode($respuesta);
        } else if ($correo == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El corréo es obligatorio'
            );
            echo json_encode($respuesta);
        } else if ($password == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'La contraseña es obligatoria'
            );
            echo json_encode($respuesta);
        } else if ($password2 == "") {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'Deve confirmar la contraseña'
            );
            echo json_encode($respuesta);
        } else if ($password != $password2) {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'Las contraseñas no coinciden'
            );
            echo json_encode($respuesta);
        } else {
            $verificarTelefono = $registro->existeTelefono($telefono);
            $fetchTelefono = $verificarTelefono->fetch_object();
            if (isset($fetchTelefono)) {
                $respuesta = array(
                    'estado' => 'error',
                    'mensaje' => 'Ya existe un usuario con este teléfono.'
                );
                echo json_encode($respuesta);
            } else {
                $verificarCorreo = $registro->existeCorreo($correo);
                $fetchCorreo = $verificarCorreo->fetch_object();
                if (isset($fetchCorreo)) {
                    $respuesta = array(
                        'estado' => 'error',
                        'mensaje' => 'Ya existe un usuario con este correo.'
                    );
                    echo json_encode($respuesta);
                } else {
                    $pass_hash = hash("SHA256", $password);
                    $id_usuario = $registro->registrar($nombre, $apellidos, $telefono, $matricula, $correo, $pass_hash);

                    if ($id_usuario) {
                        $_SESSION["id_usuario"] = $id_usuario;
                        $_SESSION["nombre"]     = $nombre;
                        $_SESSION["apellidos"]  = $apellidos;
                        $_SESSION["telefono"]   = $telefono;
                        $_SESSION["matricula"]  = $matricula;
                        $_SESSION["correo"]     = $correo;
                        $_SESSION["tipo"]       = "est";

                        $respuesta = array(
                            'estado' => 'exito',
                            'mensaje' => 'Usuario registrado correctamente'
                        );
                        echo json_encode($respuesta);
                    } else {
                        $respuesta = array(
                            'estado' => 'error',
                            'mensaje' => 'Ups! Algo salió mal, vuelve a intentarlo'
                        );
                        echo json_encode($respuesta);
                    }
                }
            }
        }


        break;
}
