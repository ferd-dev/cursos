$(document).ready(function () {
	$('#menuCursoEstudiantes').addClass('active');
	listar();

	$('#buscar').keyup(function () {
		let palabra = $('#buscar').val();
		if (palabra.length > 0) {
			$.post('../ajax/cursoEstudianteAjax.php?op=buscar', { palabra: palabra }, function (data) {
				data = JSON.parse(data);
				const colores = ['primary', 'success', 'danger', 'warning', 'info', 'secondary'];
				let numColor = 0;
				$('#cursos').empty();
				let html = '';
				data.forEach((element) => {
					let fecha = new Date(element.fecha_creada).toLocaleDateString();
					let descripcion = element.descripcion.substring(0, 30) + '...';

					html += `<div class="col-sm-12 col-md-6 col-lg-4 ">
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
		} else {
			listar();
		}
	});
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

			html += `<div class="col-sm-12 col-md-6 col-lg-4 ">
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
