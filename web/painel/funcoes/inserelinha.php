<?php  
include '../conexao.php';

$erros = "";
$erro = "";

function vazio($args){
    global $erros;
    if(!empty($args) && is_array($args)){
        foreach($args as $arg){
            if(empty($_POST[$arg])){
                $erros[$arg] = $arg . " nao pode estar vazio";
            }
        }
    }
}
if(isset($_POST)){
    vazio(['codlinha','bairro']);
//      print "<script>alert('erro')</script>";
    if($erros){
    echo "<script>alert('ERRO $erros')</script>";
        print "<strong>Erros encontrados</strong>";
        foreach($erros as $erro){
            print "<li>{$erro}</li>";
            print "<script>alert('erro - {$erro} ')</script>";
        }
    } else {
        print "<strong>Nenhum erro encontrado</strong><br/>";
//        print "Ola {$_POST['nome']}";
//    }
//}
$codlinha = mysqli_real_escape_string($conn, $_POST['codlinha']);
$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);

$ress = $conn->query("SELECT * FROM `linhas` WHERE `codlinha` = '".$codlinha."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
echo "<script>alert('ERRO - Linha $codlinha já cadastrada.')</script>";

        exit;
    }
else {

$sql = "INSERT INTO linhas (codlinha,bairro) VALUES ('$codlinha', '$bairro')";
$executasql = mysqli_query($conn, $sql);

echo "<script>alert('Linha $codlinha cadastrada com sucesso')</script>";

}
}
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>