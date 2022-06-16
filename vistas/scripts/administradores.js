let tabla;
$(document).ready(function () {
	$('#menuAdmin').addClass('active');
	init();
});

function init() {
	listar();

	mostrarForm(false);

	$('#frmAdmin').submit(function (e) {
		e.preventDefault();
		$('#btnGuardar').prop('disabled', true);
		$('#btnCancelar').prop('disabled', true);
		guardar_o_editar();
	});
}

function listar() {
	tabla = $('#tblAdmin')
		.dataTable({
			columnDefs: [
				{
					targets: [0, 1, 5],
					className: 'text-center',
				},
			],
			aLengthMenu: [
				[5, 10, 50, 100, -1],
				[5, 10, 50, 100, 'Todos'],
			],
			iDisplayLength: -1,
			language: {
				url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json',
			},
			ajax: {
				url: '../ajax/administradorAjax.php?op=listar',
				type: 'get',
				dataType: 'json',
				error: function (e) {
					console.log(e.responseText);
				},
			},
			bDestroy: true,
			responsive: true,
			retrieve: true,
			processing: true,
			deferRender: false,
			iDisplayLength: 5,
		})
		.DataTable();
}

function guardar_o_editar() {
	formData = new FormData($('#frmAdmin')[0]);

	$.ajax({
		type: 'POST',
		url: '../ajax/administradorAjax.php?op=guardaroeditar',
		data: formData,
		contentType: false,
		processData: false,
		success: function (response) {
			response = JSON.parse(response);
			if (response.respuesta == 'exito') {
				mensajeExito(response.mensaje);
				mostrarForm(false);
				tabla.ajax.reload(null, false);
				limpiar();
			} else {
				mensajeError(response.mensaje);
			}
		},
	});
}

function mostrar(id_usuario) {
	$.post(
		'../ajax/administradorAjax.php?op=mostrar',
		{
			id_usuario: id_usuario,
		},
		function (data) {
			data = JSON.parse(data);
			console.log(data);
			mostrarForm(true);
			$('#password').prop('disabled', true);
			$('#password2').prop('disabled', true);

			$('#id_usuario').val(data.id_usuario);
			$('#nombre').val(data.nombre);
			$('#apellidos').val(data.apellidos);
			$('#telefono').val(data.telefono);
			$('#correo').val(data.correo);
		}
	);
}

function activar(id_usuario) {
	Swal.fire({
		title: '¿Esta segur@ de activar el administrador?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, activalo!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/administradorAjax.php?op=activar',
				{
					id_usuario: id_usuario,
				},
				function (data) {
					data = JSON.parse(data);
					if (data.estado == 'exito') {
						Swal.fire('!Activado!', data.mensaje, 'success');
					} else {
						Swal.fire('!Error!', data.mensaje, 'error');
					}
					tabla.ajax.reload(null, false);
				}
			);
		}
	});
}

function desactivar(id_usuario) {
	console.log(id_usuario);
	Swal.fire({
		title: '¿Esta segur@ de desactivar al administrador?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, desactival@!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/administradorAjax.php?op=desactivar',
				{
					id_usuario: id_usuario,
				},
				function (data) {
					data = JSON.parse(data);
					if (data.estado == 'exito') {
						Swal.fire('!Desactivado!', data.mensaje, 'success');
					} else {
						Swal.fire('!Error!', data.mensaje, 'error');
					}
					tabla.ajax.reload(null, false);
				}
			);
		}
	});
}

function mostrarForm(flag) {
	limpiar();
	if (flag) {
		$('#formulario').show();
		$('.btnGuardar').prop('disabled', false);
		$('#tabla').hide();
		$('.btnAgregar').hide();
		$('#password').prop('disabled', false);
		$('#password2').prop('disabled', false);
	} else {
		$('#formulario').hide();
		$('#tabla').show();
		$('.btnAgregar').show();
	}
}

function cancelarForm() {
	mostrarForm(false);
}

function limpiar() {
	formulario = $('#frmAdmin');
	formulario[0].reset();
	$('#id_usuario').val('');
}

function mensajeExito(mensaje) {
	Swal.fire({
		position: 'top-end',
		icon: 'success',
		title: mensaje,
		showConfirmButton: false,
		timer: 1500,
	});
}

function mensajeError(mensaje) {
	Swal.fire({
		icon: 'error',
		title: 'Oops...',
		text: mensaje,
	});
}
