<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../vistas/login.php");
} else {
    require_once 'layout/header.php';
    require_once 'layout/sidebar.php';
}
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Administradores</h1>
        </div>

        <div class="section-body">
            <div class="row" id="tabla">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="btn btn-icon btn-primary btnGuardar" data-toggle="tooltip" title="Agregar" onclick="mostrarForm(true);">
                                <i class="fas fa-plus-circle"></i> Agregar
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-striped" id="tblAdmin" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Corréo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="formulario">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="frmAdmin">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="hidden" name="id_usuario" id="id_usuario">
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Corréo</label>
                                            <input type="email" class="form-control" id="correo" name="correo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="password" class="d-block">Contraseña</label>
                                        <input id="password" type="password" class="form-control" data-indicator="pwindicator" name="password" autocomplete="FALSE">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="password2" class="d-block">Confirmar Contraseña</label>
                                        <input id="password2" name="password2" type="password" class="form-control" name="password-confirm" autocomplete="FALSE">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <button type="submit" class="btn btn-icon btn-primary mr-2 btnGuardar" data-toggle="tooltip" title="Guardar">
                                            <i class="fas fa-save"></i> Gurdar
                                        </button>
                                        <div class="btn btn-icon btn-danger btnCancelar" data-toggle="tooltip" title="Cancelar" onclick="cancelarForm();">
                                            <i class="fas fa-chevron-circle-left"></i> Cancelar
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/administradores.js"></script>