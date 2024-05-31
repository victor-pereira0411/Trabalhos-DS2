<?php
if(isset($_GET['matExclFunc'])) {
    require '../database/conne.php';
    $nomeModExclFunc = $_GET['nomeModExclFunc'];
    $matExclFunc = $_GET['matExclFunc'];
    
    $sql= "DELETE FROM funcionarios WHERE matricula=:matExclFunc";
    $resultado = $conn->prepare($sql);
    $resultado->bindValue(":matExclFunc", $matExclFunc);
    $resultado->execute();
    header("Location: ../funcionario.php?nomeModExclFunc=$nomeModExclFunc&deletar=ok");
}
