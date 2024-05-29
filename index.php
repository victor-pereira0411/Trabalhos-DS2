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
    ?>


    <div class="dashboard-content px-3 pt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Funcionários</h5>
                        <p class="card-text">Gerencie os funcionários da produção.</p>
                        <a href="#" class="btn btn-primary">Ver mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Produção</h5>
                        <p class="card-text">Gerencie a produção.</p>
                        <a href="#" class="btn btn-primary">Ver mais</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Folha de pagamento</h5>
                        <p class="card-text">Acesse a folha de pagamento da produção.</p>
                        <a href="#" class="btn btn-primary">Ver mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalusuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <?php
                    if (count($usuario) > 0) {
                    ?>
                        <div class="table-responsive m-4 d-flex justify-content-start align-items-center flex-column">
                            <div>
                                <h2>
                                    Usuários
                                </h2>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>id</th>
                                    <th>nome</th>
                                    <th>senha</th>
                                    <th>Ações</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($usuario as $usuari) {
                                        echo "<tr>";
                                        echo "<td>" . $usuari['idusuario'] . "</td>";
                                        echo "<td>" . $usuari['nome'] . "</td>";
                                        echo "<td>" . $usuari['senha'] . "</td>";
                                        echo "<td class='d-flex flex-row'>" . "<button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalusuedi'>
                                        Editar
                                    </button>";
                                        echo "
                                    <form action='cruds/delFuncionario.php' method='post'>
                                        <input type='hidden' name='id' value='" . $usuari['idusuario'] . "'>
                                        <button class='btn btn-danger'>excluir</button>
                                    </form>
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
    </div>
    <div class="modal fade" id="modalusuedi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <?php
                    $url = "index.php";
                    if (count($usuario) > 0) {
                    ?>
                        <div class="table-responsive m-4 d-flex justify-content-start align-items-center flex-column">
                            <div>
                                <h2>
                                    Usuários
                                </h2>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>id</th>
                                    <th>nome</th>
                                    <th>senha</th>
                                    <th>Ações</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($usuario as $usuari) {
                                        echo "<tr>";
                                        echo "<td>" . $usuari['idusuario'] . "</td>";
                                        echo "<td>" . $usuari['nome'] . "</td>";
                                        echo "<td>" . $usuari['senha'] . "</td>";
                                        echo "<td>" . "<div class='d-flex flex-row'><button class='btn btn-warning'>editar</button>";
                                        echo "
                                    <form action='cruds/delFuncionario.php' method='post'>
                                        <input type='hidden' name='id' value='" . $usuari['idusuario'] . "'>
                                        <input type='hidden' name='id' value='" . $usuari['nome'] . "'>
                                        <button class='btn btn-danger'>excluir</button>
                                    </form>
                                    </td>";
                                        echo "</tr>";
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
            const element = document.querySelector('.btn1');
            if (local === "index") {
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