<?
//$mssql = 1; $params = array(); $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); // microsoft sql server será utilizado nesta página
require 'inc/config.php';
require 'inc/check-session.php';

$rootDir	= realpath($_SERVER["DOCUMENT_ROOT"]);
$sucesso	= 0;
$id 		= anti_injection($_REQUEST['id']);
?>
<div id="card-content" class="card card-primary card-outline">

	<table class="table table-hover text-nowrap table-striped">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center d-none d-md-table-cell">RA</th>
				<th class="text-left">Aluno</th>
				<th class="text-center">Falta</th>
			</tr>
		</thead>
		<tbody>
			<?
			$sql = "SELECT DISTINCT
							AT.TURMA, A.NUM_CHAMADA, A.ALUNO_ID, A.NOME_COMPL, F.FALTA_ID
						FROM 
							Aluno A
							INNER JOIN AlunosTurma AT	ON AT.ALUNO_ID = A.ALUNO_ID
							INNER JOIN Agenda AG 		ON AG.TURMA = AT.TURMA
							LEFT  JOIN Falta F 			ON F.AGENDA = AG.AGENDA AND F.ALUNO_ID = A.ALUNO_ID
						WHERE 
							AG.AGENDA = $id
						ORDER BY 
							A.NUM_CHAMADA";
			$dRS = $conexao->query($sql);
			if ($dRS->num_rows) {
				while ($row = $dRS->fetch_assoc()) {
			?>
					<tr>
						<td class="text-center"><?= $row['NUM_CHAMADA'] ?></td>
						<td class="text-center  d-none d-md-table-cell"><?= $row['ALUNO_ID'] ?></td>
						<td class="text-left ellipsis"><?= $row['NOME_COMPL'] ?></td>
						<td class="text-center falta_container">
							<?
							if ($row['FALTA_ID']) {
								$data_class  = 'btn-danger';
								$data_action = 'exclui';
								$data_falta  = $row['FALTA_ID'];
								$data_label  = 'AUSENTE';
							} else {
								$data_class  = 'btn-success';
								$data_action = 'registra';
								$data_falta  = '';
								$data_label  = 'PRESENTE';
							}
							?>
							<button class="btn <?= $data_class ?> falta" data-action="<?= $data_action ?>" data-agenda="<?= $id ?>" data-aluno="<?= $row['ALUNO_ID'] ?>" data-falta="<?= $data_falta ?>">
								<?= $data_label ?>
							</button>
						</td>
					</tr>
			<?
				}
			}
			?>
		</tbody>
	</table>

</div>
<script>
	$(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		$(".falta").on('click', function() {
			_this = $(this);
			_action = $(this).data('action');
			_agenda = $(this).data('agenda');
			_aluno = $(this).data('aluno');
			_falta = $(this).data('falta');

			if (_action == 'registra') {
				var data = {
					AGENDA_ID: _agenda,
					ALUNO: _aluno,
					USUARIO_ID: 1
				};
				$.ajax({
					url: "https://api.grupo5x5.cloud/falta/",
					type: "POST",
					data: JSON.stringify(data),
					contentType: "application/json",
					success: function(data) {
						_this.removeClass('btn-success').addClass('btn-danger').text('AUSENTE');
						_this.attr('data-action', 'exclui');
						_this.attr('data-falta', data.Falta[0].FALTA_ID);
						Toast.fire({
							icon: 'success',
							title: 'Falta do aluno RA ' + _aluno + ' registrada com sucesso!'
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log("Erro:", textStatus, errorThrown);
					}
				});
			} else if (_action == 'exclui') {
				$.ajax({
					url: 'https://api.grupo5x5.cloud/falta/' + _falta,
					type: 'DELETE',
					dataType: 'json',
					success: function(data) {
						_this.removeClass('btn-danger').addClass('btn-success').text('PRESENTE');
						_this.attr('data-action', 'registra');
						_this.attr('data-falta', '');
						Toast.fire({
							icon: 'success',
							title: 'Falta do aluno RA ' + _aluno + ' excluída com sucesso!'
						});
					}
				});
			}

		});

		$(".exclui_falta").on('click', function() {

		});

	});
</script>