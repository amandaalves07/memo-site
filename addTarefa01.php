<?php
	require ("ses_start.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Adicionar tarefa</title>
		<link rel="stylesheet" href="res/style/global.css">
		<link rel="stylesheet" href="res/style/addTarefa01.css">
		<link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
		<script src="funcoes.js"></script>
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
		
		<main class="adicionarTarefa-page">
			<form name="form1" action="addTarefa02.php" method="POST" onsubmit="return validaFormTarefa()">
				<h2>Adicionar tarefa</h2>
				<p>Nome da tarefa:</p> <input type="text" name="nome" id="name"> <br>
				<p>Data:</p> <input type="date" name="data" id="date"> <br>
				<p>Hora:</p> <input type="time" v-model="hours" name="hora" value="" id="time">
				<br>
				<input type="submit" name="enviar" value="Salvar tarefa"><br>
				<button id="btnVoltar" onclick="window.location.href='agenda.php'">Voltar</button>
			</form>
			
		</main>
	</body>
</html>