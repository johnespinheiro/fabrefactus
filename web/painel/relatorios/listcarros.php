<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$socios = array();

		$sql = "SELECT * FROM carros";
        $resultSocios = $conn->query($sql);
        $count = $resultSocios->num_rows;
        if($count > 0)
        {

        while ($rowSocios = $resultSocios->fetch_array()) {

                $id = $rowSocios['id'];
                $idlinha = $rowSocios['idlinha'];
                $codlinha = $rowSocios['codlinha'];
                $numerocarro = $rowSocios['numerocarro'];
                $ativo = $rowSocios['ativo'];
                $status = $rowSocios['status'];


$sqlb ="SELECT * FROM `linhas` WHERE `id`= '$idlinha' ";
  $resultb = $conn->query($sqlb);
     while ($rowb = $resultb->fetch_array()) {

$bairro = $rowb['bairro'];

}

            switch ($ativo) {
                case '1':
                    $statuscarro = "<span class='label label-success'>SIM</span>";
                    break;
                case '0':
                    $statuscarro = "<span class='label label-danger'>NAO</span>";
                    break;
            } 
            switch ($status) {
                case '0':
                    $disponivel = "<span class='label label-success'>Disponivel</span>";
                    break;
                case '1':
                    $disponivel = "<span class='label label-danger'>Em uso</span>";
                    break;
            } 

    
		$socios[] = array(
                'id' => $id,
                'codlinha' => $codlinha,
		'bairro' => $bairro,
                'numerocarro' => $numerocarro,
                'ativo' => $statuscarro,
                'disponivel' => $disponivel,
				);   
		}
	}
		$gerarsocio = array (

		'data' => $socios
/*		'Dependentes' => $dependentes,
		'Alunos' => $alunos,
		'Funcionarios' => $funcionarios,
		'Prestadores' => $prestadores,
		'Convidados' => $convidados,
		'Apagar' => $apagar	*/	

	);

	            $json = $gerarsocio;	


        echo json_encode($json, JSON_PRETTY_PRINT);
	    mysqli_close($conn);
?>