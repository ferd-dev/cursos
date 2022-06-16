function init() {
	$('#frmIniciarSesion').submit(function (e) {
		e.preventDefault();
		$('.btnLogin').prop('disabled', true);
		iniciarSesion();
	});
}

function iniciarSesion() {
	let datos = new FormData($('#frmIniciarSesion')[0]);
	$.ajax({
		type: 'POST',
		url: '../ajax/loginAjax.php?op=verificar',
		data: datos,
		contentType: false,
		processData: false,
		success: function (response) {
			response = JSON.parse(response);
			$('.btnLogin').prop('disabled', false);

			if (response.estado == 'error') {
				Swal.fire(response.mensaje);
				$('#password').val('');
			} else if (response.estado == 'exito') {
				if (response.tipo == 'est') {
					window.location.href = 'cursosEstudiante.php';
				} else {
					window.location.href = 'homeAdmin.php';
				}
			}
		},
	});
}

init();
