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
    require 'database/conne.php';
    $sql = "SELECT * FROM producao";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $producao = $resultado->fetchAll(PDO::FETCH_ASSOC);
    require 'template/sidebar.php';
    if (isset($_GET['idProducaoExc'])) {
    ?>
        <script>
            var idProducaoExc = "<?php echo $_GET['idProducaoExc'] ?>";
            var dataProducao = "<?php echo $_GET['dataProducao'] ?>";
            var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
            (function() {
                Swal.fire({
                    title: "Quer mesmo excluir essa produção?",
                    text: "Você deletará a produção dessa diária do sistema!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, excluir produção!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudsProd/delProd.php?dataProducao=" + dataProducao + "&idProducaoExc=" + idProducaoExc;
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['idProducaoEdi'])) {
    ?>
        <script>
            (function() {
                var dataProducao = "<?php echo $_GET['dataProducao'] ?>";
                var milheirosProduzidos = "<?php echo $_GET['milheirosProduzidos'] ?>";
                var idProducaoEdi = "<?php echo $_GET['idProducaoEdi'] ?>";
                var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";

                Swal.fire({
                    title: "Altere a produção",
                    html: `
                    <div class="mb-3">
                        <label class="form-label">Data da produção</label>
                        <input type="hidden" class="form-control" id="idProducaoEdi" value="${idProducaoEdi}">
                        <input type="text" class="form-control" id="dataProducao" value="${dataProducao}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Milheiros produzidos</label>
                        <input type="text" class="form-control" id="milheirosProduzidos" value="${milheirosProduzidos}">
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: "Atualizar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        const idProducaoEdi = document.getElementById('idProducaoEdi').value;
                        const NovadataProducao = document.getElementById('dataProducao').value;
                        const novoMilheirosProduzidos = document.getElementById('milheirosProduzidos').value;
                        return [idProducaoEdi, NovadataProducao, novoMilheirosProduzidos];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                    const [idProducaoEdi, NovadataProducao, novoMilheirosProduzidos] = result.value;
                    window.location.href = "crudsProd/editProd.php?idProducaoEdi=" + idProducaoEdi + "&NovadataProducao=" + NovadataProducao + "&novoMilheirosProduzidos=" + novoMilheirosProduzidos;
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>
    <?php
    }
    ?>
    <div class="dashboard-content px-3 pt-4">
        <div class="fs-4 m-2 mt-1 d-flex justify-content-between ">
            <h2>Produção</h2>
            <!-- Button trigger modal -->
            <div class="d-flex flex-direction-row gap-3">
                <form action="crudsFolha/somaproducao.php" method="get">
                    <input type="hidden" value="<?php $producao ?>" name="quantProd">
                    <button type="submit" class="btn btn-secondary" name="btnProd">
                        Finalizar produção
                    </button>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcadastrar">
                    adicionar
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalcadastrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar produção</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" action="crudsProd/cadProd.php" method="post">
                                <div class="mb-3">
                                    <label for="text" class="form-label">Data Produzida</label>
                                    <input type="DATE" class="form-control" id="datProd" name="datProd" required>
                                </div>
                                <div class="mb-3">
                                    <label for="int" class="form-label">Milheiros produzidos</label>
                                    <input type="int" class="form-control" id="milhProd" name="milhProd" required>
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
        <div class="modal fade" id="modaleditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar funcionário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" action="cruds/cadFuncionario.php" method="post">
                            <div class="mb-3">
                                <label for="text" class="form-label">Data </label>
                                <input type="text" class="form-control" id="nomfunc" name="nomfunc" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Nome do funcionário</label>
                                <input type="text" class="form-control" id="nomfunc" name="nomfunc" value="<?php ?>" required>
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


        <div>
            <?php
            if (isset($_GET['sucesso'])) {
                $dataProd = $_GET['data_producao'];
            ?>
                <div class="container">
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        A produção de <?php echo $dataProd ?> adicionada com sucesso!
                        <a href="produca.php" class="btn btn-close"></a>
                    </div>
                </div>
            <?php
            } else if (isset($_GET['deletarProd'])) {
                $dataProducao = $_GET['dataProducao'];
            ?>

                <div class="container">
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        <?php echo $dataProducao ?> deletada com sucesso!
                        <a href="produca.php" class="btn btn-close"></a>
                    </div>
                </div>

            <?php
            } else if (isset($_GET['editouProd'])) {
                $NovadataProducao = $_GET['NovadataProducao'];
            ?>

                <div class="container">
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <?php echo $NovadataProducao ?> atualizada com sucesso!
                        <a href="produca.php" class="btn btn-close"></a>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
    <?php
    if (count($producao) > 0) {
    ?>
        <div class="">
            <div class="table-responsive m-4 d-flex justify-content-center align-items-center">
                <table class="table table-hover table-sm text-center">
                    <thead>
                        <th scope="col">Data de produção</th>
                        <th scope="col">Milheiros Produzidos</th>
                        <th scope="col">Ações</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($producao as $p) {
                            echo "<tr scope='row'>";
                            echo "<td>" . $p['dataProducao'] . "</td>";
                            echo "<td>" . $p['milheirosProduzidos'] . "</td>";
                            echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='modalProd/modalEditar.php' method='get'> " .
                                "<input type='hidden' name='idProducao' value='" . $p['idproducao'] . "'>" . "<input type='hidden' name='dataProducao' value='" . $p['dataProducao'] . "'>" . "<input type='hidden' name='milheirosProduzidos' value='" . $p['milheirosProduzidos'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                            echo "<form action='modalProd/modalExcluir.php' method='get'> " .
                                "<input type='hidden' name='idProducao' value='" . $p['idproducao'] . "'>" . "<input type='hidden' name='dataProducao' value='" . $p['dataProducao'] . "'>" . "<input type='submit' class='btn btn-danger' value='excluir'></input>" . "</form></div></td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    <?php } else {
        echo "<div class='d-flex justify-content-center mt-5'>
                    <h4 class=''>Você não possui produções cadastradas</h4>
                    </div>
                    ";
    }
    ?>
    </div>

    </div>
    </div>
    </div>
    <script>
        const local = "producao";
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

        function removeClassOnSmallScreen() {
            const local = "producao";
            const element = document.querySelector('.btn3'); // Elemento Bootstrap com a classe a ser removida

            // Verifica se a largura da tela é menor que 768px (padrão para tablets e dispositivos menores)
            if (local === "producao") {
                // Remove a classe do Bootstrap
                element.classList.add('active');
            } else {
                // Adiciona a classe do Bootstrap se a largura da tela for maior ou igual a 768px
                element.classList.remove('justify-content-end');
            }
        }

        // Chama a função quando a página carrega e quando a janela é redimensionada
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>