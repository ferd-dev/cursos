<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Home.php';
$home = new Home();

switch ($_GET['op']) {
    case 'obtenerNumAlumnos':
        $rspta = $home->obtenerNumAlumnos();
        echo json_encode($rspta);
        break;

    case 'obtenerNumAdmin':
        $rspta = $home->obtenerNumAdmin();
        echo json_encode($rspta);
        break;

    case 'obtenerNumCursos':
        $rspta = $home->obtenerNumCursos();
        echo json_encode($rspta);
        break;

    case 'obtenerNumArchivos':
        $rspta = $home->obtenerNumArchivos();
        echo json_encode($rspta);
        break;
}
