<?php
require_once '../config/conexion.php';

class Chat
{
    public function listar()
    {
        $sql = "SELECT m.*, u.nombre FROM mensajes AS m
                INNER JOIN usuarios AS u ON m.id_usuario = u.id_usuario
                ORDER BY m.id_mensaje ASC";
        return ejecutarConsulta($sql);
    }

    public function enviarMjs($id_usuario, $mensaje)
    {
        $sql = "INSERT INTO mensajes (id_usuario, mensaje) 
                    VALUES('$id_usuario', '$mensaje')";
        return ejecutarConsulta($sql);
    }
}
