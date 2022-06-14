$(document).ready(function () {
	$('#menuCursoEstudiantes').addClass('active');
	obtenerDatosCurso();
	obtenerArchivos();
});

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
			$('#materia').html(data.materia);

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
