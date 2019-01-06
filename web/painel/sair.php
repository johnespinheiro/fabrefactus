<?php
	session_start();
	
	unset(
		$_SESSION['usuarioId'],
		$_SESSION['usuarioNome'],
//		$_SESSION['usuarioNiveisAcessoId'],
		$_SESSION['niveluser'],
		$_SESSION['usuarioEmail'],
		$_SESSION['usuarioFoto'],
		$_SESSION['usuarioSenha'],
		$_SESSION['created']
	);
	
	$_SESSION['logindeslogado'] = "Deslogado com sucesso";
	//redirecionar o usuario para a página de login
	header("Location: ../index.php");
?>