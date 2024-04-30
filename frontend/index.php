<?
require 'inc/config.php';
require 'inc/check-session.php';

$curr_group = 'inicial';
$curr_item	= '';
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
							<h1 class="m-0">Dashboard</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="/">Inicial</a></li>
								<li class="breadcrumb-item active">Dashboard</li>
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
						<div class="col-lg-6">

							<div class="card">
								<div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Quantidade de Alunos</h3>
										<a href="javascript:void(0);">Ver Relatório</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg">820</span>
											<span>Alunos Matriculados</span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
											<span class="text-success">
												<i class="fas fa-arrow-up"></i> 12.5%
											</span>
											<span class="text-muted">No Período</span>
										</p>
									</div>
									<!-- /.d-flex -->

									<div class="position-relative mb-4">
										<canvas id="visitors-chart" height="200"></canvas>
									</div>

									<div class="d-flex flex-row justify-content-end">
										<span class="mr-2">
											<i class="fas fa-square text-gray"></i> Leads - Interessados
										</span>

										<span>
											<i class="fas fa-square text-primary"></i> Matrículas Efetivadas
										</span>
									</div>
								</div>
							</div>
							<!-- /.card -->

						</div>
						<!-- /.col-md-6 -->

						<div class="col-lg-6">

							<div class="card">
								<div class="card-header border-0">
									<div class="d-flex justify-content-between">
										<h3 class="card-title">Faturamento</h3>
										<a href="javascript:void(0);">Ver Relatório</a>
									</div>
								</div>
								<div class="card-body">
									<div class="d-flex">
										<p class="d-flex flex-column">
											<span class="text-bold text-lg">R$ 1.180.230,00</span>
											<span>Faturamento no Período</span>
										</p>
										<p class="ml-auto d-flex flex-column text-right">
											<span class="text-success">
												<i class="fas fa-arrow-up"></i> 33.1%
											</span>
											<span class="text-muted">No último Trimestre</span>
										</p>
									</div>
									<!-- /.d-flex -->

									<div class="position-relative mb-4">
										<canvas id="sales-chart" height="200"></canvas>
									</div>

									<div class="d-flex flex-row justify-content-end">
										<span class="mr-2">
											<i class="fas fa-square text-primary"></i> Este Ano
										</span>

										<span>
											<i class="fas fa-square text-gray"></i> Ano Passado
										</span>
									</div>
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

<!-- OPTIONAL SCRIPTS -->
<script src="/plugins/chart.js/Chart.min.js"></script>

<script language="javascript">
$(function() {
	if ( $(".table").length ) {
		var table = $('.table').DataTable({
			language: { "url": "plugins/datatables/Portuguese-Brasil.json" }, pagingType: "numbers", stateSave: true, responsive: true, pageLength: 10
		});

		table.on( 'responsive-resize', function ( e, datatable, columns ) {
			var count = columns.reduce( function (a, b) { return b === false ? a+1 : a; }, 0 ); 
			$(this).attr('width','100%');
		} );
	}
});
</script>

</body>
</html>