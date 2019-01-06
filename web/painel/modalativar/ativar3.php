<?php  
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo'); 

$tabela = $_POST['tabela'];
$id = $_POST['id'];
$codlinha = $_POST['codlinha'];

	$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
	$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
	$usuarionome = $_POST['usuarionome'];
	$carro = $_POST['carro'];
	$status = $_POST['status'];
	$mensagem = "apagou dependente - $nome";


	$result_log = "INSERT INTO logs (hora, ip, mensagem, sociotitulo, matricula, usuario, tabela) VALUES ('$hora', '$ip', '$mensagem', '$titulo', '$matricula', '$usuarionome', '$tabela')";	
	$resultado_log = mysqli_query($conn, $result_log);

/* enviar para tabela temp - para apagar do db net - socios */

	$res=$conn->query("SELECT * FROM $tabela WHERE ID='$id'");
	while($row=$res->fetch_array())
	{
		
		$temporaria="INSERT INTO temp(Matricula,Nome,cpf) VALUES ('".$row['Matricula']."','".$row['Nome']."','".$row['CPF']."')";	
		$temporaria = $conn->query($temporaria);
	}



$delete1 = mysqli_query($conn, "DELETE FROM $tabela where ID='$id'");

?>