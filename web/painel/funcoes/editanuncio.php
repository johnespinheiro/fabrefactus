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


$linhapai = mysqli_real_escape_string($conn, $_POST['linhapai']);
$anuncioid = mysqli_real_escape_string($conn, $_POST['idanuncioedit']);
$idclisel = mysqli_real_escape_string($conn, $_POST['idclisel']);
$clienteid = mysqli_real_escape_string($conn, $_POST['sel1']);
$dtinicio = mysqli_real_escape_string($conn, $_POST['dtinicio']);
$dtfim = mysqli_real_escape_string($conn, $_POST['dtfim']);
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

$dtinicio = date("Y-m-d",strtotime(str_replace('/','-',$dtinicio)));
$dtfim = date("Y-m-d",strtotime(str_replace('/','-',$dtfim)));

$comfoto = mysqli_real_escape_string($conn, $_POST['comfotoa']);
$fotoold = mysqli_real_escape_string($conn, $_POST['fotoold']);
$fotodeleteold = "../$fotoold";

switch ($comfoto) {
    case '0':
    $src="dist/img/anuncios/semfoto.png";
//    echo "<script>alert('valor do 0 $src')</script>";
        break;

	case '1':
    $foto = $_FILES['fotoa'];
    $redim = new Redimensiona();
    $src=$redim->Redimensionaranuncios($foto, 250, "images");
    $src = substr($src, 3);
    excluirArquivo($fotodeleteold);
        break;
}

if(!empty($clienteid))
{
	$conn->query("UPDATE movimentos SET idcliente='$clienteid', descricao='$descricao', dtinicio='$dtinicio', dtfim='$dtfim', foto='$src' WHERE id='$anuncioid' ");
}
else
{

	$conn->query("UPDATE movimentos SET idcliente='$idclisel', descricao='$descricao', dtinicio='$dtinicio', dtfim='$dtfim', foto='$src' WHERE id='$anuncioid' ");
}
?>
        <script>
		alert('Anuncio atualizado com sucesso !!!');
		window.location.reload();
		</script>