<?php
	require ("ses_start.php");
	$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Modificar tarefa</title>
		<link rel="stylesheet" href="res/style/global.css">
		<link rel="stylesheet" href="res/style/modTarefa01.css">
		<link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
		<script src="funcoes.js"></script>
		<?php
			if(isset($_POST['tarefasP'])){
				$idTarefa=$_POST['tarefasP'];
			}
			if(empty($_POST['tarefasP'])){
				die("ID deve ser preenchido!");
			}

			require ("bdconnecta.php");

			$sql="SELECT nome, data, hora FROM tarefas WHERE idTarefa=?";

			$stmt=mysqli_prepare($conn,$sql);
			if (!$stmt) {
				die("Não foi possível preparar a consulta!");
			}
			if (!mysqli_stmt_bind_param($stmt, "s", $idTarefa)) {
				die("Não foi possível vincular parâmetros!");
			}
			if (!mysqli_stmt_execute($stmt)) {
				die("Não foi possível executar busca no Banco de Dados!");
			}
			if (!mysqli_stmt_bind_result($stmt, $nome, $data, $hora)) {
				die("Não foi possível vincular resultados");
			}

			$fetch=mysqli_stmt_fetch($stmt);
			
			if (!mysqli_stmt_close($stmt)){
				echo("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
				//mandar email/sms/alerta para o programador
			}

			if (!$fetch) {
				//nada foi encontrado
				echo("Dados da tarefa não foram encontrados! <br>");
				die("Retorne para a <a href='login01.php'>página de login</a>!");
			}
		?>
	</head>
	<body>
		<nav class="navbar">
      <div class="navbar-left">
        <a href="index.php" class="navbar-logo">MEMO</a>
      </div>
      <ul class="navbar-links">
        <?php
            if($_SESSION['perfil']=="A") echo('<li><a href="addArt01.php">Adicionar artigo</a></li>');
        ?>
        <li><a href="agenda.php">Acessar a agenda</a></li>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="contatos.php">Sobre nós</a></li>
      </ul>
    </nav>
		
		<main class="modTarefa-page">
			<form name="form1" class="formAtualizar" action="modTarefa02.php" method="POST" onsubmit="return validaFormTarefa()">
				<h2>Modifcar tarefa</h2><br>
				<input type="hidden" name="idTarefa" value="<?php echo($idTarefa); ?>">
				<p>Nome da tarefa:</p> <input type="text" name="nome" id="name" value="<?php echo($nome); ?>">
				<p>Data:</p> <input type="date" name="data" id="date" value="<?php echo("$data"); ?>"> <br>
				<p>Hora:</p> <input type="time" v-model="hours" name="hora" id="time" value="<?php echo("$hora"); ?>">
				<br>
				<input type="submit" name="enviar" value="Atualizar tarefa">
			</form>
			<br>

			<form name="formFeita" class="formTarefaFeita" action="modStatus.php" method="POST">
					<input type="hidden" name="idTarefa" value="<?php echo($idTarefa); ?>">
					<input type="submit" name="enviar" value="Marcar como feita">
			</form>
			<br>

			<form name="formExc" class="formExcluir" action="excTarefa.php" method="POST">
				<input type="hidden" name="idTarefa" value="<?php echo($idTarefa); ?>">
				<input type="submit" name="enviar" onclick="return confirmDeleteTarefa()" value="Excluir tarefa">
			</form>
			<br>
		</main>
	</body>
</html>