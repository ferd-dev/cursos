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
            <h1>DashBoard</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Cantidad de Alumnos</h4>
                        </div>
                        <div class="card-body" id="cantAlumnos">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Cantidad de Cursos</h4>
                        </div>
                        <div class="card-body" id="cantCursos">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Cantidad de archivos</h4>
                        </div>
                        <div class="card-body" id="cantArchivos">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/homeAdmin.js"></script>