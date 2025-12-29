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
        echo(mysqli_error($conn));
        die("Não foi possível recuperar dados");
    }
    if (!mysqli_stmt_close($stmt)){
        echo("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
        //mandar email/sms/alerta para o programador
    }

    if (!$fetch) {
        //nada foi encontrado
        echo("Dados do usuário não foram encontrados! <br>");
        die("Retorne para a <a href='login01.php'>página de login</a>!");
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title><?php echo($nome); ?></title>
    	<link rel="stylesheet" href="res/style/style.css">
        <link rel="stylesheet" href="res/style/user.css">
        <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
        <script src="funcoes.js"></script>
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-left">
                <a href="index.php" class="navbar-logo">MEMO</a>
            </div>
            <ul class="navbar-links">
                <?php
                    if(isset($_SESSION['perfil']) && $_SESSION['perfil']=="A") echo('<li><a href="addArt01.php">Adicionar artigo</a></li>');
                ?>
                <li><a href="agenda.php">Acessar agenda</a></li>
                <li><a href="index.php">Página Inicial</a></li>
                <li><a href="contatos.php">Sobre nós</a></li>
            </ul>
        </nav>

        <main>
            <section id="profile">
                <div class="info-profile">
                    <div class="info-profile-bit">
                        <h2 class="profile-desc">Nome:</h2>
                        <input type="text" value="<?php echo($nome); ?>" readonly>
                    </div>
                    
                    <div class="info-profile-bit">
                        <h2 class="profile-desc">Telefone:</h2>
                        <input type="tel" value="<?php echo($tel); ?>" readonly>
                    </div>

                    <div class="info-profile-bit">
                        <h2 class="profile-desc">E-mail:</h2>
                        <input type="email" value="<?php echo($email); ?>" readonly>
                    </div>

                     <div class="info-profile-bit">
                        <h2 class="profile-desc">Data de Nascimento:</h2>
                        <input type="date" value="<?php echo($dataNasc); ?>" readonly>
                    </div>

                    <div class="info-profile-bit">
                        <h2 class="profile-desc">Sexo:</h2>
                        <select id="sexo" name="sexo" disabled>
                            <option value="0"></option>
                            <option value="F" <?php if($sexo=="F"){ echo('selected'); } ?>>Feminino</option>
                            <option value="M" <?php if($sexo=="M"){ echo('selected'); } ?>>Masculino</option>
                            <option value="N" <?php if($sexo=="N"){ echo('selected'); } ?>>Prefiro não informar</option>
                        </select>
                    </div>
                </div>

                <div class="button-group">
                    <button onclick="window.location.href='modUser01.php'" id="btnAltDados">Alterar dados</button>
                    <button onclick="window.location.href='mudaSenha01.php'" id="btnAltSenha">Alterar senha</button>
                    <button onclick="window.location.href='sair.php'" id="btnSair">Sair da conta</button>
                    <button class="danger-btn" onclick="confirmDelete()">Excluir conta</button>
                </div>
            </section>
        </main>
    </body>
</html>