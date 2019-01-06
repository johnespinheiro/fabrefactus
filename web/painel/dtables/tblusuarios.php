<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$usuarios = array();

 		$sql ="SELECT * FROM `usuarios` ORDER BY ID DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {

        		$id = $row['id'];
        		$nome = $row['nome'];
//        		$endereco = $row['endereco'];
//                $telefone = $row['telefone'];
                $email = $row['email'];

                $id2 = md5($id);

                $link = "<a id='viewusuarios' class='viewusuarios' href='viewusuarios.php?auth=$id2&view=$id' data-codusuario='$id'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

	$usuarios[] = array(
                'id' => $id,
                'nome' => $nome,
//                'endereco' => $endereco,
//                'telefone' => $telefone,
                'email' => $email,
                'link' => $link,
				);  


    }


		$gerarusuarios = array (

		'data' => $usuarios

	);
    	            $json = $gerarusuarios;	


        echo json_encode($json, JSON_PRETTY_PRINT);
	    mysqli_close($conn);
?>