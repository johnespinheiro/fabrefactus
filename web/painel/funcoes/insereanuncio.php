<?php  
include '../conexao.php';
include_once(FOTO_RESIZE);

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
    vazio(['linhapai','sel2','sel1','descricao','dtinicio','dtfim']);
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
$idlinha = mysqli_real_escape_string($conn, $_POST['anidlinha']);
$linhapai = mysqli_real_escape_string($conn, $_POST['linhapai']);
$carroid = mysqli_real_escape_string($conn, $_POST['sel2']);
$clienteid = mysqli_real_escape_string($conn, $_POST['sel1']);
$dtinicio = mysqli_real_escape_string($conn, $_POST['dtinicio']);
$dtfim = mysqli_real_escape_string($conn, $_POST['dtfim']);
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

$data1 = date("Y-m-d",strtotime(str_replace('/','-',$dtinicio)));
$data2 = date("Y-m-d",strtotime(str_replace('/','-',$dtfim)));

$comfoto = mysqli_real_escape_string($conn, $_POST['comfotoa']);

$numcarro = $conn->query("SELECT numerocarro FROM carros WHERE id='$carroid' ");
while ($rowncarro=$numcarro->fetch_assoc()) {
    $carroid2 = $rowncarro['numerocarro']; 
}

switch ($comfoto) {
    case '0':
    $src="dist/img/anuncios/semfoto.png";
    $dfoto ="0";
//    echo "<script>alert('valor do 0 $src')</script>";
        break;

    case '1':
    $foto = $_FILES['fotoa'];
    $redim = new Redimensiona();
    $src=$redim->Redimensionaranuncios($foto, 250, "images");
    $src = substr($src, 3);
    $dfoto ="1";
        break;
}

$sql = "INSERT INTO movimentos (idlinha,idcarro,codlinha,numerocarro,idcliente,descricao,dtinicio,dtfim,foto,dfoto) VALUES ('$idlinha','$carroid','$linhapai', '$carroid2', '$clienteid', '$descricao', '$data1', '$data2','$src', '$dfoto')";
$executasql = mysqli_query($conn, $sql);

$conn->query("UPDATE carros SET status='1' WHERE id=$carroid");

//teste todos os carros
$conn->query("UPDATE carros SET status='1', linhauso='$linhapai', idcliente='$clienteid' WHERE numerocarro=$carroid2");

 echo "<script>alert('Anuncio cadastrado com sucesso')</script>";


/* inserir aviso na agenda
$sql2 = "INSERT INTO agenda (userid,title,start,end,backgroundColor,borderColor) VALUES ('$userid','$nome','$data1','$data2','$cor','$cor')";
$executasql2 = mysqli_query($conn, $sql2); */

}
}

//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>