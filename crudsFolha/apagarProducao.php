<?php

if (isset($_GET['quantProd'])) {
    require '../database/conne.php';
    $quantProd= $_GET['quantProd'];
    $sql = 'DELETE FROM producao';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    header("Location: adicionarFolha.php?quantProdSoma=$quantProd");
}
?>
