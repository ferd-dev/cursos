<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/CursoEstudiante.php';

$cursoEstudiante = new CursoEstudiante();

switch ($_GET['op']) {
    case 'listar':
        $rspta = $cursoEstudiante->listar();
        $datos = array();
        while ($fetch = $rspta->fetch_object()) {
            $datos[] = array(
                'id_curso' => $fetch->id_curso,
                'nombre' => $fetch->nombre,
                'descripcion' => $fetch->descripcion,
                'materia' => $fetch->materia,
                'fecha_creada' => $fetch->fecha_creada,
                'fecha_editada' => $fetch->fecha_editada
            );
        }
        echo json_encode($datos);
        break;

    case 'obtenerDatosCurso':
        $id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
        $rspta = $cursoEstudiante->obtenerDatosCurso($id_curso);
        echo json_encode($rspta);
        break;

    case 'obtenerArchivos':
        $id_curso = isset($_POST['id_curso']) ? limpiarCadena($_POST['id_curso']) : "";
        $rspta = $cursoEstudiante->obtenerArchivos($id_curso);
        $datos = array();
        while ($fetch = $rspta->fetch_object()) {
            $datos[] = array(
                'id_archivo' => $fetch->id_archivo,
                'nombre' => $fetch->nombre,
                'descripcion' => $fetch->descripcion,
                'ruta' => $fetch->ruta,
                'fecha_subida' => $fetch->fecha_subida,
                'fecha_editada' => $fetch->fecha_editada,
                'nombre_tipo_archivo' => $fetch->nombre_tipo_archivo
            );
        }
        echo json_encode($datos);
        break;
}
