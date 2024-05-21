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
        <h2 class="fs-5"> Dashboard</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum, totam? Sequi alias eveniet ut quas
            ullam delectus et quasi incidunt rem deserunt asperiores reiciendis assumenda doloremque provident,
            dolores aspernatur neque.</p>
    </div>
    </div>
    </div>
    <script>
        const local = "folha";
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

        function removeClassOnSmallScreen() {
            const local = "folha";
            const element = document.querySelector('.btn4'); // Elemento Bootstrap com a classe a ser removida

            // Verifica se a largura da tela é menor que 768px (padrão para tablets e dispositivos menores)
            if (local === "folha") {
                // Remove a classe do Bootstrap
                element.classList.add('active');
            } else {
                // Adiciona a classe do Bootstrap se a largura da tela for maior ou igual a 768px
                element.classList.remove('justify-content-end');
            }
        }

        // Chama a função quando a página carrega e quando a janela é redimensionada
        window.addEventListener('load', removeClassOnSmallScreen);
        window.addEventListener('resize', removeClassOnSmallScreen);
    </script>
</body>

</html>