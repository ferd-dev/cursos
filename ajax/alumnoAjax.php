<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Alumno.php';
$alumno = new Alumno();

switch ($_GET['op']) {
    case 'listar':
        $rspta = $alumno->listar();

        $num = 1;
        $datos = array();
        while ($reg = $rspta->fetch_object()) {
            $datos[] = array(
                "0" => $num,
                "1" => $reg->activo == 1
                    ? '<div class="btn btn-icon btn-warning" data-toggle="tooltip" title="Desactivar" onclick="desactivar(' . $reg->id_usuario . ')">
                        <i class="fas fa-exclamation-triangle"></i>
                       </div>'
                    : '<div class="btn btn-icon btn-success" data-toggle="tooltip" title="Activar" onclick="activar(' . $reg->id_usuario . ')">
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

    case 'activar':
        $id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
        $rspta = $alumno->activar($id_usuario);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El estudiante fue activado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El estudiante no pudo ser activado'
            );
        }

        echo json_encode($respuesta);
        break;

    case 'desactivar':
        $id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
        $rspta = $alumno->desactivar($id_usuario);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El estudiante fue desactivado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El estudiante no pudo ser desactivado'
            );
        }
        echo json_encode($respuesta);
        break;
}
