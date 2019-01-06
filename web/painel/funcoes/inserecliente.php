<?php  
include '../conexao.php';
//include_once ("teste/redimensiona.php");
include_once(FOTO_RESIZE);

$criado = date("Y-m-d H:i:s");

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
    vazio(['nome',/*'endereco','celular',*/'email','senha']);
//	    print "<script>alert('erro')</script>";
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


$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$telefone = mysqli_real_escape_string($conn, $_POST['celular']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$senha = md5($_POST['senha']);
$comfoto = mysqli_real_escape_string($conn, $_POST['comfotoc']);

switch ($comfoto) {
    case '0':
    $src="dist/img/clientes/semfoto.png";
    $dfoto ="0";
//    echo "<script>alert('valor do 0 $src')</script>";
        break;

    case '1':
    $foto = $_FILES['fotoc'];
    $redim = new Redimensiona();
    $src=$redim->Redimensionarclientes($foto, 180, "images");
    $src = substr($src, 3);
    $dfoto="1";
//    echo "<script>alert('valor do $src')</script>";
        break;
}

$ress = $conn->query("SELECT * FROM `clientes` WHERE `email` = '".$email."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
echo "<script>alert('ERRO - Cliente $nome já cadastrado.')</script>";

        exit;
    }
else {

$sql = "INSERT INTO clientes (nome,endereco,telefone,email,senha,created,foto,dfoto) VALUES ('$nome', '$endereco', '$telefone', '$email', '$senha','$criado','$src','$dfoto')";
$executasql = mysqli_query($conn, $sql);
echo "<script>alert('Cliente $nome cadastrado com sucesso')</script>";

//echo "<script>alert('$src')</script>";

}
}
}

//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>