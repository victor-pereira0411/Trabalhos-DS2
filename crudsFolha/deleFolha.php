<?php 

if($_GET['apague']) {
    require '../database/conne.php';
    $sqlFolha = "SELECT COUNT(idfolhapagamento) FROM folhapagamento";
    $resultadoFolha = $conn-> prepare($sqlFolha);
    $resultadoFolha ->execute();
    $folha = $resultadoFolha->fetchColumn();
    if($folha !== 0 ){
    $sql = 'DELETE FROM folhapagamento';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    header("Location: ../folha.php?pagamento=ok");
} else {
    header("Location: ../folha.php?naoPagamen=ok");
}
}