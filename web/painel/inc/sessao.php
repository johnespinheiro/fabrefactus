<?php
session_start();

if((!isset ($_SESSION['usuarioNome']) == true) and (!isset ($_SESSION['usuarioEmail']) == true))
{
	header('location:../index.php');
	} else {	
	
//	echo "Usuario: ". $_SESSION['usuarioNome'];	
//		echo "titulo: ". $_SESSION['usuarioTitulo'];
	
$usuarioNome = 	$_SESSION['usuarioNome'];
$usuarioEmail = 	$_SESSION['usuarioEmail'];
$usuarioNivelAcesso = $_SESSION['niveluser'];
$usuarioFoto = $_SESSION['usuarioFoto'];
$created = $_SESSION['created'];
$usuarioID = $_SESSION['usuarioId'];
$usuarioTipo = $_SESSION['tipo'];
	}
//	include_once 'conexao.php';

?>