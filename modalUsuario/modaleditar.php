<?php
if(isset($_GET['nome'])) {
    $nomemod = $_GET['nome'];
    $senhamod = $_GET['senha'];
    $idEditar = $_GET['id'];
    $url = $_SERVER['HTTP_REFERER'] . "?nomeEditar=$nomemod&senhaEditar=$senhamod&idEditar=$idEditar";
    header('Location: ' . $url);
}