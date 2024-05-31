<?php
if(isset($_GET['idProducaoExc'])) {
    require '../database/conne.php';
    $idProducaoExc = $_GET['idProducaoExc'];
    $dataProducao = $_GET['dataProducao'];
    
    $sql= "DELETE FROM producao WHERE idproducao=:idProducaoExc";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":idProducaoExc", $idProducaoExc);
    $resultado->execute();
    header("Location: ../produca.php?dataProducao=$dataProducao&deletarProd=ok");
}
