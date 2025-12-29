<?php
	require("ses_start.php");
	unset($_SESSION['idSessao']);
	ob_clean();
	session_destroy();
	header("Location: index.php"); 
?>