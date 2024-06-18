<?php
if (isset($_GET['nomeFunc']) & isset($_GET['ganhoMilheiro']) & !empty($_GET['nomeFunc']) & !empty($_GET['ganhoMilheiro'])) {
    require '../database/conne.php';
    $nomeFunc = $_GET['nomeFunc'];
    $sqlFuncIgual = "SELECT COUNT(nome) FROM funcionarios WHERE nome = :nome";
    $resultadoFunc = $conn->prepare($sqlFuncIgual);
    $resultadoFunc->bindValue(":nome", $nomeFunc);
    $resultadoFunc->execute();
    $funcionarios = $resultadoFunc->fetchColumn();
    if ($funcionarios == 0) {
        $ganhoFunc = $_GET['ganhoMilheiro'];
        $sql = "INSERT INTO funcionarios(nome, ganhoMilheiro) VALUES(:nome, :ganhoMilheiro)";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":nome", $nomeFunc);
        $resultado->bindValue(":ganhoMilheiro", $ganhoFunc);
        $resultado->execute();

        header("Location:../funcionario.php?nomeFunCad=$nomeFunc&funCadas=ok");
    } else {
        header("Location:../funcionario.php?cadastrarFunc=ok&nomeFunExiste=$nomeFunc&funExiste=ok");
    }
} else {
    header("Location:../funcionario.php?cadastrarFunc=ok&dados=nao");
}
