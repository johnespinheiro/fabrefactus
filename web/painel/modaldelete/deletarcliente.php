<?php  
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo'); 

$tabela = $_POST['tabela'];
$id = $_POST['id'];
$foto = $_POST['foto'];
$dfoto = $_POST['dfoto'];
//$fotomov = $_POST['fotomov'];
//$codlinha = $_POST['codlinha'];
//$carro = $_POST['carro'];
$arrayfoto = array();

function excluirArquivo($arquivo){
   if( file_exists( $arquivo ) )
      unlink( $arquivo );
      return $arquivo;
} 

   $resfm=$conn->query("SELECT `foto` FROM `movimentos` WHERE `idcliente` = '".$id."' AND `dfoto` = '1' ");
   $contfoto = $resfm->num_rows;
   if($contfoto > 0){
   while ($rowfm=$resfm->fetch_array()) {
      $fotomov = $rowfm['foto'];
      $fotomov = "../$fotomov";
      $arrayfoto[] = ($fotomov);
    }
    }

	$ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
	$hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
/*	$usuarionome = $_POST['usuarionome'];
	$carro = $_POST['carro'];
	$status = $_POST['status'];
	$mensagem = "apagou dependente - $nome";


	$result_log = "INSERT INTO logs (hora, ip, mensagem, sociotitulo, matricula, usuario, tabela) VALUES ('$hora', '$ip', '$mensagem', '$titulo', '$matricula', '$usuarionome', '$tabela')";	
	$resultado_log = mysqli_query($conn, $result_log);

/* enviar para tabela temp - para apagar do db net - socios 

	$res=$conn->query("SELECT * FROM $tabela WHERE ID='$id'");
	while($row=$res->fetch_array())
	{
		
		$temporaria="INSERT INTO temp(Matricula,Nome,cpf) VALUES ('".$row['Matricula']."','".$row['Nome']."','".$row['CPF']."')";	
		$temporaria = $conn->query($temporaria);
	}
*/
if($dfoto > 0 )
{
	excluirArquivo($foto);
}

foreach ($arrayfoto as $listfotodeleted) {
  echo"<script>console.log('$listfotodeleted')</script>";
  excluirArquivo($listfotodeleted);
}


$delete1 = mysqli_query($conn, "DELETE FROM clientes where id='$id'");
$delete1 = mysqli_query($conn, "DELETE FROM movimentos WHERE idcliente='$id' ");
$delete1 = $conn->query("DELETE FROM messages WHERE senderid='$id'");
$delete1 = $conn->query("DELETE FROM messages WHERE receiverid='$id'");

?>