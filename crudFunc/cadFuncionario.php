<?php
if(isset($_POST['btnfunc'])) {
        if(isset($_POST['nomfunc']) & isset($_POST['ganhoFunc']) & !empty($_POST['nomfunc']) & !empty($_POST['ganhoFunc'])) {
            require '../database/conne.php';
            $nomeFunc = $_POST['nomfunc'];
            $ganhoFunc = $_POST['ganhoFunc'];
            $sql= "INSERT INTO funcionarios(nome, ganhoMilheiro) VALUES(:nome, :ganhoMilheiro)";
            $resultado = $conn -> prepare($sql);
            $resultado -> bindValue(":nome", $nomeFunc);
            $resultado -> bindValue(":ganhoMilheiro", $ganhoFunc);
            $resultado -> execute();

            header("Location:../funcionario.php?nomeFunCad=$nomeFunc&funCadas=ok");
        }
    }