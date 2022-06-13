let tabla;
$(document).ready(function () {
	$('#menuCursos').addClass('active');
	init();
});

function init() {
	listar();

	mostrarForm(false);

	$('#frmCursos').submit(function (e) {
		e.preventDefault();
		$('#btnGuardar').prop('disabled', true);
		$('#btnCancelar').prop('disabled', true);
		guardar_o_editar();
	});
}

function listar() {
	tabla = $('#tblCursos')
		.dataTable({
			columnDefs: [
				{
					targets: [0, 3],
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
				url: '../ajax/cursoAjax.php?op=listar',
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
	formData = new FormData($('#frmCursos')[0]);

	$.ajax({
		type: 'POST',
		url: '../ajax/cursoAjax.php?op=guardaroeditar',
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

function mostrar(id_curso) {
	$.post(
		'../ajax/cursoAjax.php?op=mostrar',
		{
			id_curso: id_curso,
		},
		function (data) {
			data = JSON.parse(data);
			console.log(data);
			mostrarForm(true);

			$('#id_curso').val(data.id_curso);
			$('#nombre').val(data.nombre);
			$('#materia').val(data.materia);
			$('#descripcion').val(data.descripcion);
		}
	);
}

function activar(id_curso) {
	Swal.fire({
		title: '¿Esta segur@ de activar el curso?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, activalo!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/cursoAjax.php?op=activar',
				{
					id_curso: id_curso,
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

function desactivar(id_curso) {
	Swal.fire({
		title: '¿Esta segur@ de desactivar el curso?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, desactival@!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/cursoAjax.php?op=desactivar',
				{
					id_curso: id_curso,
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

function ver(id_curso) {}

function mostrarForm(flag) {
	limpiar();
	if (flag) {
		$('#formulario').show();
		$('.btnGuardar').prop('disabled', false);
		$('#tabla').hide();
		$('.btnAgregar').hide();
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
	formulario = $('#frmCursos');
	formulario[0].reset();
	$('#id_curso').val('');
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
