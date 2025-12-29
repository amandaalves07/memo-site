<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MEMO</title>
    <!-- <link rel="stylesheet" href="res/style/style.css" /> -->
     <link rel="stylesheet" href="res/style/global.css">
    <link rel="stylesheet" href="res/style/index_style.css" />
    <link rel="stylesheet" href="res/style/carrossel.css" />
    <link rel="stylesheet" href="res/style/janelaModal.css" />
    <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
    <script src="funcoes.js"></script>
  </head>

  <body>
    <nav class="navbar">
      <div class="navbar-left">
        <a href="index.php" class="navbar-logo">MEMO</a>
      </div>
      <ul class="navbar-links">
        <?php 
          session_start();
          if(isset($_SESSION['idSessao'])) echo('<li><a href="agenda.php">Acessar a agenda</a></li>');
          if(isset($_SESSION['perfil']) && $_SESSION['perfil']=="A") echo('<li><a href="addArt01.php">Adicionar artigo</a></li>'); 
        ?>
        <li><a href="#artigos">Artigos</a></li>
        <li><a href="contatos.php">Sobre nós</a></li>
        <?php
          if (!isset($_SESSION['idSessao'])) echo('<li><a href="login01.php" class="navbar-login-btn">Faça seu Login</a></li>');
          else echo('<li><a href="user.php" class="navbar-login-btn">Olá, '.$_SESSION['nomeOperador'].'!</a></li>');
        ?>
      </ul>
    </nav>

    <section class="hero-section">
      <div class="hero-content">
        <div class="hero-box">
          <h1>Bem-vindo(a) ao MEMO!</h1>
          <p>
            O MEMO é uma plataforma criada para conectar cuidadores e familiares
            de pessoas com Doença de Alzheimer. Nosso objetivo é oferecer
            informações confiáveis sobre a doença e apoiar o bem-estar físico e
            mental de quem cuida e de quem é cuidado!
          </p>
          <a href="https://github.com/MeMo-TCC/memo-mobile/raw/master/app-release.apk" class="hero-download-btn"
            >Faça download do nosso app!</a>
        </div>
        <img src="res/img/celular.png" alt="App preview" class="hero-img" />
      </div>
    </section>
    <section class="info-section">
      <h2 class="section-title">O que é o MEMO?</h2>
      <p class="section-desc">
        O MEMO é um projeto voltado à comunidade de cuidadores e profissionais
        da saúde que convivem com pessoas diagnosticadas com a Doença de
        Alzheimer. A plataforma oferece artigos publicados no DOI sobre
        sintomas, tratamentos, tecnologias assistivas e cuidados diários, além
        de promover a conscientização sobre a importância do autocuidado dos
        cuidadores.
      </p>
    </section>
    <section class="objetivos-section">
      <h2 class="section-title">Quais os nossos objetivos?</h2>
      <div class="objetivos-cards">
        <div class="objetivo-card">
          <div class="objetivo-icon">
            <img src="res/media/img/target.png" alt="objetivo">
          </div>
          <h3>Objetivo 1</h3>
          <p>
            Compartilhar informações confiáveis sobre o Alzheimer e o bem-estar
            de cuidadores e pacientes.
          </p>
        </div>
        <div class="objetivo-card">
          <div class="objetivo-icon">
            <img src="res/media/img/target.png" alt="objetivo">
          </div>
          <h3>Objetivo 2</h3>
          <p>
            Direcionar usuários a artigos científicos com DOI, que abordam temas
            como sintomas, tratamentos, tecnologias assistivas e cuidados com
            pessoas acometidas pela Doença de Alzheimer.
          </p>
        </div>
        <div class="objetivo-card">
          <div class="objetivo-icon">
            <img src="res/media/img/target.png" alt="objetivo">
          </div>
          <h3>Objetivo 3</h3>
          <p>
            Facilitar o acompanhamento diário de pacientes por meio de um
            aplicativo de agenda para organizar rotina, consultas, horários de
            remédios e atividades.
          </p>
        </div>
      </div>
    </section>

    <section class="oferece-section">
      <h2 class="section-title">O que mais o MEMO oferece?</h2>

      <div class="oferece-container">
        <div class="oferece-item">
          Conteúdos voltados à saúde mental e física dos cuidadores
        </div>

        <div class="oferece-item">
          Um aplicativo mobile intuitivo para gerenciar tarefas
        </div>

        <div class="oferece-item">
          Acessibilidade e facilidade de uso, garantindo que todos possam usufruir das funcionalidades sem dificuldades
        </div>

        <div class="oferece-item">
          Um espaço digital que promove acolhimento e colaboração entre cuidadores, familiares e profissionais da saúde
        </div>
      </div>
    </section>

    <section class="doencas-section">
      <h2 class="doencas-title">Doença de Alzheimer</h2>

      <div class="doencas-container">

          <div class="doenca-card">
            <h3>O que é</h3>
              <p>O Alzheimer é uma doença neurodegenerativa que causa perda progressiva de memória, 
                alterações cognitivas e mudanças no comportamento.</p>
              <p>Surge devido ao mau funcionamento de 
                proteínas no sistema nervoso e pode ter influência genética. É a forma mais comum de demência 
                em idosos.</p>
          </div>

          <div class="doenca-card">
            <h3>Sintomas</h3>
            <p>A DA pode apresentar sintomas diferentes nas pessoas, principalmente por ter alguns estágios, mas os principais sintomas são:</p>
              <ul>
                <li>Falta de memória para acontecimentos recentes;</li>
                <li>Repetição da mesma pergunta várias vezes;</li>
                <li>Irritabilidade, suspeição injustificada ou apatia</li>
                <li>Tendência ao isolamento;</li>
                <li>Dificuldade para acompanhar conversações ou pensamentos complexos</li>
              </ul>
          </div>

          <div class="doenca-card">
            <h3>Relação com cuidadores</h3>
              <p>Conviver com o Alzheimer é emocional e fisicamente desafiador. Os cuidadores podem sentir:</p>
              <ul>
                <li>Sobrecarga física e emocional;</li>
                <li>Sentimento de luto antecipado;</li>
                <li>Preocupações de custo e acessbilidade</li>
                <li>Falta de apoio e consolo</li>
              </ul>
              <p>Para ajudar, as famílias podem contribuir criando rotinas previsíveis, fazendo o acompanhamento 
                  em consultas e tratamentos, participando de terapias e reuniões de orientação de cuidadores e,
                claro, buscando apoio em pessoas e em informações confiáveis.</p>
          </div>
        
          <div class="doenca-card">
            <h3>Tratamento</h3>
            <p>Não há uma cura, ainda, para a Doença de Alzheimer, mas existem métodos que retardam sintomas e melhoram a qualidade de vida:</p> 
            <ul>
              <li>Medicamentos para o controle dos sintomas;</li>
              <li>Terapias expressivas (arte, dança, música), que estimulam a memória e promovem socialização</li>
              <li>Uso (supervisionado) do canabinol (CBD), que traz benefícios aos pacientes;</li>
              <li>Tecnologias assistivas: dispositivos de monitoramento, aplicativos de agenda e aplicativos educativos e de estimulação cognitiva </li>
            </ul>
          </div>
      </div>
    </section>
    <br>

    <!-- Seção de Artigos -->
    <section class="artigos-section" id="artigos">
      <h2 class="section-title">Artigos</h2>

      <!-- Container de cards -->
      <div class="artigos-cards">
        <!--  -->
        <?php
          require ("bdconnecta.php");

          //obtendo os dados dos artigos
          $sql="SELECT * FROM artigo ORDER BY id";
          $dataSet=mysqli_query($conn, $sql);
          if(!$dataSet){
            die("Não foi possível procurar parâmetro no BD!");
          }
          
          $cont=0;
          while ($linhaDados=mysqli_fetch_assoc($dataSet)){
            $id=$linhaDados['id'];
            $titulo=$linhaDados['titulo'];
            $autores=$linhaDados['autores'];
            $resumo=$linhaDados['resumo'];
            $link=$linhaDados['link'];
            $imagem=$linhaDados['imagem'];
            $fonte=$linhaDados['fonte'];
            $subtitulo=$linhaDados['subtitulo'];
            echo '<div class="artigo-card" onclick="abrirModal(
                \''.addslashes($titulo).'\',
                \''.addslashes($autores).'\',
                \''.addslashes($resumo).'\',
                \''.addslashes($link).'\',
                \''.addslashes($imagem).'\',
                \''.addslashes($fonte).'\'
            )">'; 
            echo('<img src="res/media/img/placeholder.png" alt="Artigo '.$id.'" class="artigo-img"/>');
            echo('<h3>Artigo '.$id.'</h3>');
            echo('<p>'.$subtitulo.'</p>');
            echo('</div>');
          }
        ?>
      </div>

      <!-- Setas de navegação do carrossel de artigos -->
      <div class="seta-artigos seta-esquerda" id="setaEsquerda">&#60;</div>
      <div class="seta-artigos seta-direita" id="setaDireita">&#62;</div>

      <!-- Bolinhas de navegação do artigo-->
      <div class="bolinhas-container" id="containerBolinhas"></div>
    </section>

    <!-- Janela modal dos artigos -->
    <div class="modal-janela" id="modal" style="display: none">
      <div class="modal-conteudo">
        <!-- Botãozinho Fechar -->
        <span class="fechar" onclick="fecharModal()">&times;</span>

        <!-- Título -->
        <h2 id="modalTitulo">Título do Artigo</h2>

        <!-- Autores do artigo -->
        <p id="modalAutores">Autores:</p>

        <!-- Resumo do artigo -->
        <div class="conteudo-horizontal">
          <div id="modalResumo">Resumo do artigo:</div>

          <div class="imagem-botao">
            <img
              id="modalImagem"
              src="res/media/img/placeholder.png"
              alt="Imagem do artigo"
            />
            <a id="modalLink" href="#" target="_blank" rel="noopener noreferrer"
              >Acessar artigo no DOI</a
            >
            <div id="modalFonte" class="modal-fonte"></div>
          </div>
        </div>
        <!-- <button onclick="fecharModal()">Fechar</button> -->
      </div>
    </div>

    <footer>
      <div class="footer-main">
        <div class="footer-brand">MEMO</div>
        <div class="footer-social">
          <span class="footer-icon">&#x1F30E;</span>
          <span class="footer-icon">&#x1F4F1;</span>
          <span class="footer-icon">&#x1F4E7;</span>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; 2025 MEMO. Todos os direitos reservados.
      </div>
    </footer>
  </body>
</html>