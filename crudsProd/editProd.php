<?php 
    if(isset($_GET['idProducaoEdi'])) {
        if(isset($_GET['idProducaoEdi']) & isset($_GET['NovadataProducao']) & isset($_GET['novoMilheirosProduzidos']) & !empty($_GET['idProducaoEdi']) & !empty($_GET['NovadataProducao']) & !empty($_GET['novoMilheirosProduzidos'])) {
            require '../database/conne.php';
            $idProducaoEdi = $_GET['idProducaoEdi'];
            $NovadataProducao = $_GET['NovadataProducao'];
            $novoMilheirosProduzidos = $_GET['novoMilheirosProduzidos'];
            // $sql = "SELECT * FROM usuario WHERE nome = :nome";
            // $resultado= $conn->prepare($sql);
            // $resultado->bindValue("nome", $novoNome);
            // $resultado->execute();

            // if($resultado ->rowCount() === 0){
            $sql = "UPDATE producao SET milheirosProduzidos = :novoMilheirosProduzidos, dataProducao = :NovadataProducao WHERE idproducao = :idProducaoEdi";
            $resultado= $conn->prepare($sql);
            $resultado->bindValue("novoMilheirosProduzidos", $novoMilheirosProduzidos);
            $resultado->bindValue("NovadataProducao", $NovadataProducao);
            $resultado->bindValue("idProducaoEdi", $idProducaoEdi);
            $resultado->execute();
            header("Location: ../produca.php?editouProd=ok&NovadataProducao=$NovadataProducao");
        // }
        // else {
        //     header('Location: ../gerencia.php?sucesso=jatem');
        // }
    }
    } 
    else {
        header('Location: ../gerencia.php');
    }

?>