<?php
// Inicie a sessão
session_start();

// Verifique se o usuário está logado e obter o e-mail do usuário logado
if (isset($_SESSION['email'])) {
    $emailLogado = $_SESSION['email'];
} else {
    $emailLogado = '';
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conecta ao banco de dados
    $conexao = mysqli_connect('localhost', 'root', '', 'suporte');

    // Verifica se a conexão foi bem-sucedida
    if (!$conexao) {
        die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    // Pega os dados do formulário
    $email = mysqli_real_escape_string($conexao, $emailLogado);
    $prioridade = mysqli_real_escape_string($conexao, $_POST['prioridade']);
    $assunto = mysqli_real_escape_string($conexao, $_POST['assunto']);
    $mensagem = mysqli_real_escape_string($conexao, $_POST['mensagem']);

    // Verifica se todos os campos foram preenchidos
    if (empty($prioridade) || empty($assunto) || empty($mensagem)) {
        echo 'Por favor, preencha todos os campos antes de finalizar o chamado.';
        exit;
    }

    // Insere os dados na tabela
    $sql = "INSERT INTO chamados (email, prioridade, assunto, mensagem) VALUES ('$email', '$prioridade', '$assunto', '$mensagem')";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se a inserção foi bem-sucedida
    if ($resultado) {
        header('Location: tela_manutençao.php');
    } else {
        echo 'Erro ao criar chamado: ' . mysqli_error($conexao);
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);
}
?>

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

        .back-btn {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        textarea {
            height: 150px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>
    <title>Sistema de Chamados Comal(Manutenção)</title>
    </head>
<body>
<div class="container">
    <div class="back-btn">
        <a href="home.php">Voltar</a>
    </div>
    <h1>Sistema de Chamados Comal(Manutenção)</h1>
    <form method="post">
        <label>Email:</label><br>
        <input type="text" name="email" value="<?php echo $emailLogado; ?>"><br> <!-- Atribui o valor do e-mail do usuário logado ao campo de e-mail -->
        <label>Prioridade:</label><br>
        <select name="prioridade">
            <option value="Urgente">Urgente</option>
            <option value="Alta">Alta</option>
            <option value="Média">Média</option>
            <option value="Baixa">Baixa</option>
        </select><br>

        <label>Assunto:</label><br>
        <input type="text" name="assunto"><br>
        <label>Mensagem:</label><br>
        <textarea name="mensagem"></textarea><br>
        <input type="submit" value="Enviar">
    </form>
    </div>
</body>
</html>
