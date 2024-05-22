<?php
if(isset($_GET['nome'])) {
    $nomemod = $_GET['nome'];
    $senhamod = $_GET['senha'];
    $idEditar = $_GET['id'];
    header("Location: ../gerencia.php?nome_editar=$nomemod&senha_editar=$senhamod&ideditar=$idEditar");
}