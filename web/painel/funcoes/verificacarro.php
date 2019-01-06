<?php  
include '../conexao.php';

if(isset($_POST)){

$numerocarro = mysqli_real_escape_string($conn, $_POST['numerocarro']);
$idlinha = mysqli_real_escape_string($conn, $_POST['idlinha']);

$ress = $conn->query("SELECT * FROM `carros` WHERE `numerocarro` = '".$numerocarro."' AND `idlinha` = '".$idlinha."' ");
$count = $ress->num_rows;

$ress2 = $conn->query("SELECT * FROM `carros` WHERE `numerocarro` = '".$numerocarro."' ");
$count2 = $ress2->num_rows;

if ($count > 0) {
	
echo "CARRO ja cadastrado <br/>";

       exit;
    }

if($count2 > 0)
{
	echo "CARRO ja cadastrado em outra linha";
}
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>