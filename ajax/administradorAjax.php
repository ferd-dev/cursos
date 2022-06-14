<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Administrador.php';
require_once '../helpers/validaciones.php';

$admin = new Administrador();

$id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$apellidos = isset($_POST['apellidos']) ? limpiarCadena($_POST['apellidos']) : "";
$telefono = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";
$correo = isset($_POST['correo']) ? limpiarCadena($_POST['correo']) : "";
$password = isset($_POST['password']) ? limpiarCadena($_POST['password']) : "";
$password2 = isset($_POST['password2']) ? limpiarCadena($_POST['password2']) : "";

switch ($_GET['op']) {
    case 'listar':
        $rspta = $admin->listar();

        $num = 1;
        $datos = array();
        while ($reg = $rspta->fetch_object()) {
            $datos[] = array(
                "0" => $num,
                "1" => $reg->activo == 1
                    ? '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_usuario . ')">
                        <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-warning" data-toggle="tooltip" title="Desactivar" onclick="desactivar(' . $reg->id_usuario . ')">
                        <i class="fas fa-exclamation-triangle"></i>
                       </div>'
                    : '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_usuario . ')">
                        <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-success" data-toggle="tooltip" title="Activar" onclick="activar(' . $reg->id_usuario . ')">
                        <i class="fas fa-check"></i>
                       </div>',
                "2" => $reg->nombre . ' ' . $reg->apellidos,
                "3" => $reg->telefono,
                "4" => $reg->correo,
                "5" => $reg->activo == 1
                    ? '<span class="badge badge-info">Activo</span>'
                    : '<span class="badge badge-danger">Inactivo</span>',
            );
            $num++;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($datos),
            "iTotalDisplayRecords" => count($datos),
            'aaData' => $datos
        );

        echo json_encode($results);
        break;

    case 'guardaroeditar':
        if (empty($id_usuario)) {
            if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else if (campoVacio($apellidos)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar los apellidos.'
                );
            } else if (campoVacio($telefono)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el teléfono.'
                );
            } else if (campoVacio($correo)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el correo.'
                );
            } else if (campoVacio($password)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar los password.'
                );
            } else if (campoVacio($password2)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe confirmar el password.'
                );
            } else if ($password != $password2) {
                $respuesta = array(
                    'estado' => 'error',
                    'mensaje' => 'Las contraseñas no coinciden'
                );
            } else {
                $verificarTelefono = $admin->existeTelefono($telefono);
                $fetchTelefono = $verificarTelefono->fetch_object();
                if (isset($fetchTelefono)) {
                    $respuesta = array(
                        'estado' => 'error',
                        'mensaje' => 'Ya existe un usuario con este teléfono.'
                    );
                } else {
                    $verificarCorreo = $admin->existeCorreo($correo);
                    $fetchCorreo = $verificarCorreo->fetch_object();
                    if (isset($fetchCorreo)) {
                        $respuesta = array(
                            'estado' => 'error',
                            'mensaje' => 'Ya existe un usuario con este correo.'
                        );
                    } else {
                        $pass_hash = hash("SHA256", $password);
                        $rspta = $admin->crear($nombre, $apellidos, $telefono, $correo, $pass_hash);

                        if ($rspta) {
                            $respuesta = array(
                                'respuesta' => 'exito',
                                'mensaje' => 'El administrador fue registrado exitosamente.'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => 'error',
                                'mensaje' => 'El administrador no pudo ser registrado.'
                            );
                        }
                    }
                }
            }
            echo json_encode($respuesta);
        } else {
            if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else if (campoVacio($apellidos)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar los apellidos.'
                );
            } else if (campoVacio($telefono)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el teléfono.'
                );
            } else if (campoVacio($correo)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el correo.'
                );
            } else {
                $rspta = $admin->editar($id_usuario, $nombre, $apellidos, $telefono, $correo);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El administrador fue editado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El administrador no pudo ser editado.'
                    );
                }
            }
            echo json_encode($respuesta);
        }
        break;

    case 'mostrar':
        $rspta = $admin->mostrar($id_usuario);
        echo json_encode($rspta);
        break;

    case 'activar':
        $id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
        $rspta = $admin->activar($id_usuario);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El administrador fue activado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El administrador no pudo ser activado'
            );
        }

        echo json_encode($respuesta);
        break;

    case 'desactivar':
        $id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
        $rspta = $admin->desactivar($id_usuario);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El administrador fue desactivado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El administrador no pudo ser desactivado'
            );
        }
        echo json_encode($respuesta);
        break;
}
