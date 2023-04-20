<?php
// Conecta ao banco de dados
$conexao = mysqli_connect("localhost", "root", "", "suporte");

// Verifica se a conexão foi bem-sucedida
if (mysqli_connect_errno()) {
    echo "Falha ao conectar ao banco de dados: " . mysqli_connect_error();
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém o nome, email e senha do formulário
    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";

    // Verifica se os campos foram preenchidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {

        // Insere os dados do usuário no banco de dados
        $query = "INSERT INTO cadastro (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        $resultado = mysqli_query($conexao, $query);

        // Verifica se o cadastro foi realizado com sucesso
        if ($resultado) {
            echo "Cadastro realizado com sucesso.";
        } else {
            echo "Erro ao cadastrar o usuário: " . mysqli_error($conexao);
        }
    } else {
        // Se os campos estiverem vazios, exibe uma mensagem de erro
        echo "Por favor, preencha todos os campos.";
    }
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro Sistema de Chamados Comal </title>
    <style>
        body {
            background-color: #E0F2E9;
            font-family: Arial, sans-serif;
            align-items: center; /* Centraliza verticalmente */
            justify-content: center; /* Centraliza horizontalmente */
            height: 100vh; 
        }

        h1 {
            text-align: center;
            color: #008B5E;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #F0F8F7;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);

        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #008B5E;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 3px;
            text-align: center;
            margin-left: auto; /* Centraliza as caixas de texto horizontalmente */
            margin-right: auto;
        }

        input[type="submit"],
        .btn { /* Adicione a classe .btn para estilizar os botões de login e cadastro */
            width: 100%;
            padding: 10px;
            background-color: #008B5E;
            color: #FFF;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px; /* Adicione essa linha para adicionar espaço entre os botões */
        }

        input[type="submit"]:hover,
        .btn:hover { /* Adicione a classe .btn:hover para estilizar o hover dos botões de login e cadastro */
            background-color: #00734E;
        }

        .error-message {
            color: #FF0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="cadastro_users.php"> 
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br><br>
        <input type="submit" value="Cadastrar" class="btn">
        <input type="button" value="Fazer login" onclick="window.location.href='login_users.php'" class="btn">
    </form>
</body>
</html>
