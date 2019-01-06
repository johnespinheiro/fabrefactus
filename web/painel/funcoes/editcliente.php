<?php
include '../conexao.php';
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');
include_once(FOTO_RESIZE);


function excluirArquivo($arquivo){
   if( file_exists( $arquivo ) )
      unlink( $arquivo );
      return $arquivo;
} 


$idcliente = mysqli_real_escape_string($conn, $_POST['idcliente']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);
$telefone = mysqli_real_escape_string($conn, $_POST['celular']);
$email = mysqli_real_escape_string($conn, $_POST['email']);

$comfoto = mysqli_real_escape_string($conn, $_POST['comfotoc']);
$fotoold = mysqli_real_escape_string($conn, $_POST['fotoold']);
$fotodeleteold = "../$fotoold";

switch ($comfoto) {
    case '0':
    $src="dist/img/clientes/semfoto.png";
//    echo "<script>alert('valor do 0 $src')</script>";
        break;

	case '1':
    $foto = $_FILES['fotoc'];
    $redim = new Redimensiona();
    $src=$redim->Redimensionarclientes($foto, 180, "images");
    $src = substr($src, 3);
    excluirArquivo($fotodeleteold);
        break;
}


	$conn->query("UPDATE clientes SET nome='$nome', endereco='$endereco', telefone='$telefone', email='$email', foto='$src' WHERE id='$idcliente' ");

?>
        <script>
		alert('Cliente atualizado com sucesso !!!');
		window.location.reload();
		</script>