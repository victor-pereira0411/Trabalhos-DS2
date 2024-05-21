<?php

if(isset($_GET['matricula'])) {
    $nomemod = $_GET['nome'];
    $idmod = $_GET['matricula'];
    header("Location: ../funcionario.php?nome_modal=$nomemod&idmod=$idmod");
}