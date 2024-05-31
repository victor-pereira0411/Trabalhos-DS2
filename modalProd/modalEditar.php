<?php
if(isset($_GET['idProducao'])) {
    $idProducao = $_GET['idProducao'];
    $dataProducao = $_GET['dataProducao'];
    $milheirosProduzidos = $_GET['milheirosProduzidos'];
    $url = $_SERVER['HTTP_REFERER'] . "?dataProducao=$dataProducao&idProducaoEdi=$idProducao&milheirosProduzidos=$milheirosProduzidos";
    header('Location: ' . $url);
}