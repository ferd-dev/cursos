<?php

require_once '../config/conexion.php';

class Registro
{
    public function registrar($nombre, $apellidos, $telefono, $correo, $password)
    {
        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, correo, password, tipo, activo) 
                VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$password', 'est', 1)";
        return ejecutarConsulta_retornarID($sql);
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
