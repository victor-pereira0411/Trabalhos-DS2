<?php
if(isset($_GET['matEditFunc'])) {
    $matModEditFunc = $_GET['matEditFunc'];
    $nomeModEditFunc = $_GET['nome'];
    $ganhoMilhModEditFunc = $_GET['ganhoMilheiro'];
    header("Location: ../funcionario.php?nomeModEditFunc=$nomeModEditFunc&matModEditFunc=$matModEditFunc&ganhoMilhModEditFunc=$ganhoMilhModEditFunc");
}