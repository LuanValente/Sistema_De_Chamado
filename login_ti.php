<?php
  // Verifica se o formulário foi submetido
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os valores inseridos no formulário
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifica se as credenciais são válidas
    if ($email === 'ti@comalcomercio.com.br' && $password === 'ti123') {
      // Redireciona para a página de painel
      header('Location: painel_ti.php');
      exit;
    } else {
      // Exibe uma mensagem de erro
      $erro = 'Credenciais inválidas. Tente novamente.';
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Conectar Como Administrador Para Ter Acesso ao Painel De Chamados</title>
  </head>
  <h1>Conectar Como Administrador Para Ter Acesso ao Painel De Chamados(Manutençao)</h1>
  <body>
    <?php if (isset($erro)) { ?>
      <div style="color: red;"><?php echo $erro; ?></div>
    <?php } ?>
    <form method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <br>
      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>
      <br>
      <button type="submit">Login</button>
    </form>
  </body>
</html>