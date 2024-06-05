<?php
if(isset($_GET['matExclFunc'])) {
    $matExclFunc = $_GET['matExclFunc'];
    $nomeModExcl = $_GET['nome'];
    header("Location: ../funcionario.php?nomeModExclFunc=$nomeModExcl&matExclFunc=$matExclFunc");
}