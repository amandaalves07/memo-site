<?php
	$formOK=true;
	if(isset($_GET["t"])){
		$t=$_GET["t"];
	}
	if(empty($t)){
		echo("
			<div class='erro-container'>
				<h2>Erro!</h2><br>
				<p>Token não informado!</p><br>
				<p><button onclick='history.go(-1);'>Voltar</button></p>
			</div>");
		$formOK=false;
	}

	if (!$formOK){
		// echo('<br><button onclick="history.go(-1);">Voltar</button><br>');
		die('
			<div class="erro-container">
				<h2>Erro!</h2><br>
				<p><button onclick="history.go(-1);">Voltar</button></p><br>
				<p>Verifique os erros indicados acima!!</p>
			</div>');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Redefinição de senha</title>
		<link rel="stylesheet" type="text/css" href="res/style/novaSenha03.css">
		<script src="funcoes.js" async></script>
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
		<main>
			<form class="baseform" name="form1" action="novaSenha04.php" method="POST" onsubmit="return validaFormNovaSenha3()">
				<input type="hidden" name="t" value="<?php echo($t) ?>">
				<h2 id="titAltSenha">Alteração de senha</h2>

				<div class="form-container" id="login-form">
					<div class="password-information">
						<!--div contendo informações da formatação de senha-->
						<b><p class="password-requirements">Sua senha nova deve conter:</p></b>
						<div id="password-length" class="password-requirements">8 ou mais caracteres</div>
						<div id="password-uppercase" class="password-requirements">1 letra maiúscula</div>
						<div id="password-lowercase" class="password-requirements">1 letra minúscula</div>
						<div id="password-number" class="password-requirements">1 número</div>
						<div id="password-symbol" class="password-requirements">1 caractere especial</div>
					</div>
					<div class="input-container">
						<b><label for="senhaNova1" class="form-label">Senha nova:</label></b>
						<input type="password" placeholder="Insira sua nova senha" name="senhaNova1" id="senhaNova1" class="form-input" required oninput="validarSenha(this)">
					</div>
					<div class="input-container">
						<b><label for="senhaNova2" class="form-label">Confirme a nova senha:</label></b>
						<input type="password" placeholder="Confirme sua nova senha" name="senhaNova2" id="senhaNova2" class="form-input" required oninput="validarSenha(this)">
					</div>
					<div id="erroSenhaAnt" style="color: red;"></div>
					<div id="erroSenhaNova1" style="color: red;"></div>
					<div id="erroSenhaNova2" style="color: red;"></div>
					<input type="submit" class="form-button" name="login" id="btnEntre" value="Salvar">
				</div>
      		</form>
		</main>
	</body>
</html>