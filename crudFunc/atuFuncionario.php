<?php 
if(isset($_GET['matriculaEditar'])) {
    require '../database/conne.php';
    $sqlFuncDel = "SELECT COUNT(*) FROM folhapagamento";
    $resultadoFuncDel = $conn->prepare($sqlFuncDel);
    $resultadoFuncDel->execute();
    $funcionarioPagar = $resultadoFuncDel->fetchColumn();
    if($funcionarioPagar == 0) {
    $matriculaEditar = $_GET['matriculaEditar'];
    $novoNomeFunc = $_GET['novoNomeFunc'];
    $novoGanhoMilheiro = $_GET['novoGanhoMilheiro'];
    $sql= "UPDATE funcionarios SET ganhoMilheiro = :ganho, nome= :nome WHERE matricula = :matricula";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":ganho", $novoGanhoMilheiro);
    $resultado->bindValue(":nome", $novoNomeFunc);
    $resultado->bindValue(":matricula", $matriculaEditar);
    $resultado->execute();
    header("Location: ../funcionario.php?nomeFuncionario=$novoNomeFunc&atualizar=ok");
    } else {
        header("Location: ../funcionario.php?funcPagar=nao");
    }
}    
