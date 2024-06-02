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
    $sqlFolha = "SELECT * FROM folhapagamento";
    $resultadoFolha = $conn->prepare($sqlFolha);
    $resultadoFolha->execute();
    $folhaPagamentos = $resultadoFolha->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="dashboard-content px-3 pt-4">
        <div>
        </div>
    </div>
    <?php
    if (count($folhaPagamentos) > 0) {
    ?>
        <div class="">
            <div class="table-responsive m-4 d-flex justify-content-center align-items-center">
                <table class="table table-hover table-sm text-center">
                    <thead>
                        <th scope="col">Nome do funcionário</th>
                        <th scope="col">Valor do milheiro</th>
                        <th scope="col">Milheiros Produzidos</th>
                        <th scope="col">Salário</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($folhaPagamentos as $folhaPagamento) {
                            echo "<tr scope='row'>";
                            echo "<td>" . $folhaPagamento['funcionarios_matricula'] . "</td>";
                            echo "<td>" . $folhaPagamento['valorMilheiro'] . " reais" . "</td>";
                            echo "<td>" . $folhaPagamento['milheirosProduzidos'] . " milheiros" . "</td>";
                            echo "<td>" . $folhaPagamento['salario'] . " reais" . "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php } else {
        echo "<div class='d-flex justify-content-center mt-5'>
                    <h4 class=''>Você não possui folhas de pagamentos pendentes!</h4>
                    </div>
                    ";
    }
    ?>
    </div>
    </div>
    </div>
    </div>
    <script>
        const local = "folha";
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
            const local = "folha";
            const element = document.querySelector('.btn4');
            if (local === "folha") {
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