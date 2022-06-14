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
            <h1>Estudiantes</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Basic DataTables</h4>
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-striped" id="tblAlumnos" width="100%">
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
        </div>
    </section>
</div>

<!-- TODO: MODAL PARA EDITAR EL ESTUDIANTE -->

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/alumnos.js"></script>