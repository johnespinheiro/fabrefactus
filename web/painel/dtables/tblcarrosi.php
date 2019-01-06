<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

 include '../conexao.php';

 $carros = array();

 		$sql ="SELECT * FROM `carros` WHERE `ativo` = '0' ORDER BY `ID` DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {

        		$id = $row['id'];
        		$linha = $row['codlinha'];
			$idlinha = $row['idlinha'];
        		$carro = $row['numerocarro'];

$sqlb ="SELECT * FROM `linhas` WHERE `id`= '$idlinha' ";
  $resultb = $conn->query($sqlb);
     while ($rowb = $resultb->fetch_array()) {

$bairro = $rowb['bairro'];

}

        		$link = "<a id='viewcarrosi2' class='viewcarrosi2' href='viewcarrosi2.php?view=$id' data-codlinha='$linha' data-idcarro='$id'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

 //               $ativo = $row['ativo'];
	$carros[] = array(
                'id' => $id,
                'linha' => $linha,
		'bairro' => $bairro,
                'carro' => $carro,
                'link' => $link,
 //               'ativo' => $ativo,
				);  


    }
//}

		$gerarcarros = array (

		'data' => $carros

	);
    	            $json = $gerarcarros;	


        echo json_encode($json, JSON_PRETTY_PRINT);
	    mysqli_close($conn);
?>