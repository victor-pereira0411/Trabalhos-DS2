<?php
if(isset($_GET['idProducao'])) {
    $idProducao = $_GET['idProducao'];
    $dataProducao = $_GET['dataProducao'];
    header('Location: ../produca.php?dataProducao=$dataProducao&idProducaoExc=$idProducao');
}