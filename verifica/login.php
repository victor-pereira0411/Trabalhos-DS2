<?php 
    if(isset($_POST['btn'])) {
        if(isset($_POST['usuario']) & isset($_POST['senha']) & !empty($_POST['usuario']) & !empty($_POST['senha'])) {
            session_start();
            require '../database/conne.php';
            $login = $_POST['usuario'];
            $senha = $_POST['senha'];
            $sql = "SELECT * FROM usuario WHERE nome = :nome AND senha= :senha";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $login);
            $resultado->bindValue("senha", $senha);
            $resultado ->execute();

            if($resultado ->rowCount() > 0) {
                $dado = $resultado -> fetch();
                $_SESSION['id'] = $dado['idusuario'];
                header('Location: ../index.php');
            }
            else {
                header('Location: ../login.php?entrou=errado');
            }

        }
        else{
            header('Location: ../login.php?entrou=nao');
        }
    } 
    else {
        header('Location: ../login.php');
    }

    
?>