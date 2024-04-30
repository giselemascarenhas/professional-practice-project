		<div id="loadingDiv"><i class="fas fa-spinner fa-pulse fa-2x"></i></div>
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">Inicial</a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				<li class="nav-item">
					<a class="nav-link" data-widget="navbar-search" href="#" role="button">
						<i class="fas fa-search"></i>
					</a>
					<div class="navbar-search-block">
						<form class="form-inline">
							<div class="input-group input-group-sm">
								<input class="form-control form-control-navbar" type="search" placeholder="Pesquisar" aria-label="Search">
								<div class="input-group-append">
									<button class="btn btn-navbar" type="submit">
										<i class="fas fa-search"></i>
									</button>
									<button class="btn btn-navbar" type="button" data-widget="navbar-search">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>

				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-comments"></i>
						<span class="badge badge-danger navbar-badge">3</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										Marcio Siqueira
										<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">Me liga por favor...</p>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 horas atrás</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										João Sobrinho
										<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">Recebi sua mensagem!</p>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 horas atrás</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										Julia Campos
										<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">A reunião está marcada</p>
									<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 2 horas atrás</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">Ver todas as mensagens</a>
					</div>
				</li>
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">15 Notificações</span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-envelope mr-2"></i> 4 novas mensagens
							<span class="float-right text-muted text-sm">3 minutos</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-users mr-2"></i> 8 solicitações
							<span class="float-right text-muted text-sm">12 horas</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-file mr-2"></i> 3 novos relatórios
							<span class="float-right text-muted text-sm">2 dias</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">Ver todas Notificações</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item d-none">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<div class="row m-0">
				<div class="col text-center mt-2">
					<a href="index.php"><img src="dist/img/logo-schoolfreq-128.png" alt="<?=$pagetitle?>" class='school-logo'></a>
				</div>
			</div>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">Administrador</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item <? if ( $curr_menu == 'inicial') echo 'menu-open'; ?>">
							<a href="index.php" class="nav-link active">
								<i class="nav-icon fas fa-home"></i>
								<p>Inicial</p>
							</a>
						</li>
						<li class="nav-item <? if ( $curr_menu == 'cadastros') echo 'menu-open'; ?>">
							<a href="#" class="nav-link <? if ( $curr_item == 'cadastros') echo 'active'; ?>">
								<i class="nav-icon fas fa-clipboard"></i>
								<p>Cadastros <i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="cad-alunos.php" class="nav-link <? if ( $curr_item == 'cad-alunos') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Alunos</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="cad-disciplina.php" class="nav-link <? if ( $curr_item == 'cad-disciplina') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Disciplinas</p>
									</a>
								</li>
								<!-- <li class="nav-item">
									<a href="cad-matriculas.php" class="nav-link <? if ( $curr_item == 'cad-matriculas') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Matrícula</p>
									</a>
								</li> -->
								<li class="nav-item">
									<a href="cad-professores.php" class="nav-link <? if ( $curr_item == 'cad-professores') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Professores</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="cad-turmas.php" class="nav-link <? if ( $curr_item == 'cad-turmas') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Turmas</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item <? if ( $curr_menu == 'presencas') echo 'menu-open'; ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-check"></i>
								<p>Presenças <i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="reg-presenca.php" class="nav-link <? if ( $curr_item == 'reg-presenca') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Registrar Presença</p>
									</a>
								</li>
							</ul>
						</li>
						<!--
						<li class="nav-item <? if ( $curr_menu == 'configuracoes') echo 'menu-open'; ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-cog"></i>
								<p>Configurações <i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#conf-geral.php" class="nav-link <? if ( $curr_item == 'conf-geral') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Geral</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#conf-horarios.php" class="nav-link <? if ( $curr_item == 'conf-horarios') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Horários</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#conf-unidades.php" class="nav-link <? if ( $curr_item == 'conf-unidades') echo 'active'; ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Unidades Físicas</p>
									</a>
								</li>
							</ul>
						</li>
						-->
						<li class="nav-item"><a href="logout.php" class="nav-link"><i class="nav-icon fas fa-power-off"></i><p>Encerrar Sessão</p></a></li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>