<?php  
include '../conexao.php';
//include_once ("teste/redimensiona.php");
include_once(FOTO_RESIZE);

$criado = date("Y-m-d H:i:s");


$nome = mysqli_real_escape_string($conn, $_POST['nomeusuario']);
$email = mysqli_real_escape_string($conn, $_POST['emailusuario']);
$senha = md5($_POST['senhausuario']);
$comfoto = mysqli_real_escape_string($conn, $_POST['comfotou']);

switch ($comfoto) {
    case '0':
    $src="dist/img/usuarios/semfoto.png";
//    echo "<script>alert('valor do 0 $src')</script>";
        break;

    case '1':
    $foto = $_FILES['fotou'];
    $redim = new Redimensiona();
    $src=$redim->Redimensionarclientes($foto, 180, "images");
    $src = substr($src, 3);
//    echo "<script>alert('valor do $src')</script>";
        break;
}

$ress = $conn->query("SELECT * FROM `usuarios` WHERE `email` = '".$email."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
//echo "<script>alert('ERRO - Usuario $nome já cadastrado.')</script>";
echo "2";

        exit;
    }
else {

$sql = "INSERT INTO usuarios (nome,email,senha,created,foto) VALUES ('$nome', '$email', '$senha','$criado','$src')";
$executasql = mysqli_query($conn, $sql);

//echo "<script>alert('Usuario $nome cadastrado com sucesso')</script>";
echo "1";
//echo "<script>alert('$src')</script>";

}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>