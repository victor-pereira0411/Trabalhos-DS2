<?php

if(isset($_GET['nome'])) {
    $idmod = $_GET['id'];
    $nomemod = $_GET['nome'];
    header("Location: ../gerencia.php?nome_modal=$nomemod&id=$idmod");
}