<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$socios = array();

		$sql = "SELECT * FROM agenda";
        $resultSocios = $conn->query($sql);
        $count = $resultSocios->num_rows;
        if($count > 0)
        {

        while ($rowSocios = $resultSocios->fetch_array()) {

            $id = $rowSocios['id'];
            $title = $rowSocios['title'];
            $start = new datetime($rowSocios['start']);
            $end = new datetime($rowSocios['end']);
            $userid = $rowSocios['userid'];
            $label = $rowSocios['backgroundColor'];
            $atual = new DateTime(date('d-m-Y H:i:s'));

            $atual = date_format($atual, "d-m-Y H:i:s");
            $start = date_format($start, "d-m-Y H:i:s");
            $end = date_format($end, "d-m-Y H:i:s");

$resta = "";

            switch ($atual) {
                case $atual < $end:
                    $resta = "<span class='label label-success'>No prazo</span>";
                    break;
                case $atual > $end:
                    $resta = "<span class='label label-danger'>Vencido</span>";
                    break;
            }

            $label2 = "<span style='background-color:$label;border-color:#label;color:white'>cor de fundo</span>";

                $sqlcli = "SELECT id, nome FROM usuarios WHERE id = '$userid' ";
                $resultcliente = $conn->query($sqlcli);
                while ($rowclientes = $resultcliente->fetch_array()) {
                    $nomecliente = utf8_encode($rowclientes['nome']);
                }
        

		$socios[] = array(
                
                'title' => $title,
                'inicio' => $start,
                'fim' => $end,
                'status' => $resta,
                'usuario' => $nomecliente,
                'atual' => $atual,
                'label' => $label2,
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