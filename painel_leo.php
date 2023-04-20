<!DOCTYPE html>
<html>
<head>
    <title>Vizualização de Chamados Comal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #009933;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #009933;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        select {
            padding: 5px;
            border: none;
            background-color: #009933;
            color: #fff;
            cursor: pointer;
        }

        select:focus {
            outline: none;
        }

        form {
            display: inline-block;
            margin-bottom: 20px;
        }

        form select {
            padding: 8px;
        }

        form label {
            color: #009933;
            margin-right: 10px;
        }

        form option {
            background-color: #fff;
            color: #009933;
        }

        form option:checked {
            background-color: #009933;
            color: #fff;
        }

        form option:hover {
            background-color: #009933;
            color: #fff;
        }

        input[type="submit"] {
            padding: 8px;
            background-color: #009933;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #008026;
        }

        input[type="submit"]:focus {
            outline: none;
        }
    </style>
</head>
<body>
<h1>Olá Administrador Leonardo, Bem Vindo à Visualização de Chamados Comal</h1>
<?php
// Configurações do banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "suporte";

// Conexão com o banco de dados
$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Função para executar queries e retornar o resultado
function executeQuery($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    return $result;
}

// Função para escapar caracteres especiais para evitar SQL Injection
function escapeString($str)
{
    global $conn;
    return mysqli_real_escape_string($conn, $str);
}

// Verifica se o formulário foi submetido para atualizar o status de um chamado
if (isset($_POST["id"]) && isset($_POST["status"])) {
    $id = escapeString($_POST["id"]);
    $status = escapeString($_POST["status"]);
    $sql = "UPDATE chamados SET status = '$status' WHERE id = $id";
    executeQuery($sql);
}

// Verifica se o formulário foi submetido para filtrar os chamados por status
if (isset($_POST["filtro"])) {
    $filtro = escapeString($_POST["filtro"]);
    // Query para selecionar os chamados com o status selecionado no filtro
    if ($filtro == "Em Aberto" || $filtro == "Em Andamento" || $filtro == "Completo") {
        $sql = "SELECT * FROM chamados WHERE status = '$filtro'";
    } else {
        $sql = "SELECT * FROM chamados";
    }
    $result = executeQuery($sql);
} else {
    // Query para selecionar todos os chamados
    $sql = "SELECT * FROM chamados";
    $result = executeQuery($sql);
}

?>

<!-- Formulário para filtrar os chamados por status -->
<form method="post" style="margin-bottom: 20px;">
    <label for="filtro">Filtrar por status:</label>
    <select name="filtro" onchange="this.form.submit()">
        <option value="">Mostrar Todos</option>
        <option value="Em Aberto" <?= isset($_POST["filtro"]) && $_POST["filtro"] == "Em Aberto" ? "selected" : "" ?>>Em Aberto</option>
        <option value="Em Andamento" <?= isset($_POST["filtro"]) && $_POST["filtro"] == "Em Andamento" ? "selected" : "" ?>>Em Andamento</option>
        <option value="Completo" <?= isset($_POST["filtro"]) && $_POST["filtro"] == "Completo" ? "selected" : "" ?>>Completo</option>
    </select>
</form>

<!-- Tabela com os chamados existentes -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Prioridade</th> <!-- Linha corrigida -->
            <th>Assunto</th> <!-- Adicionando coluna "Assunto" -->
            <th>Mensagem</th> <!-- Adicionando coluna "Mensagem" -->
            <th>Status</th> <!-- Linha corrigida -->
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop para exibir os chamados na tabela
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["prioridade"] . "</td>"; // Exibindo a coluna "prioridade"
            echo "<td>" . $row["assunto"] . "</td>"; // Exibindo a coluna "prioridade"
            echo "<td>" . $row["mensagem"] . "</td>"; // Exibindo a coluna "status"
            echo "<td>" . $row["status"] . "</td>"; // Exibindo a coluna "status"
            echo "<td>";
            echo "<form method='post' style='display:inline-block;'>"; // Adicionando form para cada linha
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
            echo "<select name='status' onchange='this.form.submit()'>";
            echo "<option value='Em Aberto' " . ($row["status"] == "Em Aberto" ? "selected" : "") . ">Em Aberto</option>";
            echo "<option value='Em Andamento' " . ($row["status"] == "Em Andamento" ? "selected" : "") . ">Em Andamento</option>";
            echo "<option value='Completo' " . ($row["status"] == "Completo" ? "selected" : "") . ">Completo</option>";
            echo "</select>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>

