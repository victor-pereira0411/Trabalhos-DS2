<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/produca.css">
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
            (function() {
                Swal.fire({
                    title: "Quer mesmo excluir essa produção?",
                    text: "Você deletará a produção dessa diária do sistema!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#6c757d",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, excluir produção!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudsProd/delProd.php?dataProducao=" + dataProducao + "&idProducaoExc=" + idProducaoExc;
                    } else {
                        window.location.href = "produca.php";
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

                Swal.fire({
                    title: "Altere a produção",
                    html: `<?php
                            if (isset($_GET["dados"])) {
                                echo "<div class='container'>
                                <div class='alert alert-danger alert-dismissible fade show fs-6' role='alert'>
                                    Preencha todos os campos
                                    <a href='produca.php?dataProducao=" . $_GET['dataProducao'] . "&idProducaoEdi=" . $_GET['idProducaoEdi'] . "&milheirosProduzidos=" . $_GET['milheirosProduzidos'] . "' class='btn btn-close'></a>
                                </div>
                            </div>";
                            } else if (isset($_GET['dataExistente'])) {
                                $dataExistente = $_GET['dataExistente'];
                                echo "<div class='container'>
                                <div class='alert alert-warning alert-dismissible fade show fs-6' role='alert'>
                                    Já possui produção com a data de $dataExistente cadastrada!
                                    <a href='produca.php?dataProducao=" . $_GET['dataProducao'] . "&idProducaoEdi=" . $_GET['idProducaoEdi'] . "&milheirosProduzidos=" . $_GET['milheirosProduzidos'] . "' class='btn btn-close'></a>
                                </div>
                            </div>";
                            }
                            ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-start">
                        <label class="form-label">Data da produção<span class="text-danger">*</span></label>
                        </div>
                        <input type="hidden" class="form-control" id="idProducaoEdi" value="${idProducaoEdi}">
                        <input type="date" class="form-control" id="dataProducao" value="${dataProducao}">
                    </div>
                    <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <label class="form-label">Milheiros produzidos<span class="text-danger">*</span></label>
                        </div>
                        <input type="number" class="form-control" id="milheirosProduzidos" value="${milheirosProduzidos}">
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: "Atualizar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    confirmButtonColor: "#0d6efd",
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
                        window.location.href = "produca.php";
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['btnProd'])) {
    ?>
        <script>
            (function() {
                Swal.fire({
                    title: "Quer mesmo finalizar essa produção?",
                    text: "Você irá enviar essa produção para a folha de pagamento!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#6c757d",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, enviar produção!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudsFolha/somaProducao.php?btnProd=ok";
                    } else {
                        window.location.href = "produca.php";
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['cadastrarProd'])) {
    ?>
        <script>
            (function() {
                Swal.fire({
                    title: "Cadastre produções",
                    html: `<?php
                            if (isset($_GET["dados"])) {
                                echo "<div class='container'>
                                <div class='alert alert-danger alert-dismissible fade show fs-6' role='alert'>
                                    Preencha todos os campos
                                    <a href='produca.php?cadastrarProd=ok' class='btn btn-close'></a>
                                </div>
                            </div>";
                            } else if (isset($_GET['dataProducao'])) {
                                $dataProducao = $_GET['dataProducao'];
                                echo "<div class='container'>
                                <div class='alert alert-warning alert-dismissible fade show fs-6' role='alert'>
                                    Já possui produção com a data de $dataProducao cadastrada!
                                    <a href='produca.php?cadastrarProd=ok' class='btn btn-close'></a>
                                </div>
                            </div>";
                            }
                            ?>
                        <div class="mb-3">
                            <div class="d-flex justify-content-start">
                            <label for="dataProducao" class="form-label">Data da produção<span class="text-danger">*</span></label>
                            </div>
                            <input type="date" class="form-control" id="dataProducao">
                        <div class="mb-3">
                            <div class="d-flex justify-content-start">
                            <label for="milheirosProduzidos" class="form-label">Milheiros produzidos<span class="text-danger">*</span></label>
                            </div>
                            <input type="number" class="form-control" id="milheirosProduzidos">
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: "Cadastrar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    confirmButtonColor: "#0d6efd",
                    reverseButtons: true,
                    preConfirm: () => {
                        const dataProducao = document.getElementById('dataProducao').value;
                        const milheirosProduzidos = document.getElementById('milheirosProduzidos').value;
                        return [dataProducao, milheirosProduzidos];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const [ dataProducao, milheirosProduzidos] = result.value;
                        window.location.href = "crudsProd/cadProd.php?datProd=" + dataProducao + "&milhProd=" + milheirosProduzidos;
                    } else {
                        window.location.href = "produca.php";
                    }
                });
            })();
        </script>
    <?php
    }
    ?>
    <div class="dashboard-content px-3 pt-4">
        <div class="fs-4 m-2 mt-1 d-flex justify-content-between ">
            <div class="title-prod d-flex flex-direction-row justify-content-between w-100">
                <h2>Produção</h2>
                <div class="d-flex flex-direction-row gap-3">
                    <form action="modalProd/modalFinalizar.php" method="get">
                        <button type="submit" class="btn btn-secondary" name="btnProd" value="ok">
                            Finalizar produção
                        </button>
                    </form>
                    <form action="modalProd/modalCadastrar.php" method="get">
                        <input class="btn btn-primary" type="submit" name="cadastrar" value="adicionar">
                    </form>
                </div>
            </div>
        </div>


        <div>
            <?php
            if (isset($_GET['prodCad'])) {
                $dataProd = $_GET['dataProducao'];
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
            } else if (isset($_GET['folha'])) {
            ?>

                <div class="container">
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        Ainda há pagamentos a ser feitos da última produção!
                        <a href="produca.php" class="btn btn-close"></a>
                    </div>
                </div>

            <?php
            } else if (isset($_GET['prod'])) {
            ?>

                <div class="container">
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        Não há produções para ser enviadas para a folha de pagamento!
                        <a href="produca.php" class="btn btn-close"></a>
                    </div>
                </div>

            <?php
            } else if (isset($_GET['funcionario'])) {
            ?>

                <div class="container">
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        Não há funcionários a ser pago para ser enviada para a folha de pagamento!
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
            const local = "producao";
            const botao = document.querySelector('.btn3');

            if (local === "producao") {
                botao.classList.add('active');
            } else {
                botao.classList.remove('justify-content-end');
            }
        }

        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>