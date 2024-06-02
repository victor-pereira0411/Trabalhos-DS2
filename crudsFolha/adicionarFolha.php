<?php
if (isset($_GET['quantProdSoma'])) {
    require '../database/conne.php';
    $sql = "SELECT * FROM funcionarios";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $funcionarios = $resultado->fetchAll();
    
    foreach($funcionarios as $funcionario) {
        $somaMilheiros = $_GET['quantProdSoma'];
        $matriculaFuncionario = $funcionario['matricula'];
        $valorMilheiro = $funcionario['ganhoMilheiro'];
        $salario = $valorMilheiro * $somaMilheiros;
        $sqlFolha = 'INSERT INTO folhapagamento(salario, funcionarios_matricula, milheirosProduzidos, valorMilheiro) VALUES(:salario, :funcionarios_matricula, :milheirosProduzidos, :valorMilheiro)';
        $resultadoFolha = $conn->prepare($sqlFolha);
        $resultadoFolha -> bindValue(":salario", $salario);
        $resultadoFolha -> bindValue(":funcionarios_matricula", $matriculaFuncionario);
        $resultadoFolha -> bindValue(":milheirosProduzidos", $somaMilheiros);
        $resultadoFolha -> bindValue(":valorMilheiro", $valorMilheiro);
        $resultadoFolha ->execute();

        header('Location: ../folha.php');
    }
}
