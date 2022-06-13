<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Archivo.php';
require_once '../helpers/validaciones.php';

$archivo = new Archivo();

$id_archivo = isset($_POST['id_archivo']) ? limpiarCadena($_POST['id_archivo']) : "";
$id_tipo_archivo = isset($_POST['id_tipo_archivo']) ? limpiarCadena($_POST['id_tipo_archivo']) : "";
$id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
$ruta = isset($_POST['ruta']) ? limpiarCadena($_POST['ruta']) : "";

switch ($_GET['op']) {
    case 'listar':
        $id_curso = isset($_GET['id_curso']) ? limpiarCadena($_GET['id_curso']) : "";
        $rspta = $archivo->listar($id_curso);

        $num = 1;
        $datos = array();
        while ($reg = $rspta->fetch_object()) {
            $datos[] = array(
                "0" => $num,
                "1" => $reg->activo == 1
                    ? '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_archivo . ')">
                            <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-warning" data-toggle="tooltip" title="Desactivar" onclick="desactivar(' . $reg->id_archivo . ')">
                        <i class="fas fa-exclamation-triangle"></i>
                        </div>'
                    : '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_archivo . ')">
                        <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-success" data-toggle="tooltip" title="Activar" onclick="activar(' . $reg->id_archivo . ')">
                        <i class="fas fa-check"></i>
                       </div>',
                "2" => $reg->nombre,
                "3" => $reg->descripcion,
                "4" => $reg->nombre_tipo_archivo,
                "5" => '<span class="badge ">
                            <a href="../public/archivos/' . $reg->ruta . '" download="' . $reg->nombre . '">
                                Descargar archivo
                            </a>
                        </span>',
                "6" => $reg->fecha_subida,
                "7" => $reg->fecha_editada,
                "8" => $reg->activo == 1
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
        if (empty($id_archivo)) {
            if (campoVacio($id_tipo_archivo)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe escoger un tipo de archivo.'
                );
            } else if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else {
                $ext = explode(".", $_FILES["ruta"]["name"]);
                $ruta = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["ruta"]["tmp_name"], "../public/archivos/" . $ruta);

                $rspta = $archivo->crear($id_tipo_archivo, $id_curso, $nombre, $descripcion, $ruta);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El archivo fue agregado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El archivo no pudo ser agregado.'
                    );
                }
            }
            echo json_encode($respuesta);
        } else {
            if (!file_exists($_FILES["ruta"]["tmp_name"]) || !is_uploaded_file($_FILES["ruta"]["tmp_name"])) {
                $ruta = $_POST["rutaActual"];
            } else {
                $ext = explode(".", $_FILES["ruta"]["name"]);
                $ruta = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES["ruta"]["tmp_name"], "../public/archivos/" . $ruta);
            }

            if (campoVacio($id_tipo_archivo)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe escoger un tipo de archivo.'
                );
            } else if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else {
                $rspta = $archivo->editar($id_archivo, $id_tipo_archivo, $nombre, $descripcion, $ruta);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El archivo fue editado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El archivo no pudo ser editado.'
                    );
                }
            }
            echo json_encode($respuesta);
        }
        break;

    case 'mostrar':
        $rspta = $archivo->mostrar($id_archivo);
        echo json_encode($rspta);
        break;

    case 'activar':
        $id_archivo = isset($_POST['id_archivo']) ? limpiarCadena($_POST['id_archivo']) : "";
        $rspta = $archivo->activar($id_archivo);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El archivo fue activado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El archivo no pudo ser activado'
            );
        }

        echo json_encode($respuesta);
        break;

    case 'desactivar':
        $id_archivo = isset($_POST['id_archivo']) ? limpiarCadena($_POST['id_archivo']) : "";
        $rspta = $archivo->desactivar($id_archivo);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El archivo fue desactivado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El archivo no pudo ser desactivado'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'obtenerDatosCurso':
        $id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
        $rspta = $archivo->obtenerDatosCurso($id_curso);
        echo json_encode($rspta);
        break;

    case 'obtenerTipoArchivo':
        $rspta = $archivo->obtenerTipoArchivo();
        $datos = array();
        while ($fetch = $rspta->fetch_object()) {
            $datos[] = array(
                'id_tipo_archivo' => $fetch->id_tipo_archivo,
                'nombre' => $fetch->nombre
            );
        }
        echo json_encode($datos);
        break;
}
