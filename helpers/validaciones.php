<?php
function campoVacio($campo)
{
    if (empty($campo)) {
        return true;
    } else {
        return false;
    }
}

function validarEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validarTelefono($telefono)
{
    if (preg_match("/^[0-9]{8}$/", $telefono)) {
        return true;
    } else {
        return false;
    }
}
