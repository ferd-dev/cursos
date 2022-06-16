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
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="../public/img/logo1.png" alt="logo" width="40%" class="shadow-light">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Iniciar Sesión</h4>
                        </div>

                        <div class="card-body">
                            <form id="frmIniciarSesion" class="needs-validation">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input id="usuario" type="text" class="form-control" name="usuario" tabindex="1" autocomplete="FALSE" placeholder="Correo o Telefono" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="control-label">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="FALSE" placeholder="********">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block btnLogin" tabindex="4">
                                        Iniciar Sesión
                                    </button>
                                </div>
                            </form>
                            <div class="text-center mt-4 mb-3">
                                <div class="text-job text-muted">
                                    <a href="registro.php">Registrarse</a>
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
<script src="scripts/login.js"></script>