<?php
require '../conne.php';

if (isset($_GET['btnProd'])) {
    $sql = 'SELECT SUM(milheirosProduzidos) AS quantProd FROM producao';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $quantProd = $resultado->fetchColumn();
    
    // Certifique-se de codificar a URL para garantir que os caracteres especiais sejam tratados corretamente
    $quantProdEncoded = urlencode($quantProd);

    header("Location: apagarProducao.php?quantProd=$quantProdEncoded");
    exit();
}
?>