<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Fazer Login</title>
		<link rel="stylesheet" href="res/style/style.css">
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
		</style>
	</head>
	<body>
		<nav class="navbar">
        <div class="navbar-left">
            <a href="index.php" class="navbar-logo">MEMO</a>
        </div>
        <ul class="navbar-links">
            <li><a href="index.php">Artigos</a></li>
            <!-- <li><a href="download.html">Download</a></li> -->
						<li><a href="contatos.php">Contatos</a></li>
            <!-- <li><a href="login01.php" class="navbar-login-btn">Login</a></li> -->
        </ul>
    </nav>
		<?php
			session_start();
			$formOK=true;

			if(isset($_POST['email'])){
				$email=$_POST['email'];
			}
			if(isset($_POST['senha'])){
				$senha=$_POST['senha'];
			}

			if (empty($email)) {
				echo("
					<div class='erro-container'>
						<p>O e-mail precisa ser preenchido!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
				$formOK=false;
			}
			if (empty($senha)) {
				echo("
					<div class='erro-container'>
						<p>A senha precisa ser preenchida!</p>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
				$formOK=false;
			}
			
			require("bdconnecta.php");
			require ("cryp2graph.php");

			$sql="SELECT id, perfil, nome, senha FROM usuario WHERE email=?";

			$stmt=mysqli_prepare($conn,$sql);
			if (!$stmt) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Não foi possível preparar a consulta!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			}
			if (!mysqli_stmt_bind_param($stmt, "s", $email)) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Não foi possível vincular parâmetros!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			}
			if (!mysqli_stmt_execute($stmt)) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>	
						<p>Não foi possível executar busca no Banco de Dados!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			}
			if (!mysqli_stmt_bind_result($stmt, $id, $perfil, $nome, $senhaBD)) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Não foi possível vincular resultados!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			}
			$fetch=mysqli_stmt_fetch($stmt);
			if (!$fetch) {
				die("
					<div class='erro-container'>
						<h2>Erro!</h2><br>
						<p>Não foi possível recuperar dados!</p><br>
						<p>Retorne para a <a href='login01.php'>página de login</a>!</p>
					</div>");
			} else {
				if (ChecaSenha($senha, $senhaBD)) {
					//usuário acertou os dados do login
					if (session_status() !== PHP_SESSION_ACTIVE) {
						die("Não foi possível iniciar sessão!");
					}
					$_SESSION['idSessao']=session_id();
					$_SESSION['id']=$id;
					$_SESSION['perfil']=$perfil;
					$_SESSION['operador']=$email;
					$_SESSION['nomeOperador']=$nome;
					
					header("Location: user.php");
				} else {
					// echo("<div class='erro-container'></div>");
					die("
						<div class='erro-container'>
							<h2>Erro!</h2><br>
							<p>Essa combinação de E-mail/Senha não foi localizada!</p><br>
							<p> Retorne para a <a href='login01.php'>página de login</a>!</p>
						</div>");
				}
			}
		?>
	</body>
</html>