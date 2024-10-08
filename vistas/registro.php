<?php
session_start();

if (isset($_SESSION["id_usuario"])) {
    if ($_SESSION["tipo"] == "est") {
        header("Location: cursosEstudiante.php");
    } else {
        header("Location: homeAdmin.php");
    }
} else {
    require_once 'layout/headerLogin.php';
}
?>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img src="../public/img/logo1.png" alt="logo" width="20%" class="shadow-light">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Registro</h4>
                        </div>

                        <div class="card-body">
                            <form id="frmRegistro">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="form-control" name="nombre" maxlength="100" autofocus>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="apellidos">Apellidos</label>
                                        <input id="apellidos" type="text" class="form-control" name="apellidos" maxlength="100">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="telefono">Teléfono</label>
                                        <input id="telefono" type="text" class="form-control" name="telefono" maxlength="13">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="correo">Corréo</label>
                                        <input id="correo" type="email" class="form-control" name="correo" maxlength="150">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="matricula">Matrícula</label>
                                        <input id="matricula" type="text" maxlength="20" class="form-control" name="matricula" autofocus>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Contraseña</label>
                                        <input id="password" type="password" class="form-control" data-indicator="pwindicator" name="password" autocomplete="FALSE">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Confirmar Contraseña</label>
                                        <input id="password2" name="password2" type="password" class="form-control" name="password-confirm" autocomplete="FALSE">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block btnRegistrar">
                                        Registrarme
                                    </button>
                                </div>
                            </form>
                            <div class="text-center mt-4 mb-3">
                                <div class="text-job text-muted">
                                    <a href="login.php">Iniciar Sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once 'layout/footerLogin.php'; ?>
<script src="scripts/registro.js"></script>