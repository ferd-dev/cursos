<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/TipoArchivo.php';
require_once '../helpers/validaciones.php';

$tipoArchivo = new TipoArchivo();

$id_tipo_archivo = isset($_POST['id_tipo_archivo']) ? limpiarCadena($_POST['id_tipo_archivo']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";

switch ($_GET['op']) {
    case 'listar':
        $rspta = $tipoArchivo->listar();

        $num = 1;
        $datos = array();
        while ($reg = $rspta->fetch_object()) {
            $datos[] = array(
                "0" => $num,
                "1" => $reg->activo == 1
                    ? '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_tipo_archivo . ')">
                            <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-warning" data-toggle="tooltip" title="Desactivar" onclick="desactivar(' . $reg->id_tipo_archivo . ')">
                        <i class="fas fa-exclamation-triangle"></i>
                       </div>'
                    : '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_tipo_archivo . ')">
                        <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-success" data-toggle="tooltip" title="Activar" onclick="activar(' . $reg->id_tipo_archivo . ')">
                        <i class="fas fa-check"></i>
                       </div>',
                "2" => $reg->nombre,
                "3" => $reg->activo == 1
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
        if (empty($id_tipo_archivo)) {
            if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else {
                $rspta = $tipoArchivo->crear($nombre);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El tipo de archivo fue creado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El tipo de archivo no pudo ser creado.'
                    );
                }
            }
            echo json_encode($respuesta);
        } else {
            if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else {
                $rspta = $tipoArchivo->editar($id_tipo_archivo, $nombre);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El tipo de archivo fue editado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El tipo de archivo no pudo ser editado.'
                    );
                }
            }
            echo json_encode($respuesta);
        }
        break;

    case 'mostrar':
        $rspta = $tipoArchivo->mostrar($id_tipo_archivo);
        echo json_encode($rspta);
        break;

    case 'activar':
        $id_tipo_archivo = isset($_POST['id_tipo_archivo']) ? limpiarCadena($_POST['id_tipo_archivo']) : "";
        $rspta = $tipoArchivo->activar($id_tipo_archivo);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El tipo de archivo fue activado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El tipo de archivo no pudo ser activado'
            );
        }

        echo json_encode($respuesta);
        break;

    case 'desactivar':
        $id_tipo_archivo = isset($_POST['id_tipo_archivo']) ? limpiarCadena($_POST['id_tipo_archivo']) : "";
        $rspta = $tipoArchivo->desactivar($id_tipo_archivo);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El tipo de archivo fue desactivado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El tipo de archivo no pudo ser desactivado'
            );
        }
        echo json_encode($respuesta);
        break;
}
