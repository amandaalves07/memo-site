<?php
	$formOK=true;

	if (isset($_POST['nome'])){
		$nome=$_POST['nome'];
	}
	if (isset($_POST['dataNasc'])){
		$dataNasc=$_POST['dataNasc'];
	}
	if (isset($_POST['sexo'])){
		$sexo=$_POST['sexo'];
	}
	if (isset($_POST['tel'])){
		$tel=$_POST['tel'];
	}
	if (isset($_POST['email'])){
		$email=$_POST['email'];
	}
	if (isset($_POST['senha'])){
		$senha=$_POST['senha'];
	}

	if (empty($nome)){
		echo("O nome precisa ser preenchido!");
		$formOK=false;
	}
	if (empty($dataNasc)){
		echo("A data de nascimento precisa ser preenchida!");
		$formOK=false;
	}
	if (empty($tel)){
		echo("O telefone precisa ser preenchido!");
		$formOK=false;
	}
	if (empty($email)){
		echo("O e-mail precisa ser preenchido!");
		$formOK=false;
	}
	if (empty($senha)){
		echo("A senha precisa ser preenchida!");
		$formOK=false;
	}

	require ("cryp2graph.php");

	//verificando formatação da senha nova
	if(!validarFormatoSenha($senha)){
		$formOK=false;
		echo("A senha não está no formato exigido!<br>");
	}

	if (!$formOK){
		echo('<br><button onclick="history.go(-1);">Voltar</button><br>');
		die("<br>Verifique os erros indicados acima!!");
	}

	$id=CriaID(10);
	$senhaCAD=FazSenha($id, $senha);
	$cadOK=true;

	require ("bdconnecta.php");
	//cadastrando o usuário na tabela de usuários
	$sql="INSERT INTO usuario (id, nome, senha, email, dataNasc, sexo, tel) VALUES (?,?,?,?,?,?,?)";
	$stmt=mysqli_prepare($conn,$sql);

	if (!$stmt){
		die("Não foi possível preparar o cadastro!");
	}

	if (!mysqli_stmt_bind_param($stmt, "sssssss", $id, $nome, $senhaCAD, $email, $dataNasc, $sexo, $tel)){
		die("Não foi possível vincular parâmetros!");
	}

	if (!mysqli_stmt_execute($stmt)){
		echo(mysqli_error($conn));
		$cadOK=false;
		die("Não foi possível cadastrar a pessoa no BD! <br>"); 
	}

	if(!$cadOK){
		die("Não foi possível inserir dados pessoais para esta pessoa! Verifique!");
	}

	if (!mysqli_stmt_close($stmt)){
		die("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
		//mandar email/sms/alerta para o programador
	}

	//cadastrando o usuário na tabela de senhas
	$sql2="INSERT INTO senhasantigas (id, senhaAnt) VALUES (?,?)";
	$stmt2=mysqli_prepare($conn, $sql2);

	if(!$stmt2){
		die("Não foi possível preparar o cadastro de senha(s)!");
	}

	if (!mysqli_stmt_bind_param($stmt2, "ss", $id, $senhaCAD)){
		die("Não foi possível vincular parâmetros!");
	}

	if (!mysqli_stmt_execute($stmt2)){
		$cadOK=false;
		die("Não foi possível cadastrar senha no BD!"); 
	}

	if(!$cadOK){
		die("Não foi possível inserir dados de senha para esta pessoa! Verifique!");
	}

	if (!mysqli_stmt_close($stmt2)){
		die("Não foi possível efetuar a limpeza da conexão. Avise o setor de TI.");
		//mandar email/sms/alerta para o programador
	}

	session_start();
	$_SESSION['idSessao']=session_id();
	$_SESSION['id']=$id;
	$_SESSION['operador']=$email;
	$_SESSION['nomeOperador']=$nome;

	header("Location: user.php");
?>