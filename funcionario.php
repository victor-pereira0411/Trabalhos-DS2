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
    $sql = "SELECT * FROM funcionarios";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $funcionarios = $resultado->fetchAll();
    require 'template/sidebar.php';
    if (isset($_GET['matModEditFunc'])) {
    ?>
        <script>
            (function() {
                var nomeModEditFunc = "<?php echo $_GET['nomeModEditFunc'] ?>";
                var ganhoMilhModEditFunc = "<?php echo $_GET['ganhoMilhModEditFunc'] ?>";
                var matModEditFunc = "<?php echo $_GET['matModEditFunc'] ?>";

                Swal.fire({
                    title: "Edite o funcionário",
                    html: `
                    <?php
                    if (isset($_GET["dados"])) {
                        echo "<div class='container'>
                                <div class='alert alert-danger alert-dismissible fade show fs-6' role='alert'>
                                    Preencha todos os campos
                                    <a href='funcionario.php?nomeModEditFunc=" . $_GET['nomeModEditFunc'] . "&matModEditFunc=" . $_GET['matModEditFunc'] . "&ganhoMilhModEditFunc=" . $_GET['ganhoMilhModEditFunc'] . "' class='btn btn-close'></a>
                                </div>
                            </div>";
                    } else if (isset($_GET['funcExiste'])) {
                        $funExiste = $_GET['nomeFuncionario'];
                        echo "<div class='container'>
                                <div class='alert alert-warning alert-dismissible fade show fs-6' role='alert'>
                                    Já possui funcionário com o nome $funExiste cadastrado!
                                    <a href='funcionario.php?nomeModEditFunc=" . $_GET['nomeModEditFunc'] . "&matModEditFunc=" . $_GET['matModEditFunc'] . "&ganhoMilhModEditFunc=" . $_GET['ganhoMilhModEditFunc'] . "' class='btn btn-close'></a>
                                </div>
                            </div>";
                    }
                    ?> 
                    <div class="mb-3">
                        <div class= "d-flex justify-content-start">
                        <label for="nomeModEditFunc" class="form-label">Nome do funcionário<span class="text-danger">*</span></label>
                        </div>
                        <input type="hidden" class="form-control" id="matModEditFunc" name="matModEditFunc" value="${matModEditFunc}">
                        <input type="text" class="form-control" id="nomeModEditFunc" name="nomeModEditFunc" value="${nomeModEditFunc}">
                    </div>
                    <div class="mb-3">
                        <div class= "d-flex justify-content-start">
                        <label for="ganhoMilhModEditFunc" class="form-label">Ganho por milheiro<span class="text-danger">*</span></label>
                        </div>
                        <input type="number" class="form-control" id="ganhoMilhModEditFunc" name="ganhoMilhModEditFunc" value="${ganhoMilhModEditFunc}">
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
                        window.location.href = "funcionario.php";
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
                        window.location.href = "funcionario.php";
                    }
                });
            })();
        </script>

    <?php
    }
    if (isset($_GET['cadastrarFunc'])) {
    ?>
        <script>
            (function() {
                Swal.fire({
                    title: "Cadastrar funcionários",
                    html: `<?php
                            if (isset($_GET["dados"])) {
                                echo "<div class='container'>
                                <div class='alert alert-danger alert-dismissible fade show fs-6' role='alert'>
                                    Preencha todos os campos
                                    <a href='funcionario.php?cadastrarFunc=ok' class='btn btn-close'></a>
                                </div>
                            </div>";
                            } else if (isset($_GET['funExiste'])) {
                                $funExiste = $_GET['nomeFunExiste'];
                                echo "<div class='container'>
                                <div class='alert alert-warning alert-dismissible fade show fs-6' role='alert'>
                                    Já possui funcionário com o nome $funExiste cadastrado!
                                    <a href='funcionario.php?cadastrarFunc=ok' class='btn btn-close'></a>
                                </div>
                            </div>";
                            }
                            ?> 
                    <div class="mb-3">
                        <div class="d-flex justify-content-start">
                            <label for="nome" class="form-label">Nome do funcionário<span class="text-danger">*</span></label>
                        </div>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-start">
                            <label for="ganhoMilheiro" class="form-label">Ganho por milheiro<span class="text-danger">*</span></label>
                        </div>
                        <input type="number" class="form-control" id="ganhoMilheiro" required>
                    </div>`,
                    showCancelButton: true,
                    confirmButtonText: "Cadastrar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        const nomeFunc = document.getElementById('nome').value;
                        const ganhoMilh = document.getElementById('ganhoMilheiro').value;
                        return [nomeFunc, ganhoMilh];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const [nomeFunc, ganhoMilh] = result.value;
                        window.location.href = "crudFunc/cadFuncionario.php?nomeFunc=" + nomeFunc + "&ganhoMilheiro=" + ganhoMilh;
                    } else {
                        window.location.href = "funcionario.php";
                    }
                });
            })();
        </script>
    <?php
    }
    ?>
    <div class="dashboard-content px-3 pt-4">
        <div class="fs-4 m-2 mt-1 d-flex justify-content-between flex-column">
            <div class="fs-4 m-2 mt-1 d-flex justify-content-between ">
                <h2>Funcionários</h2>
                <form action="modalFunc/modalCadastrar.php" method="get">
                    <input class="btn btn-primary" type="submit" name="cadastrar" value="adicionar">
                </form>
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
                        <div class='alert alert-warning alert-dismissible fade show fs-6' role='alert'>
                            Funcionário ainda deve ser pago para ser editado ou excluido!
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
            const local = "funcionario";
            const element = document.querySelector('.btn2');
            if (local === "funcionario") {
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