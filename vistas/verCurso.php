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
<input type="hidden" name="id_curso" id="id_curso" value="<?= $_GET['id_curso'] ?>">
<div class="main-content">
    <section class="section mt-5">
        <div class="row">
            <div class="col-12 mb-3">
                <div class="hero bg-info text-white">
                    <div class="hero-inner">
                        <h1 id="nombreCurso"></h1>
                        <span id="materia"></span>
                        <p id="descripcionCurso"></p>
                        <br>
                        <p class="h6">
                            <span id="fecha_creada"></span>
                            <br>
                            <span id="fecha_editada"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pl-5 mt-3">
            <div class="col-12">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="activities" id="archivos">


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/verCurso.js"></script>