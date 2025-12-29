<?php
	require ("ses_start.php");
	$perfil=$_SESSION['perfil'];
	if($perfil!="A") header("Location: user.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Adicionar artigo</title>
		<link rel="stylesheet" href="res/style/global.css">
		<link rel="stylesheet" href="res/style/addArt01.css">
		<link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
		<script>
			function voltar(){
				window.location.href='user.php';
			}
		</script>
	</head>
	<body>
		<form name="form1" action="addArt02.php" method="POST" enctype="multipart/form-data">
			Título: <input type="text" name="titulo" id="title"> <br>
			Subtítulo: <input type="text" name="subtitulo" id="subtitle"> <br>
			Resumo: <input type="text" name="resumo" id="brief"> <br>
			Autores: <input type="text" name="autores" id="authors"> <br>
			Link DOI: <input type="text" name="link" id="link"> <br>
			Imagem: <input type="file" name="foto" id="image"> <br>
			Fonte: <input type="text" name="fonte" id="source"><br>
			<div class="button-row">
				<input type="submit" name="enviar" value="Salvar">
			</div>
			<a href="user.php" class="btnVoltar">Voltar para o perfil</a>
		</form>
	</body>
</html>