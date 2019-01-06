<?php
    //Conectando ao banco de dados
    include "../conexao.php";
    
$vetor = array();

 $consulta = $conn->query("SELECT * FROM `agenda` ");

    while ($linha = $consulta->fetch_assoc()) { 
        //echo "Nome: {$linha['nome']} - E-mail: {$linha['email']}<br />";
        $vetor[] = $linha;
     }

    //Passando vetor em forma de json
//    echo "<script>console.log('$vetor')</script>";
    echo json_encode($vetor);
    
?>
