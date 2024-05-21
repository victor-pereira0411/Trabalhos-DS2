<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        @media(max-width: 767px) {
            .botaos {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    <?php
    require 'conne.php';
    $sql = "SELECT * FROM funcionarios";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $funcionarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
    require 'template/sidebar.php';
    ?>
    <div class="dashboard-content px-3 pt-4">
        <div class="fs-4 m-2 mt-1 d-flex justify-content-between flex-column ">
            <div class="fs-4 m-2 mt-1 d-flex justify-content-between ">
                <h2>Funcionários</h2>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcadastrar">
                    adicionar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="modalcadastrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar funcionário</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="cruds/cadFuncionario.php" method="post">
                                    <div class="mb-3">
                                        <label for="text" class="form-label">Nome do funcionário</label>
                                        <input type="text" class="form-control" id="nomfunc" name="nomfunc" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="int" class="form-label">Ganho por milheiro</label>
                                        <input type="int" class="form-control" id="ganho" name="ganhoFunc" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" name="btnfunc">Cadastrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <?php
                if (isset($_GET['sucesso'])) {
                    $nomefun = $_GET['nome_funcionario'];
                ?>
                    <div class="container">
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <?php echo $nomefun ?> cadastrado com sucesso!
                            <a href="funcionario.php" class="btn btn-close"></a>
                        </div>
                    </div>
                <?php
                } else if (isset($_GET['delete'])) {
                    $nomefundel = $_GET['nome_funcionario'];
                ?>

                    <div class="container">
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <?php echo $nomefundel ?> deletado com sucesso!
                            <a href="funcionario.php" class="btn btn-close"></a>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>
        </div>
        <?php
        if (count($funcionarios) > 0) {
        ?>
            <div class="">
                <div class="table-responsive m-4 d-flex justify-content-center align-items-center">
                    <table class="table table-hover table-sm">
                        <thead>
                            <th scope="col">id</th>
                            <th scope="col">nome</th>
                            <th scope="col">Ganho(milheiro)</th>
                            <th scope="col">Ações</th>
                        </thead>
                        <tbody>
                            <!-- <form action='cruds/delFuncionario.php' method='get'> " .
                                    "<input type='hidden' name='matricula' value='" . $funcionario['matricula'] . "'>" .
                                    "<input type='hidden' name='nome' value='" . $funcionario['nome'] . "'>" -->

                            <?php
                            foreach ($funcionarios as $funcionario) {
                                echo "<tr scope='row'>";
                                echo "<td>" . $funcionario['matricula'] . "</td>";
                                echo "<td>" . $funcionario['nome'] . "</td>";
                                echo "<td>" . $funcionario['ganhoMilheiro'] . "</td>";
                                echo "<td>" . "<div class='botaos d-flex flex-row gap-1'><button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modaleditar'>editar</button>";
                                echo "
                                    <form action='cruds/delFuncionario.php' method='get'> " .
                                    "<input type='hidden' name='matricula' value='" . $funcionario['matricula'] . "'>" .
                                    "<input type='hidden' name='nome' value='" . $funcionario['nome'] . "'>" .
                                    "<input type='submit' class='btn btn-danger' value='excluir'></input>" .
                                    "</form>
                                    </div>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else {
            echo "<div class='d-flex justify-content-center mt-5'>
                    <h4 class=''>Você não possui funcionários cadastrados</h4>
                    </div>
                    ";
        }
        ?>
    </div>

    </div>

    <script>
        const local = "funcionario";
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
        // Função para remover a classe do Bootstrap quando a tela for menor que 768px
        function removeClassOnSmallScreen() {
            const screenWidth = window.innerWidth;
            const element = document.querySelector('.nav'); // Elemento Bootstrap com a classe a ser removida

            // Verifica se a largura da tela é menor que 768px (padrão para tablets e dispositivos menores)
            if (screenWidth < 768) {
                // Remove a classe do Bootstrap
                element.classList.remove('justify-content-end');
            } else {
                // Adiciona a classe do Bootstrap se a largura da tela for maior ou igual a 768px
                element.classList.add('justify-content-end');
            }
        }

        // Chama a função quando a página carrega e quando a janela é redimensionada
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);

        // Função para remover a classe do Bootstrap quando a tela for menor que 768px
        function removeClassOnSmallScreen() {
            const local = "index";
            const element = document.querySelector('.btn2'); // Elemento Bootstrap com a classe a ser removida

            // Verifica se a largura da tela é menor que 768px (padrão para tablets e dispositivos menores)
            if (local === "index") {
                // Remove a classe do Bootstrap
                element.classList.add('active');
            } else {
                // Adiciona a classe do Bootstrap se a largura da tela for maior ou igual a 768px
                element.classList.remove('active');
            }
        }

        // Chama a função quando a página carrega e quando a janela é redimensionada
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>