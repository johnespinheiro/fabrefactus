<?php
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');


$idcliente = mysqli_real_escape_string($conn, $_POST['id']);
$senhaatual = md5(mysqli_real_escape_string($conn, $_POST['inputatualcliente']));
$novasenha = md5(mysqli_real_escape_string($conn, $_POST['inputnovacliente']));


$ress = $conn->query("SELECT * FROM `clientes` WHERE `id` = '".$iduser."' ");
while ($rowuser = $ress->fetch_assoc()) {
	$senhaat = $rowuser['senha'];
}

if($senhaat != $senhaatual)
{
	echo "senha atual incorreta, por favor preencha a senha correta.";
}
else
{
	$conn->query("UPDATE clientes SET senha='$novasenha' WHERE id='$idcliente' ");

	echo "Senha atualizada com sucesso!";
}