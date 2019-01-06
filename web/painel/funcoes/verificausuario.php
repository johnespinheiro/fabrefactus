<?php  
include '../conexao.php';

if(isset($_POST)){

$email = mysqli_real_escape_string($conn, $_POST['emailusuario']);

$ress = $conn->query("SELECT * FROM `usuarios` WHERE `email` = '".$email."' ");
$count = $ress->num_rows;

if ($count > 0) {
	
echo "usuario ja cadastrado";
        exit;
    }
}
//		$response = array("success" => true);
//	echo json_encode($response);*/

$conn->close();
?>