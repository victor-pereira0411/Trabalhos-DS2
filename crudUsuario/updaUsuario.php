<?php
if (isset($_GET['ideditar'])) {
    if (isset($_GET['nomeeditar']) & isset($_GET['senhaeditar']) & isset($_GET['ideditar']) & !empty($_GET['nomeeditar']) & !empty($_GET['senhaeditar']) & !empty($_GET['ideditar'])) {
        require '../database/conne.php';
        $idUsuario = $_GET['ideditar'];
        $novoNome = $_GET['nomeeditar'];
        $novaSenha = $_GET['senhaeditar'];
        $sql = "SELECT COUNT(idusuario) FROM usuario WHERE nome = :nome AND idusuario != :id";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":nome", $novoNome);
        $resultado->bindValue(":id", $idUsuario);
        $resultado->execute();
        $usuario = $resultado->fetchColumn();
        if ($usuario == 0) {
            $sql = "UPDATE usuario SET nome = :nome, senha = :senha WHERE idusuario = :id";
            $resultado = $conn->prepare($sql);
            $resultado->bindValue(":nome", $novoNome);
            $resultado->bindValue(":senha", $novaSenha);
            $resultado->bindValue(":id", $idUsuario);
            $resultado->execute();
            header("Location: ../index.php?editou=ok&nomeUsuario=$novoNome");
        } else {
            $url = $_SERVER['HTTP_REFERER'] . "&usuexis=ok";
            header('Location: ' . $url);
        }
    } else {
        $idEditar = $_GET['ideditar'];
        $url = $_SERVER['HTTP_REFERER'] . "&dados=nao";
        header("Location: " . $url);
    }
} else {
    header('Location: ../gerencia.php');
}
