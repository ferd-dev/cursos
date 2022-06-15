<?php
if (strlen(session_id()) < 1) {
    session_start();
}

require_once '../modelos/Chat.php';

$chat = new Chat();

$id_usuario = isset($_POST['id_usuario']) ? limpiarCadena($_POST['id_usuario']) : "";
$textMsj = isset($_POST['textMsj']) ? limpiarCadena($_POST['textMsj']) : "";

switch ($_GET['op']) {
    case 'listarMsj':
        $rspta = $chat->listar();
        $datos = array();
        while ($fetch = $rspta->fetch_object()) {
            $datos[] = array(
                'id_mensaje' => $fetch->id_mensaje,
                'id_usuario' => $fetch->id_usuario,
                'mensaje' => $fetch->mensaje,
                'fecha_mensaje' => $fetch->fecha_mensaje,
                'nombre' => $fetch->nombre
            );
        }
        echo json_encode($datos);
        break;

    case 'enviarMsj':
        $rspta = $chat->enviarMjs($id_usuario, $textMsj);

        if ($rspta) {
            $respuesta = array(
                'estado' => 'exito',
                'mensaje' => 'El mensaje fue enviado con éxito'
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'El mensaje no pudo ser enviado'
            );
        }
        echo json_encode($respuesta);
        break;
}
