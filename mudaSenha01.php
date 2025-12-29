<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login01.php");
        exit();
    }
    $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alteração de senha</title>
        <link rel="stylesheet" href="res/style/style.css">
        <!-- <link rel="stylesheet" href="res/style/login_style.css"> -->
         <link rel="stylesheet" href="res/style/mudaSenha01.css">
         <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
        <script src="funcoes.js" async></script>
        <script>
            function voltar(){
                window.location.href="user.php";
            }
        </script>
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
            <form class="baseform" name="form1" action="mudaSenha02.php" method="POST" onsubmit="return validaFormMudaSenha()">
                <input type="hidden" name="id" value="<?php echo($id); ?>">
                <h2 id="titAltSenha">Alteração de senha</h2>

                <div class="form-container" id="login-form">
                    <div class="input-container">
                        <b><label for="senhaAntiga" class="form-label">Senha atual:</label></b>
                        <input type="password" placeholder="Insira sua senha atual" name="senhaAntiga" id="senhaAntiga" class="form-input" required>
                    </div>
                    <div class="input-container">
                        <b><label for="senhaNova1" class="form-label">Senha nova:</label></b>
                        <input type="password" placeholder="Insira sua nova senha" name="senhaNova1" id="senhaNova1" class="form-input" required oninput="validarSenha(this)">
                    </div>
                    <div class="password-information">
                        <!--div contendo informações da formatação de senha-->
                        <p class="password-requirements">Sua senha nova deve conter:</p> <br>
                        <div id="password-length" class="password-requirements">8 ou mais caracteres</div>
                        <div id="password-uppercase" class="password-requirements">1 letra maiúscula</div>
                        <div id="password-lowercase" class="password-requirements">1 letra minúscula</div>
                        <div id="password-number" class="password-requirements">1 número</div>
                        <div id="password-symbol" class="password-requirements">1 caractere especial</div>
                    </div>
                    <div class="input-container">
                        <b><label for="senhaNova2" class="form-label">Confirme a nova senha:</label></b>
                        <input type="password" placeholder="Confirme sua nova senha" name="senhaNova2" id="senhaNova2" class="form-input" required oninput="validarSenha(this)">
                    </div>
                    <p id="erroSenhaAnt" style="color: red;"></p>
                    <p id="erroSenhaNova1" style="color: red;"></p>
                    <p id="erroSenhaNova2" style="color: red;"></p>
                    <div class="button-group">
                        <button type="button" class="back-button" onclick="voltar()">Voltar</button>
                        <input type="submit" class="form-button" value="Salvar">
                    </div>
                </div> <br>
                <p id="reg-link"><a href="novaSenha01.php">Esqueceu a senha?</a></p>                
            </form>
        </main>
    </body>	
</html>