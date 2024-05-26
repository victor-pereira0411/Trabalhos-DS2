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
    if (isset($_GET['idExcUsu'])) {
        $nomeUsu = $_GET['nome_modal'];
        $idmod = $_GET['idExcUsu'];
    ?>
        <script>
            (function() {
                Swal.fire({
                    title: "Quer mesmo excluir esse usuário?",
                    text: "Você deletará esse usuário!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sim, excluir usuário!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "crudUsuario/delUsuario.php?nome_modal=<?php echo $nomeUsu ?>&id=<?php echo $idmod ?>";
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

                    }
                });
            })();
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
                            <li><a class="dropdown-item" href="verifica/logout.php">bgwar</a></li>
                            <?php
                            if ($id === 1) {
                                echo '
                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalgerenciar">
                            adicionar
                        </button></li>
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
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="card-body ">
                                            <div class="d-flex flex-direction-row justify-content-between align-items-center">
                                                <div class="px-2 pt-3 pb-4 d-flex justify-content-start">
                                                    <h1 class="fs-3">Gerenciar usuários</h1>
                                                </div>
                                                <div>
                                                    <div>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcadastrar">
                                                            adicionar
                                                        </button>
                                                        <div class="modal fade" id="modalcadastrar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar usuário</h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="needs-validation" action="crudUsuario/cadUsuario.php" method="post">
                                                                            <div class="mb-3">
                                                                                <label for="text" class="form-label">Nome do usuário</label>
                                                                                <input type="text" class="form-control" id="nomUsu" name="nomUsu" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="int" class="form-label">Senha</label>
                                                                                <input type="int" class="form-control" id="senha" name="senha" required>
                                                                            </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                                        <input type="submit" class="btn btn-primary" name="btnUsu" value="Cadastrar"></input>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if (isset($_GET['sucesso'])) {
                                                $nomeUsu = $_GET['nomeUsu'];
                                            ?>
                                                <div class="container">
                                                    <div class='alert alert-success alert-dismissible fade show d-flex flex-row align-items-center' role='alert'>
                                                        <div>
                                                        <p><?php echo $nomeUsu ?> cadastrado com sucesso!</p>
                                                        </div>
                                                        <div class="d-flex align-items-center ">
                                                        <a href="gerencia.php" class="btn btn-close"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } else if (isset($_GET['delete'])) {
                                                $nomeUsuDel = $_GET['nome_usuario'];
                                            ?>

                                                <div class="container">
                                                    <div class='alert alert-danger alert-dismissible fade show d-flex flex-row align-items-center' role='alert'>
                                                        <p><?php echo $nomeUsuDel ?> deletado com sucesso!</p>
                                                        <a href="gerencia.php" class="btn btn-close"></a>
                                                    </div>
                                                </div>

                                            <?php
                                            } else if (isset($_GET['editou'])) {
                                                $nomeUsuario = $_GET['nomeUsuario'];
                                            ?>

                                                <div class="container">
                                                    <div class='alert alert-success alert-dismissible fade show d-flex flex-row align-items-center' role='alert'>
                                                        <p><?php echo $nomeUsuario ?> atualizado com sucesso!</p>
                                                        <a href="gerencia.php" class="btn btn-close"></a>
                                                    </div>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <div class="d-flex justify-content-center">
                                                <?php
                                                if (count($usuario) > 0) {
                                                ?>
                                                    <!-- <div class="m-4 d-flex justify-content-center align-items-center overflow-x-auto"> -->
                                                    <div class="table-responsive">
                                                        <table style="width: 400px;" class="table table-bordered table-hover text-center table-md">
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
                                                                        echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='verifica/modalEditar.php' method='get'> " .
                                                                            "<input type='hidden' name='senha' value='" . $user['senha'] . "'>" . "<input type='hidden' name='id' value='" . $user['idusuario'] . "'>" . "<input type='hidden' name='nome' value='" . $user['nome'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                                                                        echo "<form action='verifica/modalExcluir.php' method='get'> " .
                                                                            "<input type='hidden' name='id' value='" . $user['idusuario'] . "'>" . "<input type='hidden' name='nome' value='" . $user['nome'] . "'>" . "<input type='submit' class='btn btn-danger' value='excluir'></input>" . "</form></div></td>";
                                                                        echo "</tr>";
                                                                    }
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- </div> -->
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
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>
            <script>
                // Obtém a barra lateral
                var sidebar = document.getElementById("side_nav");

                // Adiciona um listener para o evento de scroll da janela
                window.addEventListener("scroll", function() {
                    // Define a margem superior da barra lateral para a posição atual do scroll
                    sidebar.style.top = window.pageYOffset + "px";
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