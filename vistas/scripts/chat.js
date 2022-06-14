let tabla;
$(document).ready(function () {
	$('#menuChat').addClass('active');

	listarMsj();

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
			console.log(data);
		}
	);
}

function listarMsj() {
	$.get('../ajax/chatAjax.php?op=listarMsj', function (data) {
		data = JSON.parse(data);
		let html = '';
		data.forEach((element) => {
			html += `<div class="chat-item chat-right">
                        <img src="../public/img/avatar/avatar-1.png" alt="">
                        <div class="chat-details">
                            <div class="chat-text">
                                <i>You have blocked Ryan</i>
                            </div>
                            <div class="chat-time">
                                06:37
                            </div>
                        </div>
                    </div>`;
		});

		$('#mychat').html(html);
	});
}
