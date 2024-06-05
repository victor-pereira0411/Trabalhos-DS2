<?php
if(isset($_POST['btnfunc'])) {
        if(isset($_POST['datProd']) & isset($_POST['milhProd']) & !empty($_POST['datProd']) & !empty($_POST['milhProd'])) {
            require '../database/conne.php';
            $dataProd = $_POST['datProd'];
            $milheProd = $_POST['milhProd'];
            $sql= "INSERT INTO producao(dataProducao, milheirosProduzidos) VALUES(:dataProducao, :milheirosProduzidos)";
            $resultado = $conn -> prepare($sql);
            $resultado -> bindValue(":dataProducao", $dataProd);
            $resultado -> bindValue(":milheirosProduzidos", $milheProd);
            $resultado -> execute();

            header("Location:../produca.php?data_producao=$dataProd&prodCad=ok");
        }
    }