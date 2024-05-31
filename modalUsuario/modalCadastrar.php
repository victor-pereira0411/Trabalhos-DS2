<?php
if(isset($_GET['adicionaUser'])) {
    $url = $_SERVER['HTTP_REFERER'] . "?cadastrarUser=ok";
    header('Location: ' . $url);
}