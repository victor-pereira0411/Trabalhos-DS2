<?php
if(!empty($_POST['matricula '])) {
    require '../conne.php';
    $nome = $_POST['nome'];
    $id = $_POST['matricula'];

    $sql= "DELETE FROM usuario WHERE idusuario=:idusuario";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":idusuario", $id);
    $resultado->execute();

    header('Location: ../index.php?nome_usuario=$nome & delete=ok');

}