<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$socios = array();

		$sql = "SELECT * FROM movimentos";
        $resultSocios = $conn->query($sql);
        $count = $resultSocios->num_rows;
        if($count > 0)
        {

        while ($rowSocios = $resultSocios->fetch_array()) {

            $idcliente = utf8_encode($rowSocios['idcliente']);
        	$inicio = new datetime(utf8_encode($rowSocios['dtinicio']));
        	$fim = new datetime(utf8_encode($rowSocios['dtfim']));
        	$intervalo = $inicio->diff($fim);

            $atual = new DateTime(date('Y-m-d H:i:s'));         
            $restante = $fim->diff($atual);

            $hoje = date_format($atual, "d/m/y");
            $inicial = date_format($inicio, "d/m/y");
            $final = date_format($fim, "d/m/y");
$resta = "";

            switch ($atual) {
                case $atual < $fim:
                    $resta = "<span class='label label-success'>No prazo</span>";
                    break;
                case $atual > $fim:
                    $resta = "<span class='label label-danger'>Vencido</span>";
                    break;
            }


                $sqlcli = "SELECT id, nome FROM clientes WHERE id = $idcliente ";
                $resultcliente = $conn->query($sqlcli);
                while ($rowclientes = $resultcliente->fetch_array()) {
                    $nomecliente = utf8_encode($rowclientes['nome']);
                }
        

		$socios[] = array(
                'codlinha' => utf8_encode($rowSocios['codlinha']),
				'numerocarro' => utf8_encode($rowSocios['numerocarro']),
                'cliente' => $nomecliente,
//                'dtinicio' => utf8_encode($rowSocios['dtinicio']),
                'inicio' => $inicial,
                'fim' => $final,
//                'dtfim' => utf8_encode($rowSocios['dtfim']),
                'intervalo' => $intervalo->format('%a dias'),
//                'resta' => $restante->format('%a dias'),
                'hoje' => $hoje,
                'resta' => $resta,
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