<?php
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

$id = mysqli_real_escape_string($conn, $_POST['id']);
$anuncio = mysqli_real_escape_string($conn, $_POST['title']);
$inicio = mysqli_real_escape_string($conn, $_POST['start']);
$fim = mysqli_real_escape_string($conn, $_POST['end']);

$data1 = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$inicio)));
$data2 = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$fim)));


$conn->query("UPDATE agenda SET title='$anuncio', start='$data1', end='$data2' WHERE id='$id' ");


echo "<script>alert('editado com sucesso')</script>";

/*$success = mysqli_affected_rows($conn);

if($success <> 0)
{
	echo "evento editado com sucesso";
}
else
{
	echo "erro ao editar evento, tente novamente";
} */

$conn->close();

?>