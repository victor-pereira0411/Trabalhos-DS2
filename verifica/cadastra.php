<?php 
    if(isset($_POST['btn'])) {
        if(isset($_POST['usuario']) & isset($_POST['senha']) & !empty($_POST['usuario']) & !empty($_POST['senha'])) {
            require '../conne.php';
            $login = $_POST['usuario'];
            $senha = $_POST['senha'];
            $sql = "INSERT INTO usuario(nome,senha) VALUES (:nome, :senha)";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $login);
            $resultado->bindValue("senha", $senha);
            $resultado->execute();
            header('Location: ../form.php?entrou=ok');
        }
        else{
            header('Location: ../cadastro.php?entrou=nao');
        }
    } 
    else {
        header('Location: ../cadastro.php');
    }

?>