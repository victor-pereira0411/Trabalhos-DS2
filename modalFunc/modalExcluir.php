<?php
if(isset($_GET['matExclFunc'])) {
    $matExclFunc = $_GET['matExclFunc'];
    $nomeModExcl = $_GET['nome'];
    $url = $_SERVER['HTTP_REFERER'] . "?nomeModExclFunc=$nomeModExcl&matExclFunc=$matExclFunc";
    header('Location: ' . $url);
}