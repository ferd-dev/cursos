let tabla;
$(document).ready(function () {
	$('#menuCursos').addClass('active');
	init();
});

function init() {
	listar();
	mostrarForm(false);

	obtenerDatosCurso();
	obtenerTipoArchivo();

	$('#frmArchivos').submit(function (e) {
		e.preventDefault();
		$('#btnGuardar').prop('disabled', true);
		$('#btnCancelar').prop('disabled', true);
		guardar_o_editar();
	});
}

function listar() {
	let id_curso = $('#id_curso').val();
	tabla = $('#tblArchivos')
		.dataTable({
			columnDefs: [
				{
					targets: [0],
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
				url: '../ajax/archivoAjax.php?op=listar',
				type: 'get',
				data: {
					id_curso: id_curso,
				},
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
	formData = new FormData($('#frmArchivos')[0]);

	$.ajax({
		type: 'POST',
		url: '../ajax/archivoAjax.php?op=guardaroeditar',
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

function mostrar(id_archivo) {
	$.post(
		'../ajax/archivoAjax.php?op=mostrar',
		{
			id_archivo: id_archivo,
		},
		function (data) {
			data = JSON.parse(data);
			mostrarForm(true);

			$('#id_archivo').val(data.id_archivo);
			$('#id_tipo_archivo').val(data.id_tipo_archivo);
			$('#nombre').val(data.nombre);
			$('#descripcion').val(data.descripcion);

			$('#labelNombre').empty();
			$('#labelNombre').append(data.nombre);

			if (data.ruta != null) {
				$('#rutaActual').val(data.ruta);
				let archivo = data.ruta.split('.');
				if (archivo[1] != 'png' && archivo[1] != 'jpg' && archivo[1] != 'jpeg') {
					if (archivo[1] == 'pdf') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/pdf.png');
					} else if (archivo[1] == 'xlsx') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/excel.png');
					} else if (archivo[1] == 'pptx') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/power.png');
					} else if (archivo[1] == 'rar') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/rar.png');
					} else if (archivo[1] == 'zip') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/zip.png');
					} else if (archivo[1] == 'docx') {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/word.png');
					} else {
						$('#rutaMuestra').attr('src', '../public/tipos_archivos/generico.png');
					}
				} else {
					$('#rutaMuestra').attr('src', '../public/archivos/' + data.ruta);
				}
				$('#rutaMuestra').show();
			}
		}
	);
}

function activar(id_archivo) {
	Swal.fire({
		title: '¿Esta segur@ de activar el archivo?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, activalo!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/archivoAjax.php?op=activar',
				{
					id_archivo: id_archivo,
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

function desactivar(id_archivo) {
	Swal.fire({
		title: '¿Esta segur@ de desactivar el archivo?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, desactival@!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/archivoAjax.php?op=desactivar',
				{
					id_archivo: id_archivo,
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

function obtenerDatosCurso() {
	let id_curso = $('#id_curso').val();
	$.post(
		'../ajax/archivoAjax.php?op=obtenerDatosCurso',
		{
			id_curso: id_curso,
		},
		function (data) {
			data = JSON.parse(data);
			$('#titulo').empty();
			let html = `Curso: ${data.nombre}`;
			$('#titulo').html(html);
		}
	);
}

function obtenerTipoArchivo() {
	$.get('../ajax/archivoAjax.php?op=obtenerTipoArchivo', function (data) {
		data = JSON.parse(data);
		$('#id_tipo_archivo').empty();
		let html = '<option value="">Seleccione un tipo de archivo</option>';
		data.forEach((element) => {
			html += `<option value="${element.id_tipo_archivo}">${element.nombre}</option>`;
		});

		$('#id_tipo_archivo').append(html);
	});
}

$('#ruta').change(function () {
	readURL(this);
});

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			if ($(input).attr('name') == 'ruta') {
				$('#rutaMuestra').attr('src', e.target.result);
			}
		};
		reader.readAsDataURL(input.files[0]);
	}
}

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
	formulario = $('#frmArchivos');
	formulario[0].reset();
	$('#id_archivo').val('');
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
