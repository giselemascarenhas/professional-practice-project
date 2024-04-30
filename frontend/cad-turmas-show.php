<?
//$mssql = 1; $params = array(); $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET ); // microsoft sql server será utilizado nesta página
require 'inc/config.php';
require 'inc/check-session.php';

$rootDir	= realpath($_SERVER["DOCUMENT_ROOT"]);
$sucesso	= 0;
$id 		= anti_injection($_REQUEST['id']);
?>
<div class="card-body">
	
	<div id="card-content" class="card card-primary card-outline">

		<table class="table table-hover text-nowrap table-striped">
			<thead>
				<tr>
					<th class="text-center d-none d-md-table-cell">#</th>
					<th class="text-center d-none d-md-table-cell">RA</th>
					<th class="text-left d-none d-md-table-cell">Aluno</th>
				</tr>
			</thead>
			<tbody>
				<? 
				$sql = "SELECT A.ALUNO_ID, A.NOME_COMPL, A.NUM_CHAMADA
						FROM Aluno A INNER JOIN AlunosTurma AT ON AT.ALUNO_ID = A.ALUNO_ID
						WHERE AT.TURMA = '$id'
						ORDER BY A.NUM_CHAMADA";
				$dRS = $conexao->query($sql);
				if ($dRS-> num_rows) {
					while ( $row = $dRS->fetch_assoc() ) {
					?>
				<tr>
					<th class="text-center d-none d-md-table-cell"><?=$row['NUM_CHAMADA']?></th>
					<th class="text-center d-none d-md-table-cell"><?=$row['ALUNO_ID']?></th>
					<th class="text-left d-none d-md-table-cell"><?=$row['NOME_COMPL']?></th>
				</tr>
					<?
					}
				}
				?>
			</tbody>
		</table>

	</div>
</div>
<!-- /.card-body -->