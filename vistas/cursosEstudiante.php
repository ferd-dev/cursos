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
    <input class="form-control mt-3 p-4" type="text" id="buscar" placeholder="Buscar..." style="width: 50%;">
    <section class="section mt-5">
        <div class="row" id="cursos">

        </div>
    </section>
</div>

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/cursosEstudiante.js"></script>