<?php
if (isset($_GET['datProd']) & isset($_GET['milhProd']) & !empty($_GET['datProd']) & !empty($_GET['milhProd'])) {
    require '../database/conne.php';
    $dataProd = $_GET['datProd'];
    $sqlProd = "SELECT COUNT(idproducao) FROM producao WHERE dataProducao = :dataProd";
    $resultadoProd = $conn->prepare($sqlProd);
    $resultadoProd->bindValue(":dataProd", $dataProd);
    $resultadoProd->execute();
    $producao = $resultadoProd->fetchColumn();
    if($producao == 0) {
    $milheProd = $_GET['milhProd'];
    $sql = "INSERT INTO producao(dataProducao, milheirosProduzidos) VALUES(:dataProducao, :milheirosProduzidos)";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":dataProducao", $dataProd);
    $resultado->bindValue(":milheirosProduzidos", $milheProd);
    $resultado->execute();

    header("Location:../produca.php?dataProducao=$dataProd&prodCad=ok");
} else {
    header("Location:../produca.php?dataProducao=$dataProd&cadastrarProd=ok");
}
} else {
    header("Location:../produca.php?cadastrarProd=ok&dados=nao");
}
