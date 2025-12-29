<?php
	require ("ses_start.php");
	$id=$_SESSION['id'];

	require ("bdconnecta.php");

	$sql="DELETE FROM usuario WHERE id=?";
	$stmt=mysqli_prepare($conn, $sql);

	if (!$stmt){
		die("Não foi possível preparar o cadastro!");
	}

	if (!mysqli_stmt_bind_param($stmt, "s", $id)){
		die("Não foi possível vincular parâmetros!");
	}

	if (!mysqli_stmt_execute($stmt)){
		echo(mysqli_error($conn));
		die("Não foi possível excluir usuário do BD! <br>");
	}

	if (!mysqli_stmt_close($stmt)){
		die("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
		//mandar email/sms/alerta para o programador
	}

	$sql2="DELETE FROM senhasantigas WHERE id=?";
	$stmt2=mysqli_prepare($conn, $sql2);

	if (!$stmt2){
		die("Não foi possível preparar o cadastro!");
	}

	if (!mysqli_stmt_bind_param($stmt2, "s", $id)){
		die("Não foi possível vincular parâmetros!");
	}

	if (!mysqli_stmt_execute($stmt2)){
		echo(mysqli_error($conn));
		die("Não foi possível excluir senhas do BD! <br>");
	}

	if (!mysqli_stmt_close($stmt2)){
		die("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
		//mandar email/sms/alerta para o programador
	}

	unset($_SESSION['idSessao']);
	session_unset();
    session_destroy();

	header("Location: index.php");
	exit;
?>