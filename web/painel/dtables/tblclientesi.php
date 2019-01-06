<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$clientes = array();

 		$sql ="SELECT * FROM `clientes` WHERE `ativo` = '0' ORDER BY ID DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {

        		$id = $row['id'];
        		$nome = $row['nome'];
        		$endereco = $row['endereco'];
                $telefone = $row['telefone'];
                $email = $row['email'];
                $link = "<a id='viewclientesi' class='viewclientesi' href='viewclientesi.php?view=$id' data-codcliente='$id'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

	$clientes[] = array(
                'id' => $id,
                'nome' => $nome,
                'endereco' => $endereco,
                'telefone' => $telefone,
                'email' => $email,
                'link' => $link,
				);  


    }


		$gerarclientes = array (

		'data' => $clientes

	);
    	            $json = $gerarclientes;	


        echo json_encode($json, JSON_PRETTY_PRINT);
	    mysqli_close($conn);
?>