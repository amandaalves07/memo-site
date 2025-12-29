<?php
	require ("ses_start.php");
	$id=$_SESSION['id'];

	require ("bdconnecta.php");

    $sql="SELECT nome, email, dataNasc, sexo, tel FROM usuario WHERE id=?";

    $stmt=mysqli_prepare($conn,$sql);
    if (!$stmt) {
        die("Não foi possível preparar a consulta!");
    }
    if (!mysqli_stmt_bind_param($stmt, "s", $id)) {
        die("Não foi possível vincular parâmetros!");
    }
    if (!mysqli_stmt_execute($stmt)) {
        die("Não foi possível executar busca no Banco de Dados!");
    }
    if (!mysqli_stmt_bind_result($stmt, $nome, $email, $dataNasc, $sexo, $tel)) {
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
    mysqli_close($conn);

    if ($fetch==null) {
        //nada foi encontrado
        echo("Dados do usuário não foram encontrados! <br>");
        die("Retorne para a <a href='login01.php'>página de login</a>!");
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Alterar dados pessoais</title>
		<script src="funcoes.js"></script>
		<link rel="stylesheet" href="res/style/style.css">
        <link rel="stylesheet" href="res/style/modUser01.css">
        <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
	</head>
	<body>
		<!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <a href="index.php" class="navbar-logo">MEMO</a>
            </div>
            <ul class="navbar-links">
                <li><a href="index.php">Página Inicial</a></li>
                <!-- <li><a href="download.html">Download</a></li> -->
                <li><a href="contatos.php">Sobre nós</a></li>
            </ul>
        </nav>

        <main>
            <section id="profile">
                <div class="info-profile">
                	<form name="form1" action="modUser02.php" method="POST" enctype="multipart/form-data" onsubmit="return validaFormModUser()">

                        <div class="modUser-title">Modificar informações</div>
                        <br>
                        
	                    <div class="info-profile-bit">
	                        <h2 class="profile-desc">Nome:</h2>
	                        <input type="text" id="userName" name="nome" value="<?php echo($nome); ?>" required>
	                    </div>
                        <br>
	                    <br>
	                	<div class="info-profile-bit">
	                        <h2 class="profile-desc">Data de Nascimento:</h2>
	                        <input type="date" id="birthDate" name="dataNasc" value="<?php echo($dataNasc); ?>" required>
	                    </div>
                        <br>

	                    <div class="info-profile-bit">
	                    	<h2 class="profile-desc">Sexo:</h2>
	                    	<select id="sexo" name="sexo">
	                            <option value="F" <?php if($sexo=="F"){ echo('selected'); } ?> >Feminino</option>
	                            <option value="M" <?php if($sexo=="M"){ echo('selected'); } ?> >Masculino</option>
	                            <option value="N" <?php if($sexo=="N"){ echo('selected'); } ?> >Prefiro não informar</option>
	                        </select>
	                    </div>
                        <br>

	                    <div class="info-profile-bit">
	                        <h2 class="profile-desc">Telefone:</h2>
	                        <input type="tel" id="phone" name="tel" value="<?php echo($tel); ?>" required>
	                    </div>
                        <br>

	                    <div class="info-profile-bit">
	                        <h2 class="profile-desc">E-mail:</h2>
	                        <input type="email" id="email" name="email" value="<?php echo($email); ?>" required>
	                    </div>
                        <br>

	                    <input type="submit" name="enviar" value="Salvar alterações">
                	</form>
                </div>
            </section>
        </main>
	</body>
</html>