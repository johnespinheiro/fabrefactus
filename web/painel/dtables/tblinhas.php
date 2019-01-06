<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$linhas = array();

 		$sql ="SELECT * FROM `linhas` WHERE `ativo` = '1' ORDER BY `ID` DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {

        		$id = $row['id'];
        		$linha = $row['codlinha'];
        		$bairro = $row['bairro'];

                $id2 = md5($id);

        		$link = "<a id='viewlinhas' class='viewlinhas' href='viewlinhas.php?auth=$id2&view=$id' data-codlinha='$linha'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

                $ativo = $row['ativo'];
	$linhas[] = array(
                'id' => $id,
                'linha' => $linha,
                'bairro' => $bairro,
                'link' => $link,
                'ativo' => $ativo,
				);  


    }


		$gerarlinhas = array (

		'data' => $linhas

	);
    	            $json = $gerarlinhas;	


        echo json_encode($json, JSON_PRETTY_PRINT);
	    mysqli_close($conn);
?>