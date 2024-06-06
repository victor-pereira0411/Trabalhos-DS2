<?php
if(isset($_GET['matExclFunc'])) {
require '../database/conne.php';
$sqlFuncDel = "SELECT COUNT(*) FROM folhapagamento";
$resultadoFuncDel = $conn->prepare($sqlFuncDel);
$resultadoFuncDel->execute();
$funcionarioPagar = $resultadoFuncDel->fetchColumn();
if($funcionarioPagar == 0) {
    $nomeModExclFunc = $_GET['nomeModExclFunc'];
    $matExclFunc = $_GET['matExclFunc'];
    
    $sql= "DELETE FROM funcionarios WHERE matricula=:matExclFunc";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":matExclFunc", $matExclFunc);
    $resultado->execute();
    header("Location: ../funcionario.php?nomeModExclFunc=$nomeModExclFunc&deletar=ok");
} else {
    header("Location: ../funcionario.php?funcPagar=nao");
}
} else {
    header("Location: ../funcionario.php");
}
