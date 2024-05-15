<?php
session_start();
if(isset($_SESSION[$usuari['idusuari']])) {
    require '../conne.php';
    $nome = $_SESSION[$usuari['nome']];
    $id = $_SESSION[$usuari['idusuari']];

    $sql= "DELETE FROM usuario WHERE idusuario=:idusuario";
    $resultado = $conn -> prepare($sql);
    $resultado -> bindValue(":idusuario", $id);
    $resultado-> execute();

    header('Location: ../index.php?nome_usuario= $nome');

}