<?php
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');

//$diadehoje = date("m-d-y");
$id = mysqli_real_escape_string($conn, $_POST['id']);
$dtfim = mysqli_real_escape_string($conn, $_POST['dtfim']);
$codlinha = mysqli_real_escape_string($conn, $_POST['codlinha']);
$numerocarro = mysqli_real_escape_string($conn, $_POST['numerocarro']);
$dtfim2 = date("Y-m-d",strtotime(str_replace('/','-',$dtfim)));

	$conn->query("UPDATE movimentos SET dtfim='$dtfim2', status='0', ativo='0' WHERE id='$id' ");
	$conn->query("UPDATE carros SET status='0' WHERE codlinha='$codlinha' AND numerocarro='$numerocarro' ");
	$conn->query("UPDATE carros SET linhauso='NULL', status='0' WHERE numerocarro='$numerocarro' ");


?>
        <script>
		alert('Anuncio finalizado com sucesso !!!');
		window.location.reload();
		</script>