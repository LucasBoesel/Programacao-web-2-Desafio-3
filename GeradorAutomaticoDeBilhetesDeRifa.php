<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerador de Bilhetes de Rifa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            padding: 30px;
            user-select: none;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        form {
            background: #ffffff;
            max-width: 500px;
            margin: 0 auto 30px;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button[type="submit"],
        .print-button {
            display: block;
            margin: 20px auto 0;
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2980b9;
        }

        .print-button {
            background: #2ecc71;
        }

        .print-button:hover {
            background: #27ae60;
        }

        .back-button {
            display: block;
            margin: 10px auto 0;
            background: #e67e22;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background: #d35400;
        }

        .bilhete {
            background: #fffdf7;
            border: 2px dashed #7f8c8d;
            padding: 10px;
            margin: 8px;
            width: 180px;
            display: inline-block;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.08);
            position: relative;
        }

        .bilhete::before,
        .bilhete::after {
            content: "";
            width: 10px;
            height: 10px;
            background: #f0f2f5;
            border: 2px solid #7f8c8d;
            border-radius: 50%;
            position: absolute;
        }

        .bilhete::before {
            top: -5px;
            left: -5px;
        }

        .bilhete::after {
            bottom: -5px;
            right: -5px;
        }

        .bilhete h3 {
            margin: 3px 0;
            font-size: 14px;
            color: #2c3e50;
        }

        .bilhete p {
            margin: 3px 0;
            font-size: 11px;
            color: #555;
        }

        .bilhete .numero {
            margin-top: 5px;
            font-size: 18px;
            color: #e74c3c;
        }

        @media print {

            form,
            .print-button {
                display: none;
            }

            body {
                background: white;
            }

            .bilhete {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <h2>🎟️ Gerador de Bilhetes de Rifa</h2>

    <form method="post">
        <label>Nome da Campanha:</label>
        <input type="text" name="campanha" required>

        <label>Prêmio(s):</label>
        <input type="text" name="premio" required>

        <label>Valor do Bilhete (R$):</label>
        <input type="text" name="valor" required>

        <label>Quantidade de Bilhetes:</label>
        <input type="number" name="quantidade" min="1" required>

        <button type="submit">🎫 Gerar Bilhetes</button>
        <button class="back-button" type="button" onclick="window.location.href='index.php'">🔙 Voltar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $campanha = htmlspecialchars($_POST["campanha"]);
        $premio = htmlspecialchars($_POST["premio"]);
        $valor = htmlspecialchars($_POST["valor"]);
        $quantidade = intval($_POST["quantidade"]);

        echo "<button class='print-button' onclick='window.print()'>🖨️ Imprimir Bilhetes</button>";

        for ($i = 1; $i <= $quantidade; $i++) {
            $numero = str_pad($i, 3, "0", STR_PAD_LEFT);
            echo "<div class='bilhete'>
                    <h3>$campanha</h3>
                    <p>Prêmio: $premio</p>
                    <p>Valor: R$ $valor</p>
                    <div class='numero'>Nº $numero</div>
                </div>";
        }
    }
    ?>

</body>

</html>