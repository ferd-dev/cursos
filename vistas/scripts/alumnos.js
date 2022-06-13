let tabla;
$(document).ready(function () {
	$('#menuAlumnos').addClass('active');
	init();
});

function init() {
	listar();
}

function listar() {
	tabla = $('#tblAlumnos')
		.dataTable({
			columnDefs: [
				{
					targets: [0, 5],
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
				url: '../ajax/alumnoAjax.php?op=listar',
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

function activar(id_usuario) {
	Swal.fire({
		title: '¿Esta segur@ de activar el estudiante?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, activalo!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/alumnoAjax.php?op=activar',
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
	Swal.fire({
		title: '¿Esta segur@ de desactivar al estudiante?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '!Sí, desactival@!',
		cancelButtonText: 'No, cancelar',
	}).then((result) => {
		if (result.isConfirmed) {
			$.post(
				'../ajax/alumnoAjax.php?op=desactivar',
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
