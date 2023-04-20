<!DOCTYPE html>
<html>
<head>
    <title>Painel de Chamados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #33a532;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            margin-top: 5px;
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Painel de Chamados</h1>
    <?php
    session_start(); // Inicia a sessão (caso ainda não esteja iniciada)
// Verifica se o usuário está autenticado. Caso não esteja, redireciona para a página de login.
if (!isset($_SESSION['email'])) {
    header('Location: login_users.php');
    exit();
}

// Conecta-se ao banco de dados
$db = new mysqli('localhost', 'root', '', 'suporte');
if ($db->connect_error) {
    die('Erro ao conectar ao banco de dados: ' . $db->connect_error);
}

// Obtém o e-mail do usuário a partir da sessão
$email = $_SESSION['email'];

// Consulta os chamados relacionados ao e-mail do usuário na tabela 'chamados_ti'
$query = "SELECT * FROM chamados_ti WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result_ti = $stmt->get_result();

// Consulta os chamados relacionados ao e-mail do usuário na tabela 'chamados'
$query = "SELECT * FROM chamados WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Exibe os chamados relacionados ao usuário da tabela 'chamados_ti'
while ($row = $result_ti->fetch_assoc()) {
    echo '<h2>ID do Chamado (TI): ' . $row['id'] . '</h2>';
    echo '<p><strong>Assunto:</strong> ' . $row['assunto'] . '</p>';
    echo '<p><strong>Mensagem:</strong> ' . $row['mensagem'] . '</p>';
    echo '<p><strong>Status:</strong> ' . $row['status'] . '</p>'; // Exibe o status do chamado
    // Exibe outros campos relevantes do chamado
    echo '<hr>';
}

// Exibe os chamados relacionados ao usuário da tabela 'chamados'
while ($row = $result->fetch_assoc()) {
    echo '<h2>ID do Chamado (Manutenção): ' . $row['id'] . '</h2>';
    echo '<p><strong>Assunto:</strong> ' . $row['assunto'] . '</p>';
    echo '<p><strong>Mensagem:</strong> ' . $row['mensagem'] . '</p>';
    echo '<p><strong>Status:</strong> ' . $row['status'] . '</p>'; // Exibe o status do chamado
    // Exibe outros campos relevantes do chamado
    echo '<hr>';
}

$stmt->close();
$db->close();
?>
</body>
</html>
