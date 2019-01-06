<?php  
//header('Content-Type: application/json');
include '../conexao.php';

$erros = "";

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
    vazio(['linhapai2','numerocarro']);
//      print "<script>alert('erro')</script>";
    if($erros){
    echo "<script>alert('ERRO $erros')</script>";
        print "<strong>Erros encontrados</strong>";
        foreach($erros as $erro){
            print "<li>{$erro}</li>";
            print "<script>alert('erro {$erro} ')</script>";
        }
    } else {
        print "<strong>Nenhum erro encontrado</strong><br/>";
//        print "Ola {$_POST['nome']}";
//    }
//}

$codlinha = mysqli_real_escape_string($conn, $_POST['linhapai2']);
$carro = mysqli_real_escape_string($conn, $_POST['numerocarro']);
$idlinha = mysqli_real_escape_string($conn, $_POST['idlinha']);

$ress = $conn->query("SELECT * FROM `carros` WHERE `numerocarro` = '".$carro."' AND `codlinha` = '".$codlinha."' ");
$count = $ress->num_rows;

if ($count > 0) {

echo "<script>alert('ERRO - Carro $carro já cadastrado.')</script>";
        exit;
    }
else {

$sql = "INSERT INTO carros (idlinha,codlinha,numerocarro) VALUES ('$idlinha','$codlinha', '$carro')";
$executasql = mysqli_query($conn, $sql);

echo "<script>alert('Carro $carro cadastrado com sucesso')</script>";

}
}
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>