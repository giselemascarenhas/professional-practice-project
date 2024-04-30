<?
require 'inc/config.php';
require 'inc/check-session.php';

$curr_menu  = 'presencas';
$curr_item	= 'reg-presenca';
$curr_title = 'Registrar Presença';
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
									<h3 class="card-title">Selecione o Professor</h3>
								</div>
								<div class="card-body">
									<div class="col-12">
										<div class="form-group">
											<label>Professor</label>
											<select class="form-control professor" name="professor" style="font-size: 1.2rem;" disabled>
												<option value="">Selecione</option>
												<?
												$sql = "SELECT NUM_FUNC, NOME_COMPL FROM Professor WHERE NUM_FUNC IN ( SELECT DISTINCT NUM_FUNC FROM Agenda ) ORDER BY NOME_COMPL";
												$tRS = $conexao->query($sql);
												if ($tRS->num_rows) {
													while ($row = $tRS->fetch_assoc()) { ?>
														<option value="<?= $row['NUM_FUNC'] ?>" data-professor="<?= $row['NOME_COMPL'] ?>"><?= $row['NOME_COMPL'] ?></option>
												<? }
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div><!-- /.card -->

							<div class="card card-info">
								<div class="card-header">
									<h3 class="card-title">Atualização das Aulas</h3>
								</div>

								<div class="card-body table-responsive">

									<div class="row">
										<div class="col-12 col-md-6 col-lg-4 aulas">
											<div class="card card-primary card-outline box-holder d-none">
												<div class="card-body box-profile">
													<div class="text-center"><b>PROFESSOR</b></div>
													<h3 class="profile-username text-center"></h3>

													<div class="timeline timeline-inverse">
														<!-- timeline time label -->
														<div class="time-label">
															<span class="bg-danger">
																<div class="form-group m-0">
																	<div class="input-group date" id="classdate" data-target-input="nearest">
																		<input type="text" class="form-control datetimepicker-input" data-target="#classdate">
																		<div class="input-group-append" data-target="#classdate" data-toggle="datetimepicker">
																			<div class="input-group-text"><i class="fa fa-calendar"></i></div>
																		</div>
																	</div>
																</div>
															</span>
														</div><!-- /.timeline-label -->
													</div>
												</div>
												<!-- /.card-body -->
											</div>
										</div>
										<div class="col-12 col-md-6 col-lg-8 lista-alunos">

										</div>
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

	<template id="template">
		<div class="item-holder">
			<i class="fas fa-chalkboard bg-info mt-3"></i>

			<div class="timeline-item">
				<h2 class="timeline-header border-0 text-bold mt-0"><span class="item-turma">item-turma</span></h2>
				<div class="time"><span class="item-inicio">item-hora-inicio</span> a <span class="item-fim">item-hora-fim</span></div>
				<h2 class="timeline-header border-0"><span class="item-nome">item-nome-disciplina</span> (<span class="item-disciplina">item-disciplina</span>)</h2>
			</div>
		</div><!-- item-holder -->
	</template>

	<!-- InputMask -->
	<script src="plugins/moment/moment-with-locales.min.js"></script>
	<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Toastr -->
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<script src="plugins/toastr/toastr.min.js"></script>

	<style type="text/css">
		.box-profile { min-height: 350px; }
		.timeline-item { cursor: pointer; }
		.timeline-item.selected { border: 2px solid red !important; }
		.table td, .table th { padding: .5rem !important; vertical-align: middle; border-top: 1px solid #dee2e6; }
		@media only screen and (max-width: 800px) {
			.ellipsis {  max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
		}
	</style>

	<script language="javascript">
		var professor;
		var arr_agenda;
		var randNumber = <?=rand()?>;

		function iterateData() {
			$(".item-holder").remove();
			$.each(arr_agenda, function(index, item) {
				fillTemplate(item.AGENDA, item.TURMA, item.HORA_INICIO, item.HORA_FIM, item.NOME_DISCIPLINA, item.DISCIPLINA);
			});
			$(".timeline-item").on('click', function() {
				$(".timeline-item").removeClass('selected');
				$(this).addClass('selected');
				$loadingDiv.show();
				agenda = $(this).data('agenda');
				showAgenda(agenda);
			});
		}

		function fillTemplate(agenda,turma, inicio, fim, nome, disciplina) {
			template = $('#template');
			var node = template.prop('content');
			var link = $(node).find('.timeline-item'); link.attr('data-agenda', agenda);
			$(node).find('.item-turma').text(turma);
			$(node).find('.item-inicio').text(inicio);
			$(node).find('.item-fim').text(fim);
			$(node).find('.item-nome').text(nome);
			$(node).find('.item-disciplina').text(disciplina);
			$('.timeline').append(template.html());
		}

		function showAgenda(agenda) {
			$('.lista-alunos').load('cad-agenda-show.php?id=' + agenda + '&rand=' + randNumber,function(){
				$loadingDiv.hide();
			});
		}

		$(function() {

			$(".professor").removeAttr('disabled').on('change', function(){
				professor = $(this).val();
				nome_professor = $(this).find('option:selected').data('professor');
				$(".profile-username").text( nome_professor );
				$(".box-holder").removeClass('d-none');

				$(".item-holder").remove(); //remove os botões das turmas
				$(".lista-alunos").text(''); //remove a listagem de alunos

				$("#classdate").datetimepicker("clear");
			});

			//Date picker
			$('#classdate').datetimepicker({
				locale: 'pt-br',
				format: 'L',
				useCurrent: false,
				widgetPositioning: {
					horizontal: 'auto',
					vertical: 'bottom'
				}
			});

			$("#classdate").on("change.datetimepicker", function(e) {
				currentDate = moment(e.date).format("YYYY-MM-DD");
				var previousDate = $(this).datetimepicker('viewDate'); previousDate = moment( previousDate ).format("YYYY-MM-DD");
				
				$(".item-holder").remove(); //remove os botões das turmas

				//if ( previousDate != currentDate && currentDate != 'Invalid date' && previousDate != null ) {
					$.ajax({
						type: "GET",
						url: "https://api.grupo5x5.cloud/agenda/" + currentDate + "/" + professor,
						success: function(data) {
							console.log(data);
							if ( data != undefined ) {
								arr_agenda = data.Agenda;
								iterateData();
							} else {
								_html = '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + 
                  						'<h5><i class="icon fas fa-info"></i> Atenção!</h5>Não há aulas para o professor' + professor + ' na data selecionada.</div>';
							}

						}
					});
				//}
			});

			if ($(".table").length) {
				var table = $('.table').DataTable({
					language: { "url": "plugins/datatables/Portuguese-Brasil.json" },
					pagingType: "numbers", stateSave: true, responsive: true, pageLength: 10
				});

				table.on('responsive-resize', function(e, datatable, columns) {
					var count = columns.reduce(function(a, b) { return b === false ? a + 1 : a; }, 0);
					$(this).attr('width', '100%');
				});
			}
		});
	</script>


</body>

</html>