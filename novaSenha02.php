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

			if (isset($_POST['email'])){
				$email=$_POST['email'];
			}
			if (empty($email)){
				$formOK=false;
				echo("
					<div class='erro-container'>
						<p>Preencha o e-mail!</p><br>
					</div>");
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					echo ("
						<div class='erro-container'>
							<p>O email informado não é válido!</p><br>
						</div>");
					$formOK=false;
			}

			if (!$formOK){
				// echo('<button onclick="history.go(-1);">Voltar</button><br>');
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p><button onclick='history.go(-1);'>Voltar</button></p><br>
						<p>Verifique os erros indicados acima!</p>
					</div>");
			}

			require ("bdconnecta.php");
			require ("cryp2graph.php");
			require ("email.php");

			$sql="SELECT id, nome FROM usuario WHERE email=?";
			$stmt = mysqli_prepare($conn,$sql);
			if (!$stmt) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Não foi possível preparar a consulta!</p>
					</div>");
			}
			if (!mysqli_stmt_bind_param($stmt, "s", $email)) {
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
			if (!mysqli_stmt_bind_result($stmt, $id, $nome)) {
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

			if($fetch==null){
				// echo("E-mail não localizado! <br>");
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>E-mail não localizado!</p><br>
						<p>Retorne para a <a href='index.php'>página de login</a>!</p>
					</div>");
			} else {
				$tokenDeRedefinicao=CriaAlgo(8);
				$token=FazSenha($id, $tokenDeRedefinicao); //criptografando token
				$validadeToken=date("Y-m-d H:i:s", time()+60*30);
				$message="Clique <a href='https://tccmemo.gt.tc/novaSenha03.php?t=$token'>aqui</a> para redefinir sua senha";

				$resultadoEmail=mandarEmail($nome, $email,"Recuperação de Senha",$message);
				if (!$resultadoEmail){
					die("
						<div class='erro-container'>
							<p>Não foi possível enviar e-mail com nova senha!</p>
						</div>");
				}

				//inserindo token e validade do token no banco de dados
				$sql2="UPDATE usuario SET tokenDeRedefinicao=?, validadeToken=? WHERE id=?";
				$stmt2=mysqli_prepare($conn,$sql2);
				if (!$stmt2) {
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível preparar a consulta!</p><br>
							<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
						</div>");
				}
				if (!mysqli_stmt_bind_param($stmt2, "sss", $token, $validadeToken, $id)) {
					die("Não foi possível vincular parâmetros!");
				}
				if (!mysqli_stmt_execute($stmt2)) {
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível executar busca no Banco de Dados!</p><br>
							<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
						</div>");
				}
				if (!mysqli_stmt_close($stmt2)) {
					echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Não foi possível efetuar limpeza da conexão. Avise o setor de TI!</p>
							<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
						</div>");
					// Mandar email/sms/alerta para o Programador
				}
				mysqli_close($conn);

				echo('
					<div class="sucesso-container">
						<h2>E-mail enviado!</h2>
						<p>Link para redefinição de senha enviado! Verifique sua caixa de entrada (e também o SPAM, etc.)!</p><br>
						<p><a href="index.php">Voltar para a página inicial</a></p>
					</div>');
			}
		?>
	</body>
</html>
	