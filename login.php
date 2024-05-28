<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <div class="container mt-5">
        <div class="justify-content-center d-flex ">
            <?php
            if (isset($_GET['entrou'])) {
                if ($_GET['entrou'] == "errado") {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Usuário ou senha incorreto
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } elseif ($_GET['entrou'] == "nao") {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Preencha todos os campos
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }

            ?>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body shadow">
                        <div class="header-box px-2 pt-3 d-flex justify-content-center">
                            <h1 class="fs-4"><span class="bg-dark text-white rounded shadow px-2 me-2">CS</span> <span class="text-black">CeramicSoft</span></h1>
                        </div>
                        <div class="mensagem px-2 pt-3 pb-4 justify-content-center d-flex ">
                            <div class="d-flex justify-content-center">
                                <h1 class="fs-3">Login</h1>
                            </div>
                        </div>
                        <form action="verifica/login.php" method="post" data-parsley-validate>
                            <div class="pb-3">
                                <label for="text" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="pb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control " id="senha" name="senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="btn">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/parsleyjs/dist/parsley.min.js"></script>
    <link rel="stylesheet" href="node_modules/parsleyjs/src/parsley.css">
    <script src="node_modules/parsleyjs/dist/i18n/pt-br.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>