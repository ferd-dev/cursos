<?php
require_once '../config/conexion.php';

class Administrador
{
    public function listar()
    {
        $sql = "SELECT * FROM usuarios
                WHERE tipo = 'adm2'
                ORDER BY activo DESC";
        return ejecutarConsulta($sql);
    }

    public function crear($nombre, $apellidos, $telefono, $correo, $password)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, matricula, correo, password, tipo, activo) 
                    VALUES('$nombre', '$apellidos', '$telefono', '0', '$correo', '$password', 'adm2', 1)";
        return ejecutarConsulta($sql);
    }

    public function mostrar($id_usuario)
    {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function editar($id_usuario, $nombre, $apellidos, $telefono, $correo)
    {
        $sql = "UPDATE usuarios 
                SET nombre = '$nombre', 
                    apellidos = '$apellidos', 
                    telefono = '$telefono', 
                    correo = '$correo'
                    WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);
    }

    public function activar($id_usuario)
    {
        $sql = "UPDATE usuarios 
                	SET activo = 1
                	WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);
    }

    public function desactivar($id_usuario)
    {
        $sql = "UPDATE usuarios 
                    SET activo = 0 
                    WHERE id_usuario = '$id_usuario'";
        return ejecutarConsulta($sql);
    }

    public function existeCorreo($correo)
    {
        $sql = "SELECT * FROM usuarios 
                WHERE correo = '$correo'";
        return ejecutarConsulta($sql);
    }

    public function existeTelefono($telefono)
    {
        $sql = "SELECT * FROM usuarios 
                WHERE telefono = '$telefono'";
        return ejecutarConsulta($sql);
    }
}
