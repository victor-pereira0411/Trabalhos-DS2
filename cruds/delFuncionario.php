<?php
session_start();

if(isset($_GET['matricula'])) {
    require '../database/conne.php';
    $nome = $_GET['nome'];
    $id = $_GET['matricula'];
    
    $sql= "DELETE FROM funcionarios WHERE matricula=:id";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":id", $id);
    $resultado->execute();
    header("Location: ../funcionario.php?nome_funcionario=$nome&delete=ok");
}
