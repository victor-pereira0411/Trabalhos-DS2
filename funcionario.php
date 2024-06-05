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
    require 'database/conne.php';
    $sql = "SELECT * FROM funcionarios";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $funcionarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
    require 'template/sidebar.php';
    if (isset($_GET['matModEditFunc'])) {
    ?>
        <script>
            (function() {
                var nomeModEditFunc = "<?php echo $_GET['nomeModEditFunc'] ?>";
                var ganhoMilhModEditFunc = "<?php echo $_GET['ganhoMilhModEditFunc'] ?>";
                var matModEditFunc = "<?php echo $_GET['matModEditFunc'] ?>";
                var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";

                Swal.fire({
                    title: "Edite o usuário",
                    html: `
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nome do funcionário</label>
                        <input type="hidden" class="form-control" id="matModEditFunc" name="matModEditFunc" value="${matModEditFunc}">
                        <input type="text" class="form-control" id="nomeModEditFunc" name="nomeModEditFunc" value="${nomeModEditFunc}">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Ganho por milheiro</label>
                        <input type="text" class="form-control" id="ganhoMilhModEditFunc" name="ganhoMilhModEditFunc" value="${ganhoMilhModEditFunc}">
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: "Atualizar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        const novoNomeModEditFunc = document.getElementById('nomeModEditFunc').value;
                        const novoGanhoMilhModEditFunc = document.getElementById('ganhoMilhModEditFunc').value;
                        const matModEditFunc = document.getElementById('matModEditFunc').value;
                        return [novoNomeModEditFunc, novoGanhoMilhModEditFunc, matModEditFunc];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const [novoNomeModEditFunc, novoGanhoMilhModEditFunc, matModEditFunc] = result.value;
                        window.location.href = "crudFunc/atuFuncionario.php?novoNomeFunc=" + novoNomeModEditFunc + "&novoGanhoMilheiro=" + novoGanhoMilhModEditFunc + "&matriculaEditar=" + matModEditFunc;
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['matExclFunc'])) {
    ?>
        <script>
            var nomeModExclFunc = "<?php echo $_GET['nomeModExclFunc'] ?>";
            var matExclFunc = "<?php echo $_GET['matExclFunc'] ?>";
            var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
            (function() {
                Swal.fire({
                    title: "Quer mesmo excluir esse funcionário?",
                    text: "Você deletará esse funcionário do sistema!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, excluir funcionário!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudFunc/delFuncionario.php?nomeModExclFunc=" + nomeModExclFunc + "&matExclFunc=" + matExclFunc;
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
        <div class="fs-4 m-2 mt-1 d-flex justify-content-between flex-column ">
            <div class="fs-4 m-2 mt-1 d-flex justify-content-between ">
                <h2>Funcionários</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcadastrar">
                    adicionar
                </button>
                <div class="modal fade" id="modalcadastrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar funcionário</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" action="crudFunc/cadFuncionario.php" method="post">
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
                if (isset($_GET['funCadas'])) {
                    $nomeFunCad = $_GET['nomeFunCad'];
                ?>
                    <div class="container">
                        <div class='alert alert-success alert-dismissible fade show fs-6' role='alert'>
                            <?php echo $nomeFunCad ?> cadastrado com sucesso!
                            <a href="funcionario.php" class="btn btn-close"></a>
                        </div>
                    </div>
                <?php
                } else if (isset($_GET['deletar'])) {
                    $nomeFunDel = $_GET['nomeModExclFunc'];
                ?>

                    <div class="container">
                        <div class='alert alert-danger alert-dismissible fade show fs-6' role='alert'>
                            <?php echo $nomeFunDel ?> deletado com sucesso!
                            <a href="funcionario.php" class="btn btn-close"></a>
                        </div>
                    </div>

                <?php
                } else if (isset($_GET['atualizar'])) {
                    $nomeFunAtu = $_GET['nomeFuncionario'];
                ?>

                    <div class="container">
                        <div class='alert alert-success alert-dismissible fade show fs-6' role='alert'>
                            <?php echo $nomeFunAtu ?> atualizado com sucesso!
                            <a href="funcionario.php" class="btn btn-close"></a>
                        </div>
                    </div>

                <?php
                } else if (isset($_GET['funcPagar'])) {
                ?>

                    <div class="container">
                        <div class='alert alert-success alert-dismissible fade show fs-6' role='alert'>
                            Funcionário ainda deve ser pago para ser excluido!
                            <a href="produca.php" class="btn btn-close"></a>
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
                    <table class="table table-hover table-sm text-center">
                        <thead>
                            <th scope="col">id</th>
                            <th scope="col">nome</th>
                            <th scope="col">Ganho(milheiro)</th>
                            <th scope="col">Ações</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($funcionarios as $funcionario) {
                                echo "<tr scope='row'>";
                                echo "<td>" . $funcionario['matricula'] . "</td>";
                                echo "<td>" . $funcionario['nome'] . "</td>";
                                echo "<td>" . $funcionario['ganhoMilheiro'] . "</td>";
                                echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='modalFunc/modalEditar.php' method='get'> " .
                                    "<input type='hidden' name='ganhoMilheiro' value='" . $funcionario['ganhoMilheiro'] . "'>" . "<input type='hidden' name='matEditFunc' value='" . $funcionario['matricula'] . "'>" . "<input type='hidden' name='nome' value='" . $funcionario['nome'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                                echo "<form action='modalFunc/modalExcluir.php' method='get'> " .
                                    "<input type='hidden' name='matExclFunc' value='" . $funcionario['matricula'] . "'>" . "<input type='hidden' name='nome' value='" . $funcionario['nome'] . "'>" . "<input type='submit' class='btn btn-danger' value='excluir'></input>" . "</form></div></td>";
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
            const element = document.querySelector('.btn2');
            if (local === "index") {
                element.classList.add('active');
            } else {
                element.classList.remove('active');
            }
        }
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>