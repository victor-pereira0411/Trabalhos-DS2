<?php
if(isset($_GET['nome'])) {
    $idmod = $_GET['id'];
    $nomemod = $_GET['nome'];
    $url = $_SERVER['HTTP_REFERER'] . "?nome_modal=$nomemod&idExcUsu=$idmod";
    header('Location: ' . $url);
}