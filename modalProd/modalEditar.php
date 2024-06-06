<?php
if(isset($_GET['idProducao'])) {
    $idProducao = $_GET['idProducao'];
    $dataProducao = $_GET['dataProducao'];
    $milheirosProduzidos = $_GET['milheirosProduzidos'];
    header('Location: ../produca.php?dataProducao=$dataProducao&idProducaoEdi=$idProducao&milheirosProduzidos=$milheirosProduzidos');
}