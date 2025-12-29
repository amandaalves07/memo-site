<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar artigo</title>
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

        .erro-container button{
            padding: 0.8rem 1.3rem;
            min-width: 130px;
            background-color: #ccc;
            color: #333;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 1rem;
            transition: 0.2s;
        }

        .sucesso-container {
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

		.sucesso-container h2 {
			margin-top: 0;
			color: #008000; /* verde */
			font-size: 22px;
		}

		.sucesso-container a {
			color: #0055cc;
			font-weight: bold;
			text-decoration: none;
		}

		.sucesso-container a:hover {
    		text-decoration: underline;
		}
    </style>
</head>
<body>
    <?php
        $formOK=true;

        if (isset($_POST['titulo'])){
            $titulo=$_POST['titulo'];
        }
        if (isset($_POST['resumo'])){
            $resumo=$_POST['resumo'];
        }
        if (isset($_POST['subtitulo'])){
            $subtitulo=$_POST['subtitulo'];
        }
        if (isset($_POST['autores'])){
            $autores=$_POST['autores'];
        }
        if (isset($_POST['link'])){
            $link=$_POST['link'];
        }
        if (isset($_POST['fonte'])){
            $fonte=$_POST['fonte'];
        }

        echo("<div class='erro-container'>
                <h2>Erro!</h2>");

        if (empty($titulo)){
            echo("<p>O título precisa ser preenchido!</p>");
            $formOK=false;
        }
        if (empty($resumo)){
            echo("<p>O resumo precisa ser preenchido!</p>");
            $formOK=false;
        }
        if (empty($subtitulo)){
            echo("<p>O subtítulo precisa ser preenchido!</p>");
            $formOK=false;
        }
        if (empty($autores)){
            echo("<p>O(s) autor(es) precisa(m) ser preenchido(s)!</p>");
            $formOK=false;
        }
        if (empty($link)){
            echo("<p>O link precisa ser preenchido!</p>");
            $formOK=false;
        }
        if (empty($fonte)){
            echo("<p>A fonte precisa ser preenchida!</p>");
            $formOK=false;
        }
        echo("<p><button onclick='history.go(-1);'>Voltar</button></p>");
        echo("</div>");
        if (!$formOK){
            die();
        }

        // Pasta onde vai salvar as imagens
        $pasta="res/media/img/";

        // Função para transformar o título em um nome seguro para arquivo
        function slugify($string) {
            $string=strtolower(trim($string));

            // Remove acentos
            $string=preg_replace('/[áàãâä]/u', 'a', $string);
            $string=preg_replace('/[éèêë]/u', 'e', $string);
            $string=preg_replace('/[íìîï]/u', 'i', $string);
            $string=preg_replace('/[óòõôö]/u', 'o', $string);
            $string=preg_replace('/[úùûü]/u', 'u', $string);
            $string=preg_replace('/[ç]/u', 'c', $string);

            // Substitui qualquer coisa que não seja letra/número por hífen
            $string=preg_replace('/[^a-z0-9]/', '-', $string);

            // Remove hifens duplos
            $string=preg_replace('/-+/', '-', $string);

            return $string;
        }

        // Gera um nome seguro
        $nome_limpo=slugify($titulo);

        // Verifica se veio arquivo
        if (isset($_FILES['foto']) && $_FILES['foto']['error']==0) {

            // Pega a extensão do arquivo enviado
            $ext=pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

            // Nome final do arquivo
            $nome_final=$nome_limpo.".".$ext;

            // Caminho final
            $destino=$pasta.$nome_final;

            // Move o arquivo
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                echo ("Erro ao salvar a imagem!");
            }

        } else {
            $destino="res/media/img/thinking.png";
        }

        $cadOK=true;

        require ("bdconnecta.php");
        //cadastrando o artigo na tabela de artigos
        $sql="INSERT INTO artigo (titulo, resumo, autores, link, imagem, fonte, subtitulo) VALUES (?,?,?,?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);

        if (!$stmt){
            die("
                <div class='erro-container'>
                    <h2>Erro!</h2><br>
                    <p>Não foi possível preparar o cadastro do artigo!</p><br>
                    <p><button onclick='history.go(-1);'>Voltar</button></p>
                </div>");
        }

        if (!mysqli_stmt_bind_param($stmt, "sssssss", $titulo, $resumo, $autores, $link, $destino, $fonte, $subtitulo)){
            die("
                <div class='erro-container'>
                    <h2>Erro!</h2><br>
                    <p>Não foi possível vincular parâmetros!</p><br>
                    <p><button onclick='history.go(-1);'>Voltar</button></p>
                </div>");
        }

        if (!mysqli_stmt_execute($stmt)){
            echo(mysqli_error($conn));
            die("
                <div class='erro-container'>
                    <h2>Erro!</h2><br>
                    <p>Não foi possível cadastrar o artigo no BD!</p><br>
                    <p><button onclick='history.go(-1);'>Voltar</button></p>
                </div>"); 
            $cadOK=false;
        }

        if(!$cadOK){
            die("
                <div class='erro-container'>
                    <h2>Erro!</h2><br>
                    <p>Não foi possível inserir dados para este artigo! Verifique!</p>
                    <p><button onclick='history.go(-1);'>Voltar</button></p>
                </div>");
        }

        if (!mysqli_stmt_close($stmt)){
            echo("
                <div class='erro-container'>
                    <h2>Erro!</h2><br>
                    <p>Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.</p>
                    <p><button onclick='history.go(-1);'>Voltar</button></p>
                </div>");
            //mandar email/sms/alerta para o programador
        }
        header("Location: user.php");
    ?>
</body>
</html>

