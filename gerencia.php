<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    session_start();
    require 'database/conne.php';
    if (!isset($_SESSION['id'])) {
        header('Location: form.php');
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM usuario";
    $resultado = $conn->prepare($sql);
    $resultado->execute();
    $usuario = $resultado->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_GET['idExcUsu'])) {
        $nomeUsu = $_GET['nome_modal'];
        $idmod = $_GET['id'];
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

    <div class="container mt-5">
        <div  class="row justify-content-center">
            <div class="col-md-6 col-lg-4 w-75 ">
                <div class="card">
                    <div  class="card-body ">
                        <div class="d-flex flex-direction-row justify-content-between align-items-center">
                            <div class="px-2 pt-3 pb-4 d-flex justify-content-start">
                                <h1 class="fs-3">Gerenciar usuários</h1>
                            </div>
                            <div>
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalcadastrar">
                                        adicionar
                                    </button>
                                    <!-- Modal -->
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
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <?php echo $nomeUsu ?> cadastrado com sucesso!
                                    <a href="gerencia.php" class="btn btn-close"></a>
                                </div>
                            </div>
                        <?php
                        } else if (isset($_GET['delete'])) {
                            $nomeUsuDel = $_GET['nome_usuario'];
                        ?>

                            <div class="container">
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <?php echo $nomeUsuDel ?> deletado com sucesso!
                                    <a href="gerencia.php" class="btn btn-close"></a>
                                </div>
                            </div>

                        <?php
                        } else if (isset($_GET['editou'])) {
                            $nomeUsuario = $_GET['nomeUsuario'];
                        ?>

                            <div class="container">
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <?php echo $nomeUsuario ?> atualizado com sucesso!
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
                                    <div style="width: 800px;" class="table-responsive">
                                        <table class="table table-bordered table-hover text-center table-md">
                                            <thead>
                                                <th style="width: 20px;" scope="col" id="1">id</th>
                                                <th style="width: 70px;" scope="col" id="2">nome</th>
                                                <th style="width: 70px;" scope="col" id="3">senha</th>
                                                <th class="w-fit-content" style="width: 20px;" scope="col" id="4">ações</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($usuario as $user) {
                                                    if ($user['nome'] != 'admin') {
                                                        echo "<tr>";
                                                        echo "<td headers='1'>" . $user['idusuario'] . "</td>";
                                                        echo "<td headers='2'>" . $user['nome'] . "</td>";
                                                        echo "<td headers='3'>" . $user['senha'] . "</td>";
                                                        echo "<td headers='4'>" . "<div class='botaos d-flex flex-row gap-1 justify-content-center'><form action='verifica/modaleditar.php' method='get'> " .
                                                            "<input type='hidden' name='senha' value='" . $user['senha'] . "'>" . "<input type='hidden' name='id' value='" . $user['idusuario'] . "'>" . "<input type='hidden' name='nome' value='" . $user['nome'] . "'>" . "<input type='submit' class='btn btn-warning' value='editar'></input>" . "</form>";
                                                        echo "<form action='verifica/modalexcluir.php' method='get'> " .
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
</body>

</html>