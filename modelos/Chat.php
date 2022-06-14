<?php
require_once '../config/conexion.php';

class Chat
{
    public function listar()
    {
        $sql = "SELECT * FROM mensajes
                ORDER BY id_mensaje ASC";
        return ejecutarConsulta($sql);
    }

    public function enviarMjs($id_usuario, $mensaje)
    {
        $sql = "INSERT INTO mensajes (id_usuario, mensaje) 
                    VALUES('$id_usuario', '$mensaje')";
        return ejecutarConsulta($sql);
    }
}
