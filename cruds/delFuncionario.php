<?php
session_start();
if(isset($_GET['matricula'])) {
    require '../conne.php';
    $id = $_GET['matricula'];
    $nome = $_GET['nome'];
    
    $sql= "DELETE FROM funcionarios WHERE matricula=:id";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":id", $id);
    $resultado->execute();
    
    header("Location: ../funcionario.php?nome_funcionario=$nome&delete=ok");
    
}
var_dump($_GET['matricula']);
