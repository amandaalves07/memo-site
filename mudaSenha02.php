<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mudança de senha</title>
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

			/* .erro-container button{
				background-color: #ccc;
				color: #333;
				border-radius: 8px;
				font-weight: 600;
				font-size: 1rem;
				text-decoration: none;
				cursor: pointer;
			} */

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
			require ("ses_start.php");
			$id=$_SESSION['id'];

			$formOK=true;
			if(isset($_POST['senhaAntiga'])){
				$senhaAntiga=$_POST['senhaAntiga'];
			}
			if(isset($_POST['senhaNova1'])){
				$senhaNova1=$_POST['senhaNova1'];
			}
			if(isset($_POST['senhaNova2'])){
				$senhaNova2=$_POST['senhaNova2'];
			}

			if (empty($_POST['senhaAntiga']) || empty($_POST['senhaNova1']) || empty($_POST['senhaNova2'])){
				$formOK=false;
				echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Preencha corretamente as senhas!</p><br>
						</div>");
			}

			if($senhaNova1!==$senhaNova2){
				$formOK=false;
				echo("
						<div class='erro-container'>
							<h2>OPA!</h2><br>
							<p>As senhas não conferem!</p><br>
						</div>");
			}

			require ("cryp2graph.php");

			//verificando formatação da senha
			if(!validarFormatoSenha($senhaNova2)) $formOK=false;

			//verificando se a senha atual está correta
			if(!senhaAtualEstaCorreta($id, $senhaAntiga)){
				$formOK=false;
				echo("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Senha atual não confere!</p><br>
						</div>");
			}

			if (!$formOK){
				// echo('<br><button onclick="history.go(-1);">Voltar</button><br>');
				die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<button onclick='history.go(-1);''>Voltar</button><br>
							Verifique os erros indicados acima!!
						</div>");
			}

			//verificando se a senha nova já foi usada ou não
			if(PermiteSenha($id, $senhaNova2)){
				$cadOK=true;
				//se não foi usada, cadastrar na tabela de senhas
				$senha=FazSenha($id, $senhaNova2);

				require ("bdconnecta.php");

				$sql="INSERT INTO senhasantigas (id, senhaAnt) VALUES (?,?)";
				$stmt=mysqli_prepare($conn,$sql);
				if (!$stmt){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível preparar o cadastro!</p><br>
							</div>");
				}

				if (!mysqli_stmt_bind_param($stmt, "ss", $id, $senha)){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível vincular parâmetros!</p><br>
							</div>");
				}

				if (!mysqli_stmt_execute($stmt)){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>	
								<p>Não foi possível cadastrar a nova senha no BD!</p><br>
							</div>"/*.mysqli_error($conn)*/); 
					$cadOK=false;
				} else {
					echo("
							<div class='sucesso-container'>
								<h2>Sucesso!</h2><br>
								<p>Sua senha foi atualizada!</p><br>
							</div>");
				}

				if(!$cadOK){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível inserir dados de senha para esta pessoa! Verifique!</p><br>
							</div>");
				}

				if (!mysqli_stmt_close($stmt)){
					echo("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível efetuar a limpeza da conexão. Avise o setor de TI!</p><br>
							</div>");
					//mandar email/sms/alerta para o programador
				}

				//agora, atualizar na tabela de pessoas
				$sql2="UPDATE usuario SET senha=? WHERE id=?";

				$stmt2=mysqli_prepare($conn,$sql2);
				if (!$stmt2){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível preparar o cadastro!</p><br>
							</div>");
				}

				if (!mysqli_stmt_bind_param($stmt2, "ss", $senha, $id)){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível vincular parâmetros!</p><br>
							</div>");
				}

				if (!mysqli_stmt_execute($stmt2)){
					die("
							<div class='erro-container'>
								<h2>Erro!</h2><br>
								<p>Não foi possível cadastrar a nova senha no BD!</p><br>
							</div>"/*.mysqli_error($conn)*/); 
					$cadOK=false;
				} else {
					echo("
							<div class='sucesso-container'>
								<h2>Sucesso!</h2><br>
								<p>Sua senha foi atualizada!</p><br>
							</div>");
				}
			} else {
				// echo ("A senha nova não pode ser igual a uma senha usada anteriormente! <br>");
				die("
							<div class='erro-container'>
								<h2>Erro!</h2>
								<p>A senha nova não pode ser igual a uma senha usada anteriormente! <a href='mudaSenha01.php'>Tente novamente</a>!</p>
							</div>");
			}

			//apagando senhas antigas
			if(!ApagarSenhasAnt($id)){
				echo(mysqli_error($conn));
			}
			mysqli_close($conn);
			header("Location: user.php")
		?>
</body>
</html>

