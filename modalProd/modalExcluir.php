<?php
if(isset($_GET['idProducao'])) {
    $idProducao = $_GET['idProducao'];
    $dataProducao = $_GET['dataProducao'];
    $url = $_SERVER['HTTP_REFERER'] . "?dataProducao=$dataProducao&idProducaoExc=$idProducao";
    header('Location: ' . $url);
}