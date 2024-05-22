<?php 
    if(isset($_GET['editar'])) {
        if(isset($_GET['novoNome']) & isset($_GET['novaSenha']) & isset($_GET['usuarioEditado']) & !empty($_GET['novoNome']) & !empty($_GET['novaSenha']) & !empty($_GET['usuarioEditado'])) {
            require '../conne.php';
            $login = $_GET['usuarioEditado'];
            $novoNome = $_GET['novoNome'];
            $senha = $_GET['novaSenha'];
            $sql = "SELECT * FROM usuario WHERE nome = :nome";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $novoNome);
            $resultado->execute();

            if($resultado ->rowCount() === 0){
            $sql = "UPDATE usuario SET nome = :nome, senha = :senha WHERE nome = :nomeantigo";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("nome", $novoNome);
            $resultado->bindValue("senha", $senha);
            $resultado->bindValue("nomeantigo", $login);
            $resultado->execute();
            header("Location: ../gerencia.php?editou=ok&nomeUsu=$novoNome");
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