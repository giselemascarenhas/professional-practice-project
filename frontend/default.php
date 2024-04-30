<? 
require 'inc/config.php'; 

$error		= 0;
$referrer	= isset($_REQUEST['ref']) ? $_REQUEST['ref'] : 'index.php';
$email		= isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
$senha		= isset($_REQUEST['senha']) ? $_REQUEST['senha'] : '';

if ( isset($_REQUEST['action']) ) {

	if ($email == 'admin@grupo5x5.cloud' && $senha == 'admin5X5') {
		$_SESSION['usuario'] = 1;
		header("location:$referrer"); exit; 
	} else {
		$error = 1;
	}
} else if ( isset($_SESSION['usuario']) ) {
	header("location:index.php"); exit; 
}
?>
<!DOCTYPE html>
<html lang="en">
<? require 'inc/header.php'; ?>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<div class="login-logo"><img src="dist/img/logo-schoolfreq.png" width="180" title="<?=$pagetitle?>"></div>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Preencha seus dados para iniciar a sessão</p>

				<form action="?action=login" method="post">

					<? if ($error) { ?>
						<div class="callout callout-danger">
							<h5>Atenção</h5>
							<p>Dados Incorretos. Por favor, tente novamente.</p>
						</div>
					<? } ?>

					<div class="input-group mb-3">
						<input type="email" name="email" class="form-control" placeholder="E-mail">
						<div class="input-group-append">
							<div class="input-group-text"><span class="fas fa-envelope"></span></div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="senha" class="form-control" placeholder="Senha">
						<div class="input-group-append">
							<div class="input-group-text"><span class="fas fa-lock"></span></div>
						</div>
					</div>
					<div class="row mb-5">
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">Iniciar Sessão</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<div class="social-auth-links text-center mt-2 mb-3">
					<a href="#" class="btn btn-block btn-primary"><i class="fab fa-facebook mr-2"></i> Acesse com Facebook</a>
					<a href="#" class="btn btn-block btn-danger"><i class="fab fa-google-plus mr-2"></i> Acesse com Google</a>
				</div>
				<!-- /.social-auth-links -->

				<p class="mb-1">
					<a href="forgot-password.html">Esqueci Minha Senha</a>
				</p>

			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

<? require 'inc/footer.php' ?>
</body>

</html>