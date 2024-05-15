<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body ">
                        <div class="header-box px-2 pt-3  d-flex justify-content-center">
                            <h1 class="fs-4"><span class="bg-dark text-white rounded shadow px-2 me-2">CS</span> <span class="text-black">CeramicSoft</span></h1>
                        </div>
                        <div class="px-2 pt-3 pb-4 d-flex justify-content-center">
                            <h1 class="fs-3">Cadastro</h1>
                        </div>

                        <form action="verifica/cadastra.php" method="post">
                            <div class="mb-3">
                                <label for="text" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <div class="mb-3 form">
                                <a class="text-decoration-none" href="form.php">Já possui conta? Acesse agora</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="btn">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>