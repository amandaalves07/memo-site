<?php
	require ("ses_start.php");
	$id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Adicionar nova tarefa</title>
	</head>
	<body>
		<?php
			$formOK=true;

			if (isset($_POST['nome'])){
            	$nome=$_POST['nome'];
	        }
	        if (isset($_POST['data'])){
	            $data=$_POST['data'];
	        }
	        if (isset($_POST['hora'])){
	            $hora=$_POST['hora'];
	        }

	        echo("<div class='erro-container'>
                <h2>Erro!</h2>");

	        if (empty($nome)){
	            echo("<p>O nome precisa ser preenchido!</p>");
	            $formOK=false;
	        }
	        if (empty($data)){
	            echo("<p>A data precisa ser preenchida!</p>");
	            $formOK=false;
	        }
	        if (empty($hora)){
	            echo("<p>A hora precisa ser preenchida!</p>");
	            $formOK=false;
	        }

	        echo("<p><button onclick='history.go(-1);'>Voltar</button></p>");
        	echo("</div>");
	        if (!$formOK){
	            die();
	        }

	        $cadOK=true;

	        require ("bdconnecta.php");
	        //cadastrando a tarefa na tabela de tarefa
	        $sql="INSERT INTO tarefas (idUsuario, nome, data, hora) VALUES (?,?,?,?)";
	        $stmt=mysqli_prepare($conn, $sql);

	        if (!$stmt){
	            die("
	                <div class='erro-container'>
	                    <h2>Erro!</h2><br>
	                    <p>Não foi possível preparar o cadastro da tarefa!</p><br>
	                    <p><button onclick='history.go(-1);'>Voltar</button></p>
	                </div>");
	        }

	        if (!mysqli_stmt_bind_param($stmt, "ssss", $id, $nome, $data, $hora)){
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
	                    <p>Não foi possível cadastrar a tarefa no BD!</p><br>
	                    <p><button onclick='history.go(-1);'>Voltar</button></p>
	                </div>"); 
	            $cadOK=false;
	        }

	        if(!$cadOK){
	            die("
	                <div class='erro-container'>
	                    <h2>Erro!</h2><br>
	                    <p>Não foi possível inserir dados para esta tarefa! Verifique!</p>
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
	        header("Location: agenda.php");
		?>
	</body>
</html>