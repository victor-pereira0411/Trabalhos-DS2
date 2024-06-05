<?php
if(isset($_GET['matExclFunc'])) {
require '../database/conne.php';
$matricula = $_GET['matExclFunc'];
$sqlFuncDel = "SELECT idfolhapagamento FROM folhapagamento WHERE idfolhapagamento = :matricula";
$resultadoFuncDel = $conn->prepare($sqlFuncDel);
$resultadoFuncDel->bindValue(":matricula", $matricula);
$resultadoFuncDel->execute();
$funcionarioPagar = $resultadoFuncDel->fetch();
if(!isset($funcionarioPagar)) {
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
