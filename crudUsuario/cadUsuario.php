<?php 
    if(isset($_GET['cadastraUsuario'])) {
        if(isset($_GET['nomUsu']) & isset($_GET['senha']) & !empty($_GET['nomUsu']) & !empty($_GET['senha'])) {
            require '../database/conne.php';
            $login = $_GET['nomUsu'];
            $senha = $_GET['senha'];
            $sql = "SELECT * FROM usuario WHERE nome = :nome";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $login);
            $resultado->execute();

            if($resultado ->rowCount() === 0){
            $sql = "INSERT INTO usuario(nome,senha) VALUES (:nome, :senha)";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $login);
            $resultado->bindValue("senha", $senha);
            $resultado->execute();
            header("Location: ../index.php?sucesso=ok&nomeUsu=$login");
        }
        else {
            header('Location: ../index.php?sucesso=jatem');
        }
    }
    } 
    else {
        header('Location: ../index.php');
    }

?>