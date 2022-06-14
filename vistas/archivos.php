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
            <h1 id="titulo"></h1>
        </div>

        <div class="section-body">
            <div class="row" id="tabla">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="btn btn-icon btn-primary btnGuardar" data-toggle="tooltip" title="Agregar" onclick="mostrarForm(true);">
                                <i class="fas fa-plus-circle"></i> Agregar
                            </div>
                            <div class="btn btn-icon btn-danger btnGuardar ml-2" data-toggle="tooltip" title="Volver" onclick=" history.back();">
                                <i class="fas fa-chevron-circle-left"></i> Volver
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-striped" id="tblArchivos" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Tipo</th>
                                            <th>Archivo</th>
                                            <th>Fecha subida</th>
                                            <th>Fecha editada</th>
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
                            <form id="frmArchivos">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Tipo de archivo</label>
                                            <select class="form-control" id="id_tipo_archivo" name="id_tipo_archivo"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Archivo</label>
                                            <input type="file" class="form-control" id="ruta" name="ruta">
                                            <input type="hidden" id="rutaActual" name="rutaActual">
                                            <label id="labelNombre"></label>
                                            <img src="" alt="" id="rutaMuestra" width="240px" heigth="220px" class="mt-2">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="form-group">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="hidden" name="id_archivo" id="id_archivo">
                                            <input type="hidden" name="id_curso" id="id_curso" value="<?= $_GET['id_curso'] ?>">
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-6">
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
<script src="scripts/archivos.js"></script>