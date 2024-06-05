<?php 
if($_GET['apague']) {
    require '../database/conne.php';
    $sql = 'DELETE FROM folhapagamento';
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    header("Location: ../folha.php?pagamento=ok");
}