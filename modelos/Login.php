<?php

require_once '../config/conexion.php';

class Login
{
    public function verificar($login, $pass_hash)
    {
        $sql = "SELECT * FROM usuarios 
                WHERE (telefono = '$login' OR correo = '$login') 
                AND password = '$pass_hash'
                AND activo = 1";
        return ejecutarConsulta($sql);
    }
}
