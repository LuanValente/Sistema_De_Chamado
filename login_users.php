<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>Login do Sistema de Chamado</title>
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

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 3px;
        text-align: center;
        margin-left: center; /* Centraliza as caixas de email e senha horizontalmente */
        margin-right: center;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #008B5E;
        color: #FFF;
        border: 1px solid #ccc;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #00734E;
    }

    .error-message {
        color: #FF0000;
        text-align: center;
    }
</style>
</head>
<body>
    <h1>Login do Sistema de Chamado</h1>
    <form method="post" action="login_users.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required autocomplete="email">
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required autocomplete="current-password">
        <br>
        <input type="submit" value="Login">
        <?php if(isset($login_error)): ?>
            <p class="error-message"><?php echo $login_error; ?></p>
        <?php endif; ?>
    </form>
    <br>
    <form method="post" action="cadastro_users.php">
        <label for="cadastrar">Não possui uma conta? Cadastre-se:</label>
        <input type="submit" id="cadastrar" name="cadastrar" value="Cadastre-se">
    </form>
</body>
</html>
<?php
session_start();

// Conexão com o banco de dados
$conexao = mysqli_connect("localhost", "root", "", "suporte");

// Verifica se houve um envio de formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Consulta no banco de dados se o email e senha existem na tabela "cadastro"
    $consulta = "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $consulta);

    // Verifica se encontrou algum registro com o email e senha informados
    if (mysqli_num_rows($resultado) == 1) {
        // Inicia a sessão e redireciona para home.php
        $_SESSION["email"] = $email;
        header("Location: home.php");
        exit();
    } else {
        echo "Email ou senha inválidos.";
    }
}
?>