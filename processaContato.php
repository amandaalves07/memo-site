<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Memo</title>
        <link rel="shortcut icon" type="imagex/png" href="res/media/img/iconMemo.ico">
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
            require ("email2.php");
            $nome=addslashes($_POST['nome']);
            $email=addslashes($_POST['email']);
            $mensagem=addslashes($_POST['mensagem']);

            $para="tccetecds2023@gmail.com";

            $msgFinal="Remetente: ".$nome."<br>E-mail do remetente: ".$email."<br>Mensagem: ".$mensagem;

            $emailResult=sendEmail($nome, $email, $para, "Contato recebido", $msgFinal);
            if(!$emailResult){
                die("<div class='erro-container'>
                        <p>Não foi possível enviar e-mail de contato!</p>
                    </div>");
            } else {
                echo("<div class='sucesso-container'>
                        Muito obrigado!
                    </div>");
            }
        ?>
    </body>
</html>