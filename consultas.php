<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Precificações</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
        }

        .navbar {
            background-color: transparent;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-right: 20px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .navbar ul li a:hover {
            color: #aaa;
            animation: pulse 0.5s infinite;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }

        .container {
            margin-top: 100px;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 50px;
        }

        .card {
            width: 300px;
            background-color: #fff;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .card-price {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 16px;
        }

        .card-green {
            background-color: #72c77e;
            color: #fff;
        }

        .card-blue {
            background-color: #3a86ff;
            color: #fff;
        }

        .card-orange {
            background-color: #ff6b35;
            color: #fff;
        }

        .card-purple {
            background-color: #8a63d2;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="logo">Consulta de Precificação</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="painel.php">Painel Administrativo</a></li>
            <li><a href="?logout">Sair</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Consulta de Precificações</h1>
        <div class="row">
            <?php
            // Verifica se o usuário está logado e se possui permissão de administrador
            session_start();

            if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
                // Redireciona para a página de login ou exibe uma mensagem de erro
                header("Location: index.php");
                exit; // Importante: encerra a execução do script após o redirecionamento
            }

            if (isset($_GET['logout'])) {
                // Destroi a sessão atual
                session_destroy();

                // Redireciona para a página de login ou qualquer outra página desejada após o logout
                header("Location: index.php");
                exit; // Importante: encerra a execução do script após o redirecionamento
            }

            // Conexão com o banco de dados aqui...
            include_once('conexao.php');

            // Consulta SQL para selecionar os dados da tabela
            $sql = "SELECT * FROM servicos";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cf = $row["custo_fixo"];
                    $du = $row["dias_uteis"];
                    $vd = $row["valor_dia"];
                    $qm = $row["membros"];
                    $cv = $row["custos_variaveis"];
                    $mi = $row["margem_incerteza"];
                    switch($row["porte"]){
                        case "Grande":
                          $porte = 1.4;
                          break;
                        case "Pequeno":
                          $porte = 1.1;
                          break;
                        case "Microempresa":
                          $porte = 1.05;
                          break;
                        case "Empreendedor":
                          $porte = 1;
                          break;
                        
                    }

                    // Cálculo do preço piso
                    $preco_piso = (($cf + ($du * $vd * $qm) + ($cv * (1 + $mi))) * $porte) / 0.02;
                    $preco_teto = $preco_piso * 0.9;
                    $media = ($preco_piso + $preco_teto) / 2;

                    // Define a classe e o ícone do card com base no índice do loop
                    $card_classes = ['card-green', 'card-blue', 'card-orange', 'card-purple'];
                    $card_icon_classes = ['fas fa-chart-line', 'fas fa-dollar-sign', 'fas fa-gem', 'fas fa-rocket'];
                    $card_index = ($result->num_rows + 1) % count($card_classes);

                    echo '<div class="col-md-4">';
                    echo '<div class="card ' . $card_classes[$card_index] . '">';
                    echo '<div class="card-icon"><i class="' . $card_icon_classes[$card_index] . '"></i></div>';
                    echo '<div class="card-title">' . $row["servico"] . '</div>';
                    echo '<div class="card-price">' . $row["empresa"] . '</div> </br>';
                    echo '<div class="card-price">Porte: ' . $row["porte"] . '</div>';
                    echo '<div class="card-price">Preço Piso: R$ ' . number_format($preco_piso, 2, ',', '.') . '</div>';
                    echo '<div class="card-price">Preço Teto: R$ ' . number_format($preco_teto, 2, ',', '.') . '</div>';
                    echo '<div class="card-price">Preço Médio: R$ ' . number_format($media, 2, ',', '.') . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nenhum serviço encontrado.";
            }

            // Fecha a conexão com o banco de dados
            $connect->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
