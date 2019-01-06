<?php  
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo'); 

$id = mysqli_real_escape_string($conn, $_POST['id']);

$delete1 = $conn->query("DELETE FROM agenda where id='$id'");
$success = mysqli_affected_rows($conn);

if($success <> 0)
{
	echo "evento apagado com sucesso";
}
else
{
	echo "erro ao apagar registro, tente novamente";
}

$conn->close();

?>