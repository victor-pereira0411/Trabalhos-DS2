<?php
if(isset($_GET['matEditFunc'])) {
    $matModEditFunc = $_GET['matEditFunc'];
    $nomeModEditFunc = $_GET['nome'];
    $ganhoMilhModEditFunc = $_GET['ganhoMilheiro'];
    $url = $_SERVER['HTTP_REFERER'] . "?nomeModEditFunc=$nomeModEditFunc&matModEditFunc=$matModEditFunc&ganhoMilhModEditFunc=$ganhoMilhModEditFunc";
    header('Location: ' . $url);
}