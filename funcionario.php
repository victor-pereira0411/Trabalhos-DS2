<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/funcionario.css">
</head>

<body>
    <?php
    session_start();
    require 'conne.php';
    if (!isset($_SESSION['id'])) {
        header('Location: form.php');
    }
    $sql = "SELECT * FROM funcionarios";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $funcionarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['sair'])) {
    ?>
        <script>
            Swal.fire({
                title: "Quer sair da conta?",
                text: "Você será redirecionado para o login",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, sair da conta"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "verifica/logout.php";
                }
            });
        </script>
    <?php
    }

    ?>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">CS</span> <span class="text-white">CeramicSoft</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="material-icons">menu</i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class=""><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i>Painel</a></li>
                <li class="active"><a href="funcionario.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                        Funcionários</a></li>
                <li class=""><a href="produca.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-comment"></i> Produção</span>
                    </a>
                </li>
                <li class=""><a href="despesas.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-envelope-open-text"></i> Despesas</a></li>
                <li class=""><a href="folha.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
                        Folha de pagamento</a></li>
            </ul>
            <hr class="h-color mx-2">

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="nav container-fluid p-0 justify-content-end">
                    <div class="d-flex d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="material-icons">menu</i></button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Configurações
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="verifica/logout.php">bgwar</a></li>
                            <li><a class="dropdown-item" href="verifica/logout.php">ffff</a></li>
                            <hr class="m-0">
                            <li>
                                <form action="verifica/modal.php" method="get">
                                    <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
                                    <button type="submit" class="dropdown-item">sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="dashboard-content px-3 pt-4">
                <div class="fs-4 m-2 mt-1 d-flex justify-content-between flex-column">
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
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    <?php
                    } else if (isset($_GET['delete'])) {
                        $nomefundel = $_GET['nome_funcionario'];
                    ?>

                        <div class="container">
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <?php echo $nomefundel ?> deletado com sucesso!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
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
                <div class="table-responsive m-4 d-flex justify-content-center align-items-center">
                    <table class="table">
                        <thead>
                            <th>matrícula</th>
                            <th>nome</th>
                            <th>Ganho(milheiro)</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($funcionarios as $funcionario) {
                                echo "<tr>";
                                echo "<td>" . $funcionario['matricula'] . "</td>";
                                echo "<td>" . $funcionario['nome'] . "</td>";
                                echo "<td>" . $funcionario['ganhoMilheiro'] . "</td>";
                                echo "<td>" . "<div class='d-flex flex-row'><button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modaleditar'>editar</button>";
                                echo "
                                    <form action='cruds/delFuncionario.php' method='get'> " .
                                    "<input type='hidden' name='matricula' value='" . $funcionario['matricula'] . "'>" .
                                    "<input type='hidden' name='nome' value='" . $funcionario['nome'] . "'>" .
                                    "<button type='submit' class='btn btn-danger'>excluir</button>" .
                                    "</form>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>

                        </tbody>
                    </table>
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
    </script>
</body>

</html>