<?php

if (isset($_GET['btnProd'])) {
    require '../database/conne.php';
    $sql = 'SELECT SUM(milheirosProduzidos) AS quantProd FROM producao';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $quantProd = $resultado->fetchColumn();
    
    $quantProdEncoded = urlencode($quantProd);

    header("Location: apagarProducao.php?quantProd=$quantProdEncoded");
    exit();
}
?>