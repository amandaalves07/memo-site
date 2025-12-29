<?php
	require ("ses_start.php");
    $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Agenda de tarefas</title>
		<link rel="stylesheet" href="res/style/global.css">
		<link rel="stylesheet" href="res/style/agenda.css">
		<link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
		<script src="funcoes.js"></script>
		<script>
			function voltar(){
				window.location.href="user.php";
			}

			function addTarefa(){
				window.location.href="addTarefa01.php";
			}
		</script>
		<style>

		</style>
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
        <li><a href="addTarefa01.php">Adicionar nova tarefa</a></li>
        <li><a href="index.php">Página Inicial</a></li>
        <li><a href="contatos.php">Sobre nós</a></li>
      </ul>
    </nav>
		
		<?php
			require ("bdconnecta.php");

			$sql="SELECT COUNT(*) AS qtdeTarefas FROM tarefas WHERE idUsuario=?";

			$stmt=mysqli_prepare($conn, $sql);
			if (!$stmt) {
				die("Não foi possível preparar a consulta!");
			}
			if (!mysqli_stmt_bind_param($stmt, "s", $id)) {
				die("Não foi possível vincular parâmetros!");
			}
			if (!mysqli_stmt_execute($stmt)) {
				die("Não foi possível executar busca no Banco de Dados!");
			}
			if (!mysqli_stmt_bind_result($stmt, $qtdeTarefas)) {
				die("Não foi possível vincular resultados");
			}
			$fetch=mysqli_stmt_fetch($stmt);
			if (!$fetch) {
				die("Não foi possível recuperar dados");
			}
			if (!mysqli_stmt_close($stmt)){
				echo("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
				//mandar email/sms/alerta para o programador
			}

			if ($qtdeTarefas==0) {
				//nada foi encontrado
				die("
						<div class='container-semTarefa'>
							<h2>Não foi encontrada nenhuma tarefa!</h2><br>
							<button onclick='addTarefa()'> Adicionar tarefa</button><br>
							<button id='btnVoltar' onclick='voltar()'>Voltar para perfil</button>
						</div>");
			} else {
				//selecionando as tarefas pendentes
				$sql2="SELECT idTarefa, nome, data, hora FROM tarefas WHERE idUsuario=? AND status=0 ORDER BY data ASC, hora ASC";

				$stmt2=mysqli_prepare($conn, $sql2);
				if (!$stmt2) {
					die("Não foi possível preparar a consulta!");
				}
				if (!mysqli_stmt_bind_param($stmt2, "s", $id)) {
					die("Não foi possível vincular parâmetros!");
				}
				if (!mysqli_stmt_execute($stmt2)) {
					die("Não foi possível executar busca no Banco de Dados!");
				}
				$resultP=mysqli_stmt_get_result($stmt2);
				if (!mysqli_stmt_close($stmt2)){
					echo("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
					//mandar email/sms/alerta para o programador
				}

				//selecionando as tarefas feitas
				$sql3="SELECT idTarefa, nome, data, hora FROM tarefas WHERE idUsuario=? AND status=1 ORDER BY data ASC, hora ASC";

				$stmt3=mysqli_prepare($conn, $sql3);
				if (!$stmt3) {
					die("Não foi possível preparar a consulta!");
				}
				if (!mysqli_stmt_bind_param($stmt3, "s", $id)) {
					die("Não foi possível vincular parâmetros!");
				}
				if (!mysqli_stmt_execute($stmt3)) {
					die("Não foi possível executar busca no Banco de Dados!");
				}
				$resultF=mysqli_stmt_get_result($stmt3);
				if (!mysqli_stmt_close($stmt3)){
					echo("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
					//mandar email/sms/alerta para o programador
				}	
			}
		?>
		
		<main class="agenda-page">
			<div class="container-branco">

				<h1 id="listaTarefas">Lista de tarefas</h1> <br>
				
				<form name="formTarefasF" action="excTarefa.php" method="POST" onsubmit="return confirmDeleteTarefa()">
					<p>Tarefas feitas</p> <br>
						<?php
							if(mysqli_num_rows($resultF)>0){
								echo ('<select name="tarefasF">');
								while($linhaDadosF=mysqli_fetch_assoc($resultF)){
									$idTarefaF=$linhaDadosF['idTarefa'];
									$nomeF=$linhaDadosF['nome'];
									$dataF=$linhaDadosF['data'];
									$horaF=$linhaDadosF['hora'];
									$dataF_formatada=date("d/m/Y", strtotime($dataF));

									echo('<option value="'.$idTarefaF.'">'.$dataF_formatada.' - '.$horaF.': '.$nomeF.'</option>');
								}

								echo ('</select><br>');
									echo ('<input type="submit" name="excTarefa" value="Excluir tarefa feita">');
							}else {
								echo ('<p>Nenhuma tarefa feita.</p><br>');
							}
						?>
					<br>
				</form>
				<br>
				<form name="formTarefasP" action="modTarefa01.php" method="POST">
					<p>Tarefas pendentes</p> <br>
						<?php
							if(mysqli_num_rows($resultP)>0){
								echo ('<select name="tarefasP">');
								while($linhaDadosP=mysqli_fetch_assoc($resultP)){
									$idTarefaP=$linhaDadosP['idTarefa'];
											$nomeP=$linhaDadosP['nome'];
											$dataP=$linhaDadosP['data'];
											$horaP=$linhaDadosP['hora'];
											$dataP_formatada=date("d/m/Y", strtotime($dataP));

											echo('<option value="'.$idTarefaP.'">'.$dataP_formatada.' - '.$horaP.': '.$nomeP.'</option>');
								}

								echo ('</select><br>');
									echo ('<input type="submit" name="modTarefa" value=" Modificar tarefa"><br>');
							} else {
								echo ('<p>Nenhuma tarefa pendente</p><br>');
							}
						?>
				</form>
				<button onclick="addTarefa()">Adicionar Tarefa</button>
			</div>
		</main>
		<br>
	</body>
</html>