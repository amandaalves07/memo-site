<?php
	require ("ses_start.php");
	require ("bdconnecta.php");

	if(isset($_POST['tarefasF'])){
		$idTarefa=$_POST['tarefasF'];
	} else if(isset($_POST['idTarefa'])){
		$idTarefa=$_POST['idTarefa'];
	}
	if(empty($idTarefa)){
		die("ID deve ser preenchido!");
	}

	$sql="DELETE FROM tarefas WHERE idTarefa=?";
	$stmt=mysqli_prepare($conn, $sql);

	if (!$stmt){
		die("Não foi possível preparar o cadastro!");
	}

	if (!mysqli_stmt_bind_param($stmt, "s", $idTarefa)){
		die("Não foi possível vincular parâmetros!");
	}

	if (!mysqli_stmt_execute($stmt)){
		echo(mysqli_error($conn));
		die("Não foi possível excluir tarefa do BD! <br>");
	}

	if (!mysqli_stmt_close($stmt)){
		die("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
		//mandar email/sms/alerta para o programador
	}
	header("Location: agenda.php");
?>