<?php 
	$conn = mysqli_connect("sql207.infinityfree.com","if0_40106623","MeMo2023","if0_40106623_memo");
	// $conn = mysqli_connect("localhost", "root", "", "if0_40106623_memo");

	if(!$conn){
		//echo(mysqli_connect_error());
		die("<br>Não foi possível conectar ao banco de dados");
	}
	date_default_timezone_set('Brazil/East');
	mysqli_query($conn, "SET NAMES 'utf8'");
?>