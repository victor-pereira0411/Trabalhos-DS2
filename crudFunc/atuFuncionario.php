<?php
if (!empty($_GET['novoNomeFunc']) & !empty($_GET['novoGanhoMilheiro'])) {
    require '../database/conne.php';
    $sqlFuncDel = "SELECT COUNT(idfolhapagamento) FROM folhapagamento";
    $resultadoFuncDel = $conn->prepare($sqlFuncDel);
    $resultadoFuncDel->execute();
    $funcionarioPagar = $resultadoFuncDel->fetchColumn();
    if ($funcionarioPagar == 0) {
        $matriculaEditar = $_GET['matriculaEditar'];
        $novoNomeFunc = $_GET['novoNomeFunc'];
        $sqlFuncIgual = "SELECT COUNT(nome) FROM funcionarios WHERE nome = :nome AND matricula != :matricula";
        $resultadoFunc = $conn->prepare($sqlFuncIgual);
        $resultadoFunc->bindValue(":nome", $novoNomeFunc);
        $resultadoFunc->bindValue(":matricula", $matriculaEditar);
        $resultadoFunc->execute();
        $funcionarios = $resultadoFunc->fetchColumn();
        if ($funcionarios == 0) {
            $novoGanhoMilheiro = $_GET['novoGanhoMilheiro'];
            $sql = "UPDATE funcionarios SET ganhoMilheiro = :ganho, nome= :nome WHERE matricula = :matricula";
            $resultado = $conn->prepare($sql);
            $resultado->bindValue(":ganho", $novoGanhoMilheiro);
            $resultado->bindValue(":nome", $novoNomeFunc);
            $resultado->bindValue(":matricula", $matriculaEditar);
            $resultado->execute();
            header("Location: ../funcionario.php?nomeFuncionario=$novoNomeFunc&atualizar=ok");
        } else {
            $url = $_SERVER['HTTP_REFERER'] . "&nomeFuncionario=$novoNomeFunc&funcExiste=ok";
            header("Location: " . $url);
        }
    } else {
        header("Location: ../funcionario.php?funcPagar=nao");
    }
} else {
    $url = $_SERVER['HTTP_REFERER'] . "&dados=nao";
    header("Location: " . $url);
}
