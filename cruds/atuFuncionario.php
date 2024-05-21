<?php 
if(isset($_GET['matricula'])) {
    require '../conne.php';
    $ganho = $_GET['ganho'];
    $nome = $_GET['nome'];
    $id = $_GET['matricula'];
    
    $sql= "UPDATE funcionarios SET ganho = :ganho, nome= :nome, id = :id,";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":ganho", $ganho);
    $resultado->bindValue(":nome", $nome);
    $resultado->bindValue(":id", $id);
    $resultado->execute();
    header("Location: ../funcionario.php?nome_funcionario=$nome&atualizar=ok");
}    
