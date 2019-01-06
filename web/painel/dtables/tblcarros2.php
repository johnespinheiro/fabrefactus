<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

 include '../conexao.php';

 $carros = array();

 		$sql ="SELECT * FROM `carros` WHERE `ativo` = '1' ORDER BY `ID` DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_array()) {

        		$id = $row['id'];
			$idlinha = $row['idlinha'];
        		$linha = $row['codlinha'];
        		$carro = $row['numerocarro'];
                $status = $row['status'];
                $linhauso = $row['linhauso'];
                $id2 = md5($id);

$sqlb ="SELECT * FROM `linhas` WHERE `id`= '$idlinha' ";
  $resultb = $conn->query($sqlb);
     while ($rowb = $resultb->fetch_array()) {

$bairro = $rowb['bairro'];

}


            switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso - linha $linhauso</span>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        break;
        }



        		$link = "<a id='viewcarros2' class='viewcarros2' href='viewcarros.php?auth=$id2&view=$id' data-codlinha='$linha' data-idcarro='$id'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

 //               $ativo = $row['ativo'];
	$carros[] = array(
                'id' => $id,
                'linha' => $linha,
		'bairro' => $bairro,
                'carro' => $carro,
                'status' => $status2,
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