<?php 
if(isset($_GET['matriculaEditar'])) {
    require '../database/conne.php';
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
}    
