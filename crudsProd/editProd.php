<?php
if (isset($_GET['idProducaoEdi']) & isset($_GET['NovadataProducao']) & isset($_GET['novoMilheirosProduzidos']) & !empty($_GET['idProducaoEdi']) & !empty($_GET['NovadataProducao']) & !empty($_GET['novoMilheirosProduzidos'])) {
    require '../database/conne.php';
    $idProducaoEdi = $_GET['idProducaoEdi'];
    $NovadataProducao = $_GET['NovadataProducao'];
    $novoMilheirosProduzidos = $_GET['novoMilheirosProduzidos'];
    $sqlProd = "SELECT COUNT(idproducao) FROM producao WHERE dataProducao = :dataProd AND idproducao != :id";
    $resultado = $conn->prepare($sqlProd);
    $resultado->bindValue(":dataProd", $NovadataProducao);
    $resultado->bindValue(":id", $idProducaoEdi);
    $resultado->execute();
    $producao = $resultado->fetchColumn();

    if ($producao == 0) {
        $sql = "UPDATE producao SET milheirosProduzidos = :novoMilheirosProduzidos, dataProducao = :NovadataProducao WHERE idproducao = :idProducaoEdi";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":novoMilheirosProduzidos", $novoMilheirosProduzidos);
        $resultado->bindValue(":NovadataProducao", $NovadataProducao);
        $resultado->bindValue(":idProducaoEdi", $idProducaoEdi);
        $resultado->execute();
        header("Location: ../produca.php?editouProd=ok&NovadataProducao=$NovadataProducao");
    } else {
        $url = $_SERVER['HTTP_REFERER'] . "&prodExiste=ok&dataExistente=$NovadataProducao";
        header("Location: " . $url);
    }
} else {
    $url = $_SERVER['HTTP_REFERER'] . "&dados=nao";
        header("Location: " . $url);
}
