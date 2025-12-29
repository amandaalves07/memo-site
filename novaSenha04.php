<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Alteração de senha</title>
		<style>
			.erro-container {
				background: white;
				padding: 30px 40px;
				border-radius: 12px;
				box-shadow: 0 4px 15px rgba(0,0,0,0.15);
				max-width: 450px;

				/* centralização */
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				text-align: center;
				font-family: Arial, sans-serif;
			}

			.erro-container h2 {
				margin-top: 0;
				color: #cc0000;
				font-size: 22px;
			}

			.erro-container a {
				color: #0055cc;
				font-weight: bold;
				text-decoration: none;
			}

			.erro-container a:hover {
				text-decoration: underline;
			}

			.erro-container button{
				background-color: #ccc;
				color: #333;
				border-radius: 8px;
				font-weight: 600;
				font-size: 1rem;
				text-decoration: none;
				cursor: pointer;
			}

			.sucesso-container {
    		background: white;
    		padding: 30px 40px;
    		border-radius: 12px;
    		box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    		max-width: 450px;

    		/* centralização */
    		position: absolute;
    		top: 50%;
    		left: 50%;
    		transform: translate(-50%, -50%);
    		text-align: center;
    		font-family: Arial, sans-serif;
			}

			.sucesso-container h2 {
				margin-top: 0;
				color: #008000; /* verde */
				font-size: 22px;
			}

			.sucesso-container a {
				color: #0055cc;
				font-weight: bold;
				text-decoration: none;
			}

			.sucesso-container a:hover {
    		text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<?php
			$formOK=true;
			if(isset($_POST["t"])){
				$t=$_POST["t"];
			}
			if(isset($_POST["senhaNova1"])){
				$senhaNova1=$_POST["senhaNova1"];
			}
			if(isset($_POST["senhaNova2"])){
				$senhaNova2=$_POST["senhaNova2"];
			}
			if(empty($senhaNova1) || empty($senhaNova2)){
				echo ("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Preencha corretamente as senhas!</p>
					</div>");
				$formOK=false;
			}
			if(empty($t)){
				echo("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Token não informado!</p>
					</div>");
				$formOK=false;
			}

			require ("cryp2graph.php");

			if(!validarFormatoSenha($senhaNova2)){
				$formOK=false;
				echo("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>A senha não está no formato exigido!</p><br>
					</div>");
			}

			if (!$formOK){
				// echo('<br><button onclick="history.go(-1);">Voltar</button><br>');
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p><button onclick='history.go(-1);'>Voltar</button></p><br>
							<p>Verifique os erros indicados acima!!</p>
						</div>");
			}

			if($senhaNova1!==$senhaNova2) {
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>As senhas não conferem!</p>
							</div>");
			}

			require ("bdconnecta.php");

			$sql="SELECT id, senha, validadeToken FROM usuario WHERE tokenDeRedefinicao=?";
			$stmt=mysqli_prepare($conn, $sql);
			if (!$stmt) {
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível preparar a consulta!</p>
						</div>");
			}
			if (!mysqli_stmt_bind_param($stmt, "s", $t)) {
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível vincular parâmetros!</p>
						</div>");
			}
			if (!mysqli_stmt_execute($stmt)) {
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível executar busca no Banco de Dados!</p>
						</div>");
			}
			if (!mysqli_stmt_bind_result($stmt, $id, $senhaBD, $validadeToken)) {
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível vincular resultados!</p>
						</div>");
			}
			$fetch=mysqli_stmt_fetch($stmt);
			if (!$fetch) {
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível recuperar dados!</p>
						</div>");
			}
			if (!mysqli_stmt_close($stmt)) {
				echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível efetuar limpeza da conexão. Avise o setor de TI!</p>
						</div>");
				// Mandar email/sms/alerta para o Programador
			}

			if(!$fetch){
				// echo("Usuário não localizado! <br>");
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Usuário não localizado!</p> <br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			}

			if (strtotime($validadeToken)<=time()) {
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Link expirado!</p>
						</div>");
			}

			if(ChecaSenha($senhaNova2, $senhaBD)) {
					die('
						<div class="erro-container">
							<h2>Erro!</h2><br>
							<p>A nova senha não pode ser igual à senha atual!</p><br>
							<p><button onclick="history.go(-1);">Voltar</button></p>
						</div>');
			}

			if(PermiteSenha($id, $senhaNova2)){
				$cadOK=true;
				//se não foi usada, cadastrar na tabela de pessoas
				$senha=FazSenha($id, $senhaNova2);
				$sql="UPDATE usuario SET senha=? WHERE id=?";
				$stmt=mysqli_prepare($conn,$sql);
				if (!$stmt){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível preparar o cadastro!</p>
						</div>");
				}
				if (!mysqli_stmt_bind_param($stmt, "ss", $senha, $id)){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível vincular parâmetros!</p>
						</div>");
				}
				if (!mysqli_stmt_execute($stmt)){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível cadastrar a nova senha no BD!</p>
						</div>"); 
					$cadOK=false;
				}
				if(!$cadOK){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível inserir dados de senha para esta pessoa! Verifique!</p>
						</div>");
				}
				if (!mysqli_stmt_close($stmt)){
					echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.</p>
						</div>");
					//mandar email/sms/alerta para o programador
				}

				//agora, atualizar na tabela de senhas
				$sql2="INSERT INTO senhasantigas (id, senhaAnt) VALUES (?,?)";
				$stmt2=mysqli_prepare($conn,$sql2);
				if (!$stmt2){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível preparar o cadastro!</p>
						</div>");
				}
				if (!mysqli_stmt_bind_param($stmt2, "ss", $id, $senha)){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível vincular parâmetros!</p>
						</div>");
				}
				if (!mysqli_stmt_execute($stmt2)){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível cadastrar a nova senha no BD!</p>
						</div>"); 
					$cadOK=false;
				}
				if(!$cadOK){
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível inserir dados de senha para esta pessoa! Verifique!</p>
						</div>");
				}
				if (!mysqli_stmt_close($stmt2)){
					echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.</p>
						</div>");
					//mandar email/sms/alerta para o programador
				}
				echo("
						<div class='sucesso-container'>
							<h2>Sucesso!</h2><br>
							<p>Senha alterada com sucesso! <a href='login01.php'>Faça o login</a>!</p><br>
						</div>");

				//apagando senhas antigas da tabela de senhas antigas
				ApagarSenhasAnt($id);
			} else {
				// echo ("A senha nova não pode ser igual a uma senha usada anteriormente! <br>");
				die('
						<div class="erro-container">
							<h2>Erro!</h2>
							<p>A senha nova não pode ser igual a uma senha usada anteriormente!</p>
							<p><button onclick="history.go(-1);">Voltar</button></p>
						</div>');
			}
			mysqli_close($conn);
		?>
	</body>
</html>