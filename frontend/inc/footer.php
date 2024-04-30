<style type="text/css">
.school-logo { width: 60px; }
.presente { background-color: #28a745 !important; color: #fff !important; }
.ausente { background-color: #dc3545 !important; color: #fff !important; }

</style>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard -->
<script src="/dist/js/pages/dashboard3.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.css">
<script src="/plugins/datatables/jquery.dataTables.js"> </script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"> </script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"> </script>
<script src="/plugins/datatables-neutraliseaccent/accent-neutralise.js"></script>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<script src="/plugins/sweetalert2/sweetalert2.min.js"></script>

<style type="text/css">
#loadingDiv { position: fixed; z-index:100000; top: 15px; right: 20px; color: #fff; padding:10px; border-radius:5px; background-color: var(--info); box-shadow:0 0 12px #999; display: none; }
</style>

<script language="javascript">
var $loadingDiv = $('#loadingDiv');
$(function() {
	
	$menu = $(".sidebar-mini");

	$menu.on('change',function() {
		console.log('menu changed');
		if ( $menu.hasClass('sidebar-collapse') ) {
			console.log('elem has class')
			$(".school-logo").width(40);
		} else {
			$(".school-logo").width(100);
		}
	});
});
</script>