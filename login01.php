<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <!-- <link rel="stylesheet" href="res/style/style.css"> --> <!-- CSS da navbar-->
        <!--<link rel="stylesheet" href="res/style/styles.css"> --> <!-- Tá deixando a página cinza no fundo, com o login centralizado, mas sem a caixa -->
        <link rel="stylesheet" href="res/style/global.css">
        <link rel="stylesheet" href="res/style/login_style.css">
        <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
        <script src="funcoes.js"></script>
        <title>Fazer Login</title>
    </head>
    <body>
        <!-- navbar começa aqui -->
        <nav class="navbar">
            <div class="navbar-left">
                <a href="index.php" class="navbar-logo">MEMO</a>
            </div>
            <ul class="navbar-links">
                <li><a href="index.php">Página Inicial</a></li>
                <!-- <li><a href="download.php">Download</a></li> -->
                <li><a href="contatos.php">Sobre nós</a></li>
                <!-- <li><a href="login01.php" class="navbar-login-btn">Login</a></li> -->
            </ul>
        </nav>
        <!-- navbar termina aqui -->

        <main class="login-page">
            <form class="loginForm" action="login02.php" method="POST" name="form1" onsubmit="validaFormLogin()">                  
                <div class="login-form-container" id="login-form">
                    <h1 class="login-title">Login</h1>
                    <div class="login-input-container">
                        <label for="emailLogin" class="login-form-label">E-mail:</label>
                        <input id="emailLogin" type="text" placeholder="Insira seu E-mail..." name="email" class="login-form-input" required>
                    </div>
                    <div class="login-input-container">
                        <label for="senhaLogin" class="login-form-label">Senha:</label>
                        <input type="password" id="senhaLogin" placeholder="Insira sua senha..." name="senha" class="login-form-input" required>
                    </div>
                    <input type="submit" class="login-form-button" name="login" id="btnEntre" value="Entrar">
                </div>
                <p class="reg-link"><a href="novaSenha01.php">Esqueceu a senha?</a></p>
                <p class="reg-link">Ainda não possui uma conta? <a href="register.php">Cadastre-se aqui</a>.</p>
            </form>            
        </main>
    </body>
    <?php
        exit();
    ?>
</html>