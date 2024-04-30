<?
require 'inc/config.php';
require 'inc/check-session.php';

$curr_menu = 'cadastros';
$curr_item	= 'cad-disciplina';
$curr_title = 'Disciplinas';
?>
<!DOCTYPE html>
<html lang="pt">
<? require 'inc/header.php'; ?>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		<? require 'inc/bars.php'; ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"><?= $curr_title ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="/">Inicial</a></li>
								<li class="breadcrumb-item active"><?= $curr_title ?></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">

						<div class="col">
							<div class="card card-info">
								<div class="card-header">
									<h3 class="card-title"><?= $curr_title ?></h3>
								</div>

								<div class="card-body table-responsive">

									<table class="table table-hover text-nowrap table-striped">
										<thead>
											<tr>
												<th class="text-center d-none d-md-table-cell">Código</th>
												<th class="text-center d-none d-md-table-cell">Disciplina</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>

								</div>

							</div>
							<!-- /.card -->

						</div>
						<!-- /.col-md-6 -->

					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<? require 'inc/main_footer.php'; ?>

	</div>
	<!-- ./wrapper -->

	<? require 'inc/footer.php'; ?>

<script language="javascript">
$(function() {
	var table = $('.table').DataTable({
		language: { "url": "plugins/datatables/Portuguese-Brasil.json" }, 
		pagingType: "numbers", stateSave: true, responsive: true, pageLength: 10,
		ajax: { url: 'https://api.grupo5x5.cloud/disciplina/', dataSrc: 'Disciplina' }, 
		columns: [ { data: 'DISCIPLINA' }, { data: 'NOME' } ]
	});
});
</script>

</body>

</html>