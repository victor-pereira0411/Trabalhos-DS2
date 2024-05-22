<?php 
    if(isset($_POST['btnUsu'])) {
        if(isset($_POST['nomUsu']) & isset($_POST['senha']) & !empty($_POST['nomUsu']) & !empty($_POST['senha'])) {
            require '../conne.php';
            $login = $_POST['nomUsu'];
            $senha = $_POST['senha'];
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
            header("Location: ../gerencia.php?sucesso=ok&nomeUsu=$login");
        }
        else {
            header('Location: ../gerencia.php?sucesso=jatem');
        }
    }
    } 
    else {
        header('Location: ../gerencia.php');
    }

?>