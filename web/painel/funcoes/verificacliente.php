<?php  
include '../conexao.php';

if(isset($_POST)){

$email = mysqli_real_escape_string($conn, $_POST['emailcliente']);

$ress = $conn->query("SELECT * FROM `clientes` WHERE `email` = '".$email."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
echo "Cliente ja cadastrado";
        exit;
    }
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>