function init() {
	$('#frmRegistro').submit(function (e) {
		e.preventDefault();
		$('.btnRegistrar').prop('disabled', true);
		regsitrar();
	});
}

function regsitrar() {
	let datos = new FormData($('#frmRegistro')[0]);
	$.ajax({
		type: 'POST',
		url: '../ajax/registroAjax.php?op=registrar',
		data: datos,
		contentType: false,
		processData: false,
		success: function (response) {
			response = JSON.parse(response);
			$('.btnRegistrar').prop('disabled', false);

			if (response.estado == 'error') {
				Swal.fire(response.mensaje);
			} else if (response.estado == 'exito') {
				window.location.href = 'cursosEstudiante.php';
			}
		},
	});
}

init();
