<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }

        .buttons {
            text-align: center;
        }

        .buttons button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        .buttons a {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
    <title>Obrigado por enviar seu chamado!</title>
    </head>
<body>
<div class="container">
    <h1>Obrigado por enviar seu chamado!</h1>
    <div class="message">
        <p>Seu chamado foi recebido com sucesso. Aguarde o contato da equipe responsável.</p>
    </div>
    <div class="buttons">
        <a href="chamados_leo.php">Criar Chamados(Manutenção)</a>
        <a href="chamados_ti.php">Criar Chamados(TI)</a>
        <a href="user_chamados.php">Ver Meus Chamados</a>
        <a href="home.php">Pagina Inicial</a>
    </div>
    <div class="ticket-id">
        <?php
        // recupera o ID do chamado do banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "suporte";

        // cria a conexão com o banco de dados
        $conn = new mysqli($servername, $username, $password, $dbname);

        // verifica se a conexão foi estabelecida com sucesso
        if ($conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
        }

        // executa a consulta para recuperar o ID do último chamado inserido
        $sql = "SELECT id FROM chamados_ti ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        // verifica se a consulta retornou resultados
        if ($result->num_rows > 0) {
            // exibe o ID do chamado
            $row = $result->fetch_assoc();
            echo "<p>Seu ID de chamado: <span id='ticketId'>" . $row["id"] . "</span></p>";
        } else {
            echo "Nenhum chamado foi encontrado.";
        }

        // fecha a conexão com o banco de dados
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>

