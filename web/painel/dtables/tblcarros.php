<?php
header('Content-Type: application/json');
header('Character-Encoding: utf-8');
date_default_timezone_set('America/Sao_Paulo'); 

include "../conexao.php";

 $carros = array();


$codlinha1 = $_POST['codlinha'];


/*        $sql ="SELECT id,codlinha FROM linhas ORDER BY ID DESC"; 
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {

                $id = $row['id'];
                $linha = $row['codlinha'];
*/

        $sqlcarro ="SELECT * FROM `carros` WHERE `codlinha` = '".$codlinha1."' AND ativo = '1' ";
        $resultcarro = $conn->query($sqlcarro);
        while ($rowcarro = $resultcarro->fetch_array()) {
            $idcarro = $rowcarro['id'];
            $codlinha2 = $rowcarro['codlinha'];
            $numerocarro = $rowcarro['numerocarro'];
            $status = $rowcarro['status'];

                $id2 = md5($idcarro);

            switch ($status) {
    case 1:
        $status2 = "<span class='label label-danger'>Em uso</span>";
        break;
    case 0:
        $status2 = "<span class='label label-success'>Livre</span>";
        break;
        }

        $link = "<a class='delete3' id='$idcarro' data-tabela='carros' data-codlinha='$codlinha2' data-carro='$numerocarro'><button class='btn btn-sm btn-danger'>Excluir</button></a><a href='viewcarros.php?auth=$id2&view=$idcarro'><button class='btn btn-sm btn-info'>Visualizar</button></a>";

            $carros[] = array(
                'idcarro' => $idcarro,
//                'linha' => $codlinha2,
                'carro' => $numerocarro,
                'status' => $status2,
                'link' => $link,
                );  
        }
//  }

        $gerarcarros = array (

        'data' => $carros

    );
                    $json = $gerarcarros;   


        echo json_encode($json, JSON_PRETTY_PRINT);
        mysqli_close($conn);
?>