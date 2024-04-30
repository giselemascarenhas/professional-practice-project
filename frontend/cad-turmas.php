<?
require 'inc/config.php';
require 'inc/check-session.php';

$curr_menu  = 'cadastros';
$curr_item	= 'cad-turmas';
$curr_title = 'Turmas';
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

									<div class="btn-group w-100 mb-2">
										<a class="btn btn-success unidade active" href="javascript:void(0)" data-filter="8">ALPHAVILLE</a>
										<a class="btn btn-success unidade" href="javascript:void(0)" data-filter="7">PERDIZES</a>
										<a class="btn btn-success unidade" href="javascript:void(0)" data-filter="4">MORUMBI</a>
									</div>

									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Educação Fundamental - Anos Iniciais</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">
											<div class="row cont-EF1">
												<div class="text-center">
													<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
												</div>
											</div>
										</div>
										<!-- /.card-body -->
									</div>
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Educação Fundamental - Anos Finais</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">
											<div class="row cont-EF2">
												<div class="text-center">
													<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
												</div>
											</div>
										</div>
										<!-- /.card-body -->
									</div>
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Ensino Médio</h3>
										</div>
										<!-- /.card-header -->
										<div class="card-body">
											<div class="row cont-EM">
												<div class="text-center">
													<div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
												</div>
											</div>
										</div>
										<!-- /.card-body -->
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

	<!-- Modal -->
	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	<template id="template">
		<div class="col-lg-2 col-md-3 col-6">
			<div class="small-box bg-info show-turma">
				<div class="inner">
					<h4 class="turma"></h4>
					<p><span class="qtd"></span> Alunos</p>
				</div>
				<div class="icon"><i class="fas fa-chalkboard"></i></div>
			</div><!-- small box -->
		</div><!-- ./col -->
	</template>

	<div id="titles"></div>

	<style type="text/css">
		.lds-grid, .lds-grid div { box-sizing: border-box; }
		.lds-grid { display: block; position: relative; width: 80px; height: 80px; margin: 1rem; }
		.lds-grid div { position: absolute; width: 16px; height: 16px; border-radius: 50%; background: currentColor; animation: lds-grid 1.2s linear infinite; }
		.lds-grid div:nth-child(1) { top: 8px; left: 8px; animation-delay: 0s; }
		.lds-grid div:nth-child(2) { top: 8px; left: 32px; animation-delay: -0.4s; }
		.lds-grid div:nth-child(3) { top: 8px; left: 56px; animation-delay: -0.8s; }
		.lds-grid div:nth-child(4) { top: 32px; left: 8px; animation-delay: -0.4s; }
		.lds-grid div:nth-child(5) {top: 32px;  left: 32px; animation-delay: -0.8s; }
		.lds-grid div:nth-child(6) { top: 32px; left: 56px; animation-delay: -1.2s; }
		.lds-grid div:nth-child(7) { top: 56px; left: 8px; animation-delay: -0.8s; }
		.lds-grid div:nth-child(8) { top: 56px; left: 32px; animation-delay: -1.2s; }
		.lds-grid div:nth-child(9) { top: 56px; left: 56px; animation-delay: -1.6s; }
		@keyframes lds-grid { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }

		.show-turma { cursor: pointer; }
	</style>

	<script language="javascript">
		var unidade = 8;
		var arr_turmas;
		var randNumber = <?=rand()?>;

		function getData() {
			return $.ajax({
				url: "https://api.grupo5x5.cloud/turma/",
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					arr_turmas = data.Turmas;
					return true;
				},
				error: function(data) {
					return false;
				}
			});
		}

		function iterateData() {
			$('.cont-EF1,.cont-EF2,.cont-EM').empty();
			$.each(arr_turmas, function(index, item) {
				fillTemplate(item.TURMA, item.CURSO, item.QTD);
			});
			$(".show-turma").on('click', function() {
				$loadingDiv.show();
				turma = $(this).data('turma');
				showTurma(turma);
			});
		}

		function fillTemplate(turma, curso, qtd) {
			if (turma.charAt(0) == unidade) {
				template = $('#template');
				var node = template.prop('content');
				var link = $(node).find('.show-turma'); link.attr('data-turma', turma);
				var turm = $(node).find('.turma').text(turma);
				var quan = $(node).find('.qtd').text(qtd);
				$('.cont-' + curso).append(template.html());
			}
		}

		function showTurma(turma) {
			$('#Modal .modal-body').load('cad-turmas-show.php?id=' + turma + '&rand=' + randNumber,function(){
				$('#Modal .modal-title').html('Alunos da Turma ' + turma);
				$('#Modal').find('.modal-footer').hide();
				$('#Modal').modal({show:true});
				$loadingDiv.hide();
			});
		}

		$(function() {

			check = getData();
			$.when(check).done(function() {
				iterateData();
			});

			$(".unidade").on('click', function() {
				unidade = $(this).data('filter');
				$(".unidade").removeClass('active');
				$(this).addClass('active');
				iterateData();
			});

		});
	</script>

</body>

</html>