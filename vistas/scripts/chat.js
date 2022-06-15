let tabla;
$(document).ready(function () {
	$('#menuChat').addClass('active');

	listarMsj();
	let objDiv = document.getElementById('charBody');
	objDiv.scrollTop = objDiv.scrollHeight;

	setInterval(() => {
		listarMsj();
	}, 1000);

	$('#mensaje').submit(function (e) {
		e.preventDefault();
		enviarMsj();
	});
});

function enviarMsj() {
	let textMsj = $('#textMsj').val();
	let id_usuario = $('#id_usuario').val();
	$.post(
		'../ajax/chatAjax.php?op=enviarMsj',
		{ textMsj: textMsj, id_usuario: id_usuario },
		function (data) {
			$('#textMsj').val('');
			listarMsj();
			let objDiv = document.getElementById('charBody');
			objDiv.scrollTop = objDiv.scrollHeight;
		}
	);
}

function listarMsj() {
	let id_usuario = $('#id_usuario').val();
	$.get('../ajax/chatAjax.php?op=listarMsj', function (data) {
		data = JSON.parse(data);
		$('#charBody').empty();
		let html = '';
		data.forEach((element) => {
			let hora = new Date(element.fecha_mensaje);
			let hora_formato = hora.getHours() + ':' + hora.getMinutes();
			let lugar = element.id_usuario == id_usuario ? 'right' : 'left';
			let color = element.id_usuario == id_usuario ? '3' : '1';

			html += `<div class="chat-item chat-${lugar}">
		                <img src="../public/img/avatar/avatar-${color}.png" alt="">
		                <div class="chat-details">
		                    <div class="chat-text">
		                        <i>${element.mensaje}</i>
		                    </div>
		                    <div class="chat-time">
								${element.nombre} |
		                        ${hora_formato}
		                    </div>
		                </div>
		            </div>`;
		});

		$('#charBody').append(html);
		let objDiv = document.getElementById('charBody');
		objDiv.scrollTop = objDiv.scrollHeight;
	});
}
