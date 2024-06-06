<?php
if (isset($_GET['btnProd'])) {
    require '../database/conne.php';
    $sqlProducao = "SELECT COUNT(*) FROM producao";
    $resultadoProducao = $conn->prepare($sqlProducao);
    $resultadoProducao->execute();
    $producao = $resultadoProducao->fetchColumn();
    if ($producao !== 0) {
        $sqlFolhaPagar = "SELECT COUNT(*) FROM folhapagamento";
        $resultadoFolhaPagar = $conn->prepare($sqlFolhaPagar);
        $resultadoFolhaPagar->execute();
        $folhaPagar = $resultadoFolhaPagar->fetchColumn();
        if ($folhaPagar == 0) {
            $sql = 'SELECT SUM(milheirosProduzidos) AS quantProd FROM producao';
            $resultado = $conn->prepare($sql);
            $resultado->execute();
            $quantProdSoma = $resultado->fetchColumn();

            $quantProd = urlencode($quantProdSoma);

            header("Location: apagarProducao.php?quantProd=$quantProd");
        } 
        else {
            header("Location: ../produca.php?folha=nao");
        }
    } else {
        header("Location: ../produca.php?prod=nao");
    }
} else {
    header("Location: ../produca.php");
}
