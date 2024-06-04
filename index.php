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
            
        </div>
    </div>

    <script>
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