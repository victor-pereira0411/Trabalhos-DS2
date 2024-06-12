<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();
    require 'database/conne.php';
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM usuario";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $usuario = $resultado->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_GET['sair'])) {
    ?>
        <script>
            var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
            Swal.fire({
                title: "Quer sair da conta?",
                text: "Você será redirecionado para o login",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, sair da conta",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "verifica/logout.php";
                } else {
                    window.location.href = url;
                }
            });
        </script>
    <?php
    }
    if (isset($_GET['idExcUsuPerg'])) {
        $nomeUsu = $_GET['nome_modal'];
        $idmod = $_GET['idExcUsuPerg'];
    ?>
        <script>
            var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
            (function() {
                Swal.fire({
                    title: "Quer mesmo excluir esse usuário?",
                    text: "Você deletará esse usuário!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, excluir usuário!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudUsuario/delUsuario.php?nome_modal=<?php echo $nomeUsu ?>&id=<?php echo $idmod ?>";
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>

    <?php
    }
    if (isset($_GET['nome_editar'])) {
    ?>
        <script>
            (function() {
                var nomeUsuEdi = "<?php echo $_GET['nome_editar'] ?>";
                var senhaEditar = "<?php echo $_GET['senha_editar'] ?>";
                var idEditar = "<?php echo $_GET['ideditar'] ?>";
                var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";

                Swal.fire({
                    title: "Edite o usuário",
                    html: `
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="hidden" class="form-control" id="ideditar" name="ideditar" value="${idEditar}">
                    <input type="text" class="form-control" id="usuario" name="usuario" value="${nomeUsuEdi}">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha" value="${senhaEditar}">
                </div>
            `,
                    showCancelButton: true,
                    confirmButtonText: "Atualizar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        const novoNome = document.getElementById('usuario').value;
                        const novaSenha = document.getElementById('senha').value;
                        const idEditar = document.getElementById('ideditar').value;
                        return [novoNome, novaSenha, idEditar];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const [novoNome, novaSenha, idEditar] = result.value;
                        window.location.href = "crudUsuario/updaUsuario.php?nomeeditar=" + novoNome + "&senhaeditar=" + novaSenha + "&ideditar=" + idEditar;
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['cadastrarUser'])) {
    ?>
        <script>
            (function() {
                var url = "<?php echo $_SERVER['HTTP_REFERER'] ?>";
                Swal.fire({
                    title: "Cadastrar usuário",
                    html: `
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="usuario" name="usuario">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="text" class="form-control" id="senha" name="senha">
                </div>
            `,
                    showCancelButton: true,
                    confirmButtonText: "Cadastrar",
                    cancelButtonText: "Cancelar",
                    showLoaderOnConfirm: true,
                    reverseButtons: true,
                    preConfirm: () => {
                        const Nome = document.getElementById('usuario').value;
                        const Senha = document.getElementById('senha').value;
                        return [Nome, Senha];
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        const [Nome, Senha] = result.value;
                        window.location.href = "crudUsuario/cadUsuario.php?nomUsu=" + Nome + "&senha=" + Senha + "&cadastraUsuario=ok";
                    } else {
                        window.location.href = url;
                    }
                });
            })();
        </script>
    <?php
    }
    if (isset($_GET['sucesso'])) {
    ?>
        <script>
            var novaUrl = "index.php";
            Swal.fire({
                title: "Usuário adicionado com sucesso!",
                text: "O usuário foi inserido no sistema!",
                icon: "success",
                reverseButtons: true,
                willClose: () => {
                    window.location.replace(novaUrl);
                }
            });
        </script>
    <?php
    }
    if (isset($_GET['delete'])) {
    ?>
        <script>
            var novaUrl = "index.php";
            Swal.fire({
                title: "Usuário deletado com sucesso!",
                text: "O usuário foi excluido do sistema!",
                icon: "success",
                reverseButtons: true,
                willClose: () => {
                    window.location.replace(novaUrl);
                }
            });
        </script>
    <?php
    }
    if (isset($_GET['editou'])) {
    ?>
        <script>
            var novaUrl = "index.php";
            Swal.fire({
                title: "Usuário atualizado com sucesso!",
                text: "O usuário foi atualizado no sistema!",
                icon: "success",
                reverseButtons: true,
                willClose: () => {
                    window.location.replace(novaUrl);
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
                <li class="btn1"><a href="index.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i>Painel</a></li>
                <li class="btn2"><a href="funcionario.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                        Funcionários</a></li>
                <li class="btn3"><a href="produca.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-comment"></i> Produção</span>
                    </a>
                </li>
                <li class="btn4"><a href="folha.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>
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
                            <?php
                            if ($id === 1) {
                                echo '
                            <li>
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalgerenciar">
                            Gerenciar usuários
                        </button>
                        </li>
                            ';
                            }
                            ?>
                            <hr class="m-0">
                            <li>
                                <form action="verifica/modalSair.php" method="get">
                                    <input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="id">
                                    <button type="submit" class="dropdown-item">sair</button>
                                </form>
                            </li>
                        </ul>
                        <div class="modal fade" id="modalgerenciar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="card-body">
                                            <div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="px-2 pt-3 pb-4 d-flex justify-content-start">
                                                        <h1 class="fs-3 wrap">Gerenciar usuários</h1>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <form action="modalUsuario/modalCadastrar.php" method="get">
                                                                <input type="hidden" value="cadastro" name="adicionaUser">
                                                                <input class="btn btn-primary" type="submit" value="Adicionar">
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <?php
                                                if (count($usuario) > 0) {
                                                ?>
                                                    <div class="table-responsive-md">
                                                        <table class="table table-bordered table-hover text-center table-lg">
                                                            <thead>
                                                                <th scope="col" id="1">id</th>
                                                                <th scope="col" id="2">nome</th>
                                                                <th scope="col" id="3">senha</th>
                                                                <th class="w-fit-content" scope="col" id="4">ações</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($usuario as $user) {
                                                                    if ($user['nome'] != 'admin') {
                                                                        echo "<tr>";
                                                                        echo "<td headers='1'>" . $user['idusuario'] . "</td>";
                                                                        echo "<td headers='2'>" . $user['nome'] . "</td>";
                                                                        echo "<td headers='3'>" . $user['senha'] . "</td>";
                                                                        echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='modalUsuario/modalEditar.php' method='get'> " .
                                                                            "<input type='hidden' name='senha' value='" . $user['senha'] . "'>" . "<input type='hidden' name='id' value='" . $user['idusuario'] . "'>" . "<input type='hidden' name='nome' value='" . $user['nome'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                                                                        echo "<form action='modalUsuario/modalExcluir.php' method='get'> " .
                                                                            "<input type='hidden' name='id' value='" . $user['idusuario'] . "'>" . "<input type='hidden' name='nome' value='" . $user['nome'] . "'>" . "<input type='submit' class='btn btn-danger' value='excluir'></input>" . "</form></div></td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                <?php } else {
                                                    echo "<div class='d-flex justify-content-center mt-5'>
                            <h4 class=''>Você não possui usuários cadastrados</h4>
                            </div>
                            ";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>
            <script>
                var sidebar = document.getElementById("side_nav");
                window.addEventListener("scroll", function() {
                    sidebar.style.top = window.pageYOffset + "px";
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
            </script>
</body>

</html>