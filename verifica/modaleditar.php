<?php
if(isset($_GET['nome'])) {
    $nomemod = $_GET['nome'];
    $senhamod = $_GET['senha'];
    $idEditar = $_GET['id'];
    $url = $_SERVER['HTTP_REFERER'] . "?nome_editar=$nomemod&senha_editar=$senhamod&ideditar=$idEditar";
    header('Location: ' . $url);
}