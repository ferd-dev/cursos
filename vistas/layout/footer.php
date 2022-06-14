<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2022 <div class="bullet"></div> Todos los derechos reservados</a>
    </div>
    <div class="footer-right">

    </div>
</footer>

</div>
</div>

<!-- General JS Scripts -->
<script src="../public/modules/jquery.min.js"></script>
<script src="../public/modules/popper.js"></script>
<script src="../public/modules/tooltip.js"></script>
<script src="../public/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="../public/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="../public/modules/moment.min.js"></script>
<script src="../public/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="../public/modules/datatables/datatables.min.js"></script>
<script src="../public/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../public/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="../public/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="../public/js/page/modules-datatables.js"></script>
<!-- <script src="../public/js/page/components-chat-box.js"></script> -->

<!-- Template JS File -->
<script src="../public/js/scripts.js"></script>
<script src="../public/js/custom.js"></script>
</body>

</html>

<!-- Funcion para serrar sesión -->
<script>
    $("#salir").click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Esta segur@ de salir del Sistema?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '!Sí, Salir!',
            cancelButtonText: 'No, cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../ajax/loginAjax.php?op=salir";
            }
        });
    });
</script>