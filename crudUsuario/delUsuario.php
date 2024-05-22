<?php
if(isset($_GET['id'])) {
    require '../conne.php';
    $nome = $_GET['nome_modal'];
    $id = $_GET['id'];
    
    $sql= "DELETE FROM usuario WHERE idusuario=:id";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":id", $id);
    $resultado->execute();
    header("Location: ../gerencia.php?nome_usuario=$nome&delete=ok");
}
