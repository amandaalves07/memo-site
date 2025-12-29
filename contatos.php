<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="res/style/style.css">
        <link rel="stylesheet" href="res/style/contatos_style.css">
        <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
        <script src="funcoes.js"></script>
        <title>Quem somos?</title>
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
                <!-- <li><a href="contatos.php">Contatos</a></li> -->
                <?php
                    session_start();
                    if (!isset($_SESSION['idSessao'])) {
                        echo('<li><a href="login01.php" class="navbar-login-btn">Faça seu Login</a></li>');
                    } else {
                        echo('<li><a href="user.php" class="navbar-login-btn">Olá, '.$_SESSION['nomeOperador'].'!</a></li>');
                    }
                ?>
            </ul>
        </nav>

        <!-- Seção Quem somos -->
        <section class="quem-somos-section">
            <h1 class="def-title">Quem somos?</h1>
            <div class="cards-container">
                <div class="contact-card">
                    <img src="res/img/angelica.png" alt="Foto de perfil" class="profile-photo">
                    <h3 class="card-name">Amanda Isabele Alves</h3>
                    <p class="card-description">Responsável pelo desenvolvimento integral do aplicativo 
                        mobile do MEMO e do back-end da webpágina, e, parcialmente, pelo front-end.</p>
                </div>
                <div class="contact-card">
                    <img src="res/img/cibele.jpeg" alt="Foto de perfil" class="profile-photo">
                    <h3 class="card-name">Cibele Porto Cerqueira</h3>
                    <p class="card-description">Responsável pela documentação do Trabalho de Conclusão de 
                        Curso e maior parte do front-end (estruturação e estilização) da webpágina.</p>
                </div>
                <div class="contact-card">
                    <img src="res/img/lira.png" alt="Foto de perfil" class="profile-photo">
                    <h3 class="card-name">Larissa de Lira</h3>
                    <p class="card-description">Responsável por parte da estruturação e estilização da webpágina,
                    	idealização da identidade visual do site e criação da logo.</p>
                </div>
            </div>
        </section>

        <!-- Seção Contato -->
        <section class="contato-section">
            <h2 class="def-subtitle">Contato</h2>
            <div class="contato-container">
                <div class="contato-logo">
                    <img src="res/media/img/logoMemo.jpeg" alt="Logo do site" class="site-logo">
                </div>
                <div class="contato-email">
                    <form class="email-form" action="processaContato.php" method="POST">
                        <label for="email" class="email-label">Envie-nos um email:</label>
                        <input type="text" name="nome" class="email-input" placeholder="Nome" required> <br>
                        <input type="email" id="email" name="email" class="email-input" placeholder="seu@email.com" required> <br>
                        <textarea name="mensagem" class="email-input" placeholder="Sua mensagem" required></textarea> <br>
                        <button type="submit" class="email-button">Enviar</button>
                    </form>
                </div>
            </div>
        </section>

    </body>
</html>