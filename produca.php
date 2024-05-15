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
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: form.php');
    }
    
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
                <li class=""><a href="funcionario.php" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
                        Funcionários</a></li>
                <li class="active"><a href="produca.php" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
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
            <nav class="navbar navbar-expand-md navbar-light bg-light align-items-center justify-content-end">
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
                                    <input type="hidden" value="<?echo $_SESSION['id']?>" name="id">
                                    <button type="submit" class="dropdown-item">sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="dashboard-content px-3 pt-4">
                <h2 class="fs-5"> Dashboard</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, totam? Sequi alias eveniet ut quas
                    ullam delectus et quasi incidunt rem deserunt asperiores reiciendis assumenda doloremque provident,
                    dolores aspernatur neque.</p>
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