<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <?php
    require 'template/sidebar.php';
    // $sql = "SELECT * from testeRelatorio where contIDcat = (
    //     SELECT count(m.id_musica) as contIDcat from musicas as m join artista as ar on m.id_artista = ar.id_artista group by ar.id_artista order by contIDcat desc limit 1)";
    // $resultado = $conn->prepare($sql);
    // $resultado->execute();
    // $relatorios = $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    ?>


    <div class="dashboard-content px-3 pt-4">
        <div class="row d-flex justify-content-center gap-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title fs-4">Funcionários:</h5>
                    <p class="fs-5">
                        <?php
                        $sql = 'SELECT COUNT(matricula) AS quantFunc FROM funcionarios';
                        $resultado = $conn->prepare($sql);
                        $resultado->execute();
                        $quantFunc = $resultado->fetchColumn();
                        if ($quantFunc > 0) {
                            echo $quantFunc . " funcionários";
                        } else {
                            echo "Sem funcionários";
                        }
                        ?>
                    </p>
                    <a href="funcionario.php" class="btn btn-primary">Veja mais</a>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <h5 class="card-title fs-4">Produção:</h5>
                        <p class="fs-5">
                            <?php
                            $sql = 'SELECT SUM(milheirosProduzidos) AS quantProd FROM producao';
                            $resultado = $conn->prepare($sql);
                            $resultado->execute();
                            $quantProd = $resultado->fetchColumn();
                            if ($quantProd > 0) {
                                echo $quantProd . " milheiros";
                            } else {
                                echo "Sem produção";
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                        <a href="produca.php" class="btn btn-primary">Veja mais</a>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <div>
                        <h5 class="card-title fs-4">Folha de pagamento:</h5>
                        <p class="fs-5">
                            <?php
                            $sql = 'SELECT SUM(salario) AS valorFolha FROM folhapagamento';
                            $resultado = $conn->prepare($sql);
                            $resultado->execute();
                            $valorFolha = $resultado->fetchColumn();
                            if ($valorFolha > 0) {
                                echo $valorFolha . " reais";
                            } else {
                                echo "Sem folha de pagamento";
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                        <a href="folha.php" class="btn btn-primary">Veja mais</a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php
            // if (count($producao) > 0) {
            ?>
            <div class="">
                <!-- <div class="table-responsive m-4 d-flex justify-content-center align-items-center">
                        <table class="table table-hover table-sm text-center">
                            <thead>
                                <th scope="col">Data de produção</th>
                                <th scope="col">Milheiros Produzidos</th>
                                <th scope="col">Ações</th>
                            </thead>
                            <tbody>
                                <?php
                                // foreach ($producao as $p) {
                                //     echo "<tr scope='row'>";
                                //     echo "<td>" . $p['dataProducao'] . "</td>";
                                //     echo "<td>" . $p['milheirosProduzidos'] . "</td>";
                                //     echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='modalProd/modalEditar.php' method='get'> " .
                                //         "<input type='hidden' name='idProducao' value='" . $p['idproducao'] . "'>" . "<input type='hidden' name='dataProducao' value='" . $p['dataProducao'] . "'>" . "<input type='hidden' name='milheirosProduzidos' value='" . $p['milheirosProduzidos'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                                //     echo "<form action='modalProd/modalExcluir.php' method='get'> " .
                                //         "<input type='hidden' name='idProducao' value='" . $p['idproducao'] . "'>" . "<input type='hidden' name='dataProducao' value='" . $p['dataProducao'] . "'>" . "<input type='submit' class='btn btn-danger' value='excluir'></input>" . "</form></div></td>";
                                //     echo "</tr>";
                                // }
                                ?>

                            </tbody>
                        </table>
                    </div> -->
            </div>
            <?php
            // } else {
            //     echo "<div class='d-flex justify-content-center mt-5'>
            //         <h4 class=''>Você não possui produções cadastradas</h4>
            //         </div>
            //         ";
            // }
            ?>
        </div>
    </div>

    <script>
        const local = "index";
        $(".sidebar ul li").on("click", function() {
            $(".sidebar ul li.active").removeClass("active");
            $(this).addClass("active");
        });

        $(".open-btn").on("click", function() {
            $(".sidebar").addClass("active");
        });

        $(".close-btn").on("click", function() {
            $(".sidebar").removeClass("active");
        });

        function removeClassOnSmallScreen() {
            const screenWidth = window.innerWidth;
            const element = document.querySelector('.nav');


            if (screenWidth < 768) {
                element.classList.remove('justify-content-end');
            } else {
                element.classList.add('justify-content-end');
            }
        }
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);


        function removeClassOnSmallScreen() {
            const local = "index";
            const element = document.querySelector('.btn1');
            if (local === "index") {
                element.classList.add('active');
            } else {
                element.classList.remove('justify-content-end');
            }
        }
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>