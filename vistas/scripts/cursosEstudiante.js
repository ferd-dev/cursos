$(document).ready(function () {
	$('#menuCursoEstudiantes').addClass('active');
	listar();
	// obtenerDatosCurso();
	// obtenerArchivos();
});

function listar() {
	$.get('../ajax/cursoEstudianteAjax.php?op=listar', function (data) {
		data = JSON.parse(data);
		const colores = ['primary', 'success', 'danger', 'warning', 'info', 'secondary'];
		let numColor = 0;
		$('#cursos').empty();
		let html = '';
		data.forEach((element) => {
			let fecha = new Date(element.fecha_creada).toLocaleDateString();
			let descripcion = element.descripcion.substring(0, 30) + '...';

			html += `<div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-${colores[numColor]} mb-3 p-5 text-white">
                                <h3>${element.nombre} <p class="h5 pt-3"><em>${element.materia}</em></p></h3>
								
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    ${descripcion}
                                </p>
                                <p>${fecha}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="verCurso.php?id_curso=${element.id_curso}">Ver curso</a>
                                </div>
                            </div>
                        </div>
                    </div>`;
			if (numColor == colores.length - 1) {
				numColor = 0;
			} else {
				numColor++;
			}
		});

		$('#cursos').html(html);
	});
}

function obtenerDatosCurso() {
	let id_curso = $('#id_curso').val();
	$.post(
		'../ajax/cursoEstudianteAjax.php?op=obtenerDatosCurso',
		{
			id_curso: id_curso,
		},
		function (data) {
			data = JSON.parse(data);
			$('#nombreCurso').html(data.nombre);
			$('#descripcionCurso').html(data.descripcion);

			let fecha_creada = new Date(data.fecha_creada).toLocaleDateString();
			let fecha_editada = new Date(data.fecha_editada).toLocaleDateString();

			$('#fecha_creada').html(`Creado: ${fecha_creada}`);
			$('#fecha_editada').html(`Editado: ${fecha_editada}`);
		}
	);
}

function obtenerArchivos() {
	let id_curso = $('#id_curso').val();
	$.post(
		'../ajax/cursoEstudianteAjax.php?op=obtenerArchivos',
		{
			id_curso: id_curso,
		},
		function (data) {
			$('#archivos').empty();
			let html = '';
			data = JSON.parse(data);
			data.forEach((element) => {
				let fecha = new Date(element.fecha_subida).toLocaleDateString();
				html += `<div class="activity">
                            <div class="activity-icon bg-primary text-white shadow-primary">
                                <i class="fas fa-comment-alt"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job text-primary">${fecha}</span>
                                    <span class="bullet"></span>
                                    <div class="float-right">
                                        <h6><span class="badge badge-secondary">${element.nombre_tipo_archivo}</span></h6>
                                    </div>
                                </div>
                                <h4>${element.nombre}</h4>
                                <h6>${element.descripcion}</h6>
                                <div class="d-flex justify-content-end">
                                    <a href="../public/archivos/${element.ruta}" download="${element.nombre}">Descargar archivo</a>
                                </div>
                            </div>
                        </div>`;
			});

			$('#archivos').html(html);
		}
	);
}
