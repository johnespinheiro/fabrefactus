<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

$socios = array();

		$sql = "SELECT * FROM clientes";
        $resultSocios = $conn->query($sql);
        $count = $resultSocios->num_rows;
        if($count > 0)
        {

        while ($rowSocios = $resultSocios->fetch_array()) {

/*            $idcliente = utf8_encode($rowSocios['idcliente']);
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
*/

            $id = $rowSocios['id'];
            $nome = $rowSocios['nome'];
            $endereco = $rowSocios['endereco'];
            $telefone = $rowSocios['telefone'];
            $email = $rowSocios['email'];
            $ativo = $rowSocios['ativo'];

            switch ($ativo) {
                case '1':
                    $status = "<span class='label label-success'>SIM</span>";
                    break;
                case '0':
                    $status = "<span class='label label-danger'>NAO</span>";
                    break;
            }            

                $sqlanuncio = "SELECT * FROM movimentos WHERE idcliente = '$id' AND ativo = '1' ";
                $resultanuncio = $conn->query($sqlanuncio);
                $countanuncio = $resultanuncio->num_rows;

    
    		$socios[] = array(
                'id' => $id,
                'nome' => $nome,
                'endereco' => $endereco,
                'telefone' => $telefone,
                'email' => $email,
                'anuncios' => $countanuncio,
                'ativo' => $status,
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