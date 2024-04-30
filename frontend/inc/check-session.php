<?
//check session
if ( !isset($_SESSION['usuario']) ) { 
	$url = basename( $_SERVER["REQUEST_URI"] );
	echo "<script>window.top.location.href = 'default.php?ref=" . urlencode($url) . "';</script>";
	
}
?>