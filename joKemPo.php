<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Jo-Ken-Pô</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1E2A38 0%, #141E30 100%);
            color: #F0F4FF;
            text-align: center;
            padding: 40px 20px;
            min-height: 100vh;
            box-sizing: border-box;
            user-select: none;
        }

        .container {
            background-color: rgba(39, 56, 76, 0.95);
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            max-width: 600px;
            margin: auto;
        }

        h1 {
            font-size: 2.5rem;
            color: #A084CA;
            margin-bottom: 30px;
        }

        form {
            margin-top: 20px;
        }

        .choice-btn {
            padding: 12px 25px;
            margin: 10px;
            font-size: 18px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            background-color: #384C63;
            color: #F0F4FF;
            transition: background 0.3s, transform 0.2s;
        }

        .choice-btn:hover {
            background-color: #A084CA;
            color: #1E2A38;
            transform: scale(1.05);
        }

        .resultado {
            margin-top: 30px;
            font-size: 20px;
        }

        .vitoria {
            color: #4CAF50;
            font-weight: bold;
        }

        .derrota {
            color: #FF4C4C;
            font-weight: bold;
        }

        .empate {
            color: #FFD700;
            font-weight: bold;
        }

        .gif {
            width: 100px;
            height: 100px;
            object-fit: contain;
            margin: 10px;
        }

        .jogar-novamente,
        .voltar {
            margin-top: 20px;
            background: #A084CA;
            color: #1E2A38;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .jogar-novamente:hover,
        .voltar:hover {
            background-color: #C6B0E6;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Jo-Ken-Pô 🪨📄✂️</h1>

        <?php
        function getGif($escolha)
        {
            $caminhoBase = "assets/img/";
            switch ($escolha) {
                case 'Pedra':
                    return $caminhoBase . "pedra.png";
                case 'Papel':
                    return $caminhoBase . "papel.png";
                case 'Tesoura':
                    return $caminhoBase . "tesoura.png";
                default:
                    return "";
            }
        }

        function determinarResultado($jogador, $computador)
        {
            if ($jogador === $computador)
                return "Empate!";
            if (
                ($jogador === "Pedra" && $computador === "Tesoura") ||
                ($jogador === "Papel" && $computador === "Pedra") ||
                ($jogador === "Tesoura" && $computador === "Papel")
            ) {
                return "Você venceu! 🎉";
            } else {
                return "Você perdeu! 😢";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opcoes = ["Pedra", "Papel", "Tesoura"];
            $jogador = $_POST["escolha"];
            $computador = $opcoes[rand(0, 2)];

            $resultado = determinarResultado($jogador, $computador);
            $gifJogador = getGif($jogador);
            $gifComputador = getGif($computador);

            $classeResultado = '';
            if ($resultado === "Você venceu! 🎉") {
                $classeResultado = "vitoria";
            } elseif ($resultado === "Você perdeu! 😢") {
                $classeResultado = "derrota";
            } elseif ($resultado === "Empate!") {
                $classeResultado = "empate";
            }

            echo "<div class='resultado'>
                <h2>Resultado:</h2>
                <p><strong>Você escolheu:</strong> $jogador</p>
                <img src='$gifJogador' alt='$jogador' class='gif'>
                <p><strong>Computador escolheu:</strong> $computador</p>
                <img src='$gifComputador' alt='$computador' class='gif'>
                <p class='$classeResultado'><strong>$resultado</strong></p>

                <form method='get'>
                    <button class='jogar-novamente'>🔁 Jogar Novamente</button>
                </form>
                <form action='index.php'>
                    <button class='voltar'>⬅️ Voltar</button>
                </form>
            </div>";
        } else {
            echo "
            <form method='post'>
                <button type='submit' name='escolha' value='Pedra' class='choice-btn'>🪨 Pedra</button>
                <button type='submit' name='escolha' value='Papel' class='choice-btn'>📄 Papel</button>
                <button type='submit' name='escolha' value='Tesoura' class='choice-btn'>✂️ Tesoura</button>
            </form>
            <form action='index.php'>
                <button class='voltar'>⬅️ Voltar</button>
            </form>";
        }
        ?>
    </div>
</body>

</html>
