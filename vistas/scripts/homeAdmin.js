$(document).ready(function () {
	$('#menuHomeAdmin').addClass('active');
	obtenerNumAlumnos();
	obtenerNumCursos();
	obtenerNumArchivos();
});

function obtenerNumAlumnos() {
	$.get('../ajax/homeAjax.php?op=obtenerNumAlumnos', function (data) {
		data = JSON.parse(data);
		$('#cantAlumnos').html(data.cantidad);
	});
}

function obtenerNumCursos() {
	$.get('../ajax/homeAjax.php?op=obtenerNumCursos', function (data) {
		data = JSON.parse(data);
		$('#cantCursos').html(data.cantidad);
	});
}

function obtenerNumArchivos() {
	$.get('../ajax/homeAjax.php?op=obtenerNumArchivos', function (data) {
		data = JSON.parse(data);
		$('#cantArchivos').html(data.cantidad);
	});
}
