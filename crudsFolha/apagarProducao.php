<?php
require '../conne.php';

if (isset($_GET['quantProd'])) {
    $quantProd= $_GET['quantProd'];
    $sql = 'DELETE FROM producao';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    header("Location: adicionarFolha.php?quantProd=$quantProd");
    exit();
}
?>
