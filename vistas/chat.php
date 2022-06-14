<?php
session_start();

if (!isset($_SESSION["id_usuario"])) {
    header("Location: ../vistas/login.php");
} else {
    require_once 'layout/header.php';
    require_once 'layout/sidebar.php';
}
?>
<input type="hidden" name="id_usuario" id="id_usuario" value="<?= $_SESSION["id_usuario"] ?>">

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Chat grupal</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Información del chat</h2>
            <p class="section-lead">
                Los mensajes enviados podran ser leidos por todos los usuarios
            </p>
            <div class="row align-items-center justify-content-center mx-5">
                <div class="col-12 col-sm-12 col-lg-12 mx-5">
                    <div class="card chat-box card-primary" id="mychat">
                        <div class="card-header">
                            <h4>
                                <i class="fas fa-circle text-success mr-2" title="Online" data-toggle="tooltip"></i> Chat
                            </h4>
                        </div>
                        <div class="card-body chat-content" id="mychat">
                            <div class="chat-item chat-right">
                                <img src="../public/img/avatar/avatar-1.png" alt="">
                                <div class="chat-details">
                                    <div class="chat-text">
                                        <i>You have blocked Ryan</i>
                                    </div>
                                    <div class="chat-time">
                                        06:37
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer chat-form">
                            <form id="mensaje">
                                <input type="text" class="form-control" placeholder="Mensaje" name="textMsj" id="textMsj">
                                <button class="btn btn-primary" type="submit">
                                    <i class="far fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once 'layout/footer.php'; ?>
<script src="scripts/chat.js"></script>