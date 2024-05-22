<?php
if(isset($_GET['nome'])) {
    $nomemod = $_GET['nome'];
    $senhamod = $_GET['senha'];
    header("Location: ../gerencia.php?nome_editar=$nomemod&senha_editar=$senhamod");
}