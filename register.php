<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastro</title>
	<!-- <link rel="stylesheet" href="res/style/style.css"> --> <!-- CSS navbar -->
	<!-- <link rel="stylesheet" href="res/style/login_style.css"> -->
	 <link rel="stylesheet" href="res/style/global.css">
	<link rel="stylesheet" href="res/style/register.css">
	<script src="funcoes.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="index.php" class="navbar-logo">MEMO</a>
        </div>
        <ul class="navbar-links">
            <li><a href="index.php">Página Inicial</a></li>
            <li><a href="contatos.php">Sobre nós</a></li>
        </ul>
    </nav>
	
	<main>
		<form class="cadForm" name="form1" action="register02.php" method="POST" enctype="multipart/form-data" onsubmit="return validaFormCad()">

			<div class="form-container-cadastro" id="cadastro-form">
				<h1>Cadastre-se</h1>
				<div class="container-input-cadastro">
					<label for="name" class="label-form-cadastro">Nome:</label>
					<input type="text" placeholder="Insira seu nome..." name="nome" id="name" class="form-input-cadastro" value="" maxlength="100" required>
				</div>

				<div class="container-input-cadastro">
					<label for="birthDate" class="label-form-cadastro">Data de Nascimento:</label>
					<input type="date" name="dataNasc" id="birthDate" class="form-input-cadastro" required>
				</div>

				<div class="container-input-cadastro">
					<label for="input-sx" class="label-form-cadastro">Sexo:</label>
					<select id="input-sx" name="sexo">
						<option value="0"></option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
						<option value="N">Prefiro não informar</option>
					</select>
				</div>

				<div class="container-input-cadastro">
					<label for="phone" class="label-form-cadastro">Número de telefone/celular:</label>
					<input type="text" placeholder="Insira seu número de telefone..." name="tel" id="phone" class="form-input-cadastro" value="" maxlength="15" oninput="formatarTel(this)" required>
				</div>

				<div class="container-input-cadastro">
					<label for="email" class="label-form-cadastro">E-mail:</label>
					<input type="email" placeholder="Insira seu e-mail..." name="email" id="email" class="form-input-cadastro" value="" maxlength="150" oninput="validarEmail(this)" required>
				</div>

				<div class="container-input-cadastro">
					<label for="password" class="label-form-cadastro">Senha:</label>

					<div class="password-information">
						<input type="password" placeholder="Insira sua senha..." name="senha" id="password" class="form-input-cadastro" value="" maxlength="100" oninput="validarSenha(this)" required>
            <p class="password-requirements">Sua senha deve conter:</p>
	          <div id="password-uppercase" class="password-requirements">1 letra maiúscula</div>
	          <div id="password-lowercase" class="password-requirements">1 letra minúscula</div>
	          <div id="password-number" class="password-requirements">1 número</div>
	          <div id="password-symbol" class="password-requirements">1 caractere especial</div>
	          <div id="password-length" class="password-requirements">8 ou mais caracteres</div>	
          </div>

				</div>

				<input type="submit" class="form-button-cadastro" name="cadastrar" value="Cadastrar">
				<p id="reg-link">Possui uma conta? <a href="login01.php">Faça login aqui</a>.</p>
			</div>
			
		</form>
	</main>
</body>	
</html>