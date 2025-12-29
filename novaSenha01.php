<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redefinição de senha</title>
        <!-- <link rel="stylesheet" href="res/style/style.css"> -->
        <!-- <link rel="stylesheet" href="res/style/login_style.css"> -->
         <link rel="stylesheet" href="res/style/global.css">
        <link rel="stylesheet" href="res/style/novaSenha01.css">
        <script src="funcoes.js"></script>
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

         <main>
                <form class="alteracaoSenhaForm" name="form1" action="novaSenha02.php" method="POST" onsubmit="return validaFormMudaSenha()">
                    <h1 class="def-subtitle">Alteração de senha</h1>

                    <div class="container-input-alteracao" id="alteracao-form">
                        <label for="email" class="label-alteracao">Informe seu endereço de e-mail e enviaremos um link para redefinir sua senha.</label>
                        <input type="email" placeholder="Insira seu e-mail..." id="email" name="email" class="input-email-alteracao" required>
                        <div id="erroEmail" class="erro"></div>
                        <input type="submit" class="botao-enviar-alteracao" name="Enviar" id="btnEnviar" value="Enviar">
                    </div>

                    <!-- <p id="reg-link"><a href="novaSenha01.php">Esqueceu a senha?</a>.</p> -->
                    <p id="reg-link">Voltar para o <a href="user.php">perfil</a>.</p>
                    <p id="reg-link">Ainda não possui uma conta? <a href="register.php">Cadastre-se aqui</a>.</p>
                    <p id="reg-link">Voltar para página de <a href="login01.php">login</a>.</p>
                </form>
        </main>


    </body>
</html>