<?php  
include '../conexao.php';

if(isset($_POST)){

$codlinha = mysqli_real_escape_string($conn, $_POST['codlinha']);

$ress = $conn->query("SELECT * FROM `linhas` WHERE `codlinha` = '".$codlinha."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
echo "Linha ja cadastrada";
        exit;
    }
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>