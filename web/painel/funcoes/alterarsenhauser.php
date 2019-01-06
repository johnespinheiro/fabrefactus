<?php
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');


$iduser = mysqli_real_escape_string($conn, $_POST['id']);
$senhaatual = md5(mysqli_real_escape_string($conn, $_POST['inputatualuser']));
$novasenha = md5(mysqli_real_escape_string($conn, $_POST['inputnovauser']));


$ress = $conn->query("SELECT * FROM `usuarios` WHERE `id` = '".$iduser."' ");
while ($rowuser = $ress->fetch_assoc()) {
	$senhaat = $rowuser['senha'];
}

if($senhaat != $senhaatual)
{
	echo "senha atual incorreta, por favor preencha a senha correta.";
}
else
{
	$conn->query("UPDATE usuarios SET senha='$novasenha' WHERE id='$iduser' ");

	echo "Senha atualizada com sucesso!";
}