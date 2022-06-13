<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Curso.php';
require_once '../helpers/validaciones.php';

$curso = new Curso();

$id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$materia = isset($_POST['materia']) ? limpiarCadena($_POST['materia']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";

switch ($_GET['op']) {
    case 'listar':
        $rspta = $curso->listar();

        $num = 1;
        $datos = array();
        while ($reg = $rspta->fetch_object()) {
            $ver = '"ver"';
            $datos[] = array(
                "0" => $num,
                "1" => $reg->activo == 1
                    ? '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_curso . ')">
                            <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-warning" data-toggle="tooltip" title="Desactivar" onclick="desactivar(' . $reg->id_curso . ')">
                        <i class="fas fa-exclamation-triangle"></i>
                       </div>
                       <a href="archivos.php?id_curso=' . $reg->id_curso . '" class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>'
                    : '<div class="btn btn-icon btn-info" data-toggle="tooltip" title="ver" onclick="mostrar(' . $reg->id_curso . ')">
                        <i class="fas fa-pen"></i>
                       </div>
                       <div class="btn btn-icon btn-success" data-toggle="tooltip" title="Activar" onclick="activar(' . $reg->id_curso . ')">
                        <i class="fas fa-check"></i>
                       </div>
                       <a href="archivos.php?id_curso=' . $reg->id_curso . '" class="btn btn-icon btn-primary" data-toggle="tooltip" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>',
                "2" => $reg->nombre,
                "3" => $reg->materia,
                "4" => $reg->descripcion,
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
        if (empty($id_curso)) {
            if (campoVacio($nombre)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar el nombre.'
                );
            } else if (campoVacio($materia)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar la matéria a la cula pertenece el curso.'
                );
            } else {
                $rspta = $curso->crear($nombre, $descripcion, $materia);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El curso fue creado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El curso no pudo ser creado.'
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
            } else if (campoVacio($materia)) {
                $respuesta = array(
                    'respuesta' => 'error',
                    'mensaje' => 'Debe ingresar la matéria a la cula pertenece el curso.'
                );
            } else {
                $rspta = $curso->editar($id_curso, $nombre, $descripcion, $materia);

                if ($rspta) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'mensaje' => 'El curso fue editado exitosamente.'
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'error',
                        'mensaje' => 'El curso no pudo ser editado.'
                    );
                }
            }
            echo json_encode($respuesta);
        }
        break;

    case 'mostrar':
        $rspta = $curso->mostrar($id_curso);
        echo json_encode($rspta);
        break;

    case 'activar':
        $id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
        $rspta = $curso->activar($id_curso);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El curso fue activado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El curso no pudo ser activado'
            );
        }

        echo json_encode($respuesta);
        break;

    case 'desactivar':
        $id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
        $rspta = $curso->desactivar($id_curso);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El curso fue desactivado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El curso no pudo ser desactivado'
            );
        }
        echo json_encode($respuesta);
        break;
}
