<?php

if (isset($_GET['btnProd'])) {
    require '../database/conne.php';
    $sql = 'SELECT SUM(milheirosProduzidos) AS quantProd FROM producao';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $quantProdSoma = $resultado->fetchColumn();
    
    $quantProd = urlencode($quantProdSoma);

    header("Location: apagarProducao.php?quantProd=$quantProd");
}
?>