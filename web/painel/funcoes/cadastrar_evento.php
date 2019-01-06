<?php
include '../conexao.php';
include_once(FOTO_RESIZE);

$cor = mysqli_real_escape_string($conn, $_POST['cor']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$datahorainicio = mysqli_real_escape_string($conn, $_POST['datahorainicio']);
$datahorafim = mysqli_real_escape_string($conn, $_POST['datahorafim']);
$userid = mysqli_real_escape_string($conn, $_POST['userid']);

$data1 = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$datahorainicio)));
$data2 = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$datahorafim)));

$sql = "INSERT INTO agenda (userid,title,start,end,backgroundColor,borderColor) VALUES ('$userid','$nome','$data1','$data2','$cor','$cor')";
$executasql = mysqli_query($conn, $sql);


 echo "Evento cadastrado com sucesso!";


//      $response = array("success" => true);
//  echo json_encode($response);*/

$conn->close();
?>