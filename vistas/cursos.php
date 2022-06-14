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
            <h1>Cursos</h1>
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
                                <table class="table table-striped" id="tblCursos" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Matéria</th>
                                            <th>Descripción</th>
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
                            <form id="frmCursos">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <input type="hidden" name="id_curso" id="id_curso">
                                            <input type="text" class="form-control" id="nombre" name="nombre">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Materia</label>
                                            <input type="text" class="form-control" id="materia" name="materia">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-icon btn-primary mr-2 btnGuardar" data-toggle="tooltip" title="Guardar">
                                        <i class="fas fa-save"></i> Gurdar
                                    </button>
                                    <div class="btn btn-icon btn-danger btnCancelar" data-toggle="tooltip" title="Cancelar" onclick="cancelarForm();">
                                        <i class="fas fa-chevron-circle-left"></i> Cancelar
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
<script src="scripts/cursos.js"></script>