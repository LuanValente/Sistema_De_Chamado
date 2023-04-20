<?php
session_start();

// Verifica se a sessão está ativa, ou seja, se o usuário fez login
if (!isset($_SESSION["email"])) {
    // Se a sessão não estiver ativa, redireciona para index.php (tela de login)
    header("Location: login_users.php");
    exit();
}

// Exibe a página de boas-vindas com o email do usuário
$email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style1.css">
	<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style1.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			color: #333;
			margin: 0;
			padding: 20px;
			position: relative; /* Adiciona posição relativa para posicionar os botões de login e sair */
		}

		h1 {
			color: #333;
			margin-bottom: 20px;
		}

		p {
			margin-top: 5px;
			margin-bottom: 10px;
		}

		.botao {
			display: inline-block;
			background-color: #28a745; /* Cor de fundo verde */
			color: #fff;
			padding: 10px 20px;
			margin-right: 10px;
			margin-bottom: 10px;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.3s ease;
		}

		.botao:hover {
			background-color: #218838; /* Cor de fundo verde mais escura no hover */
		}

		/* Posiciona os botões de login e sair no canto superior direito */
		.login-btn {
			position: absolute;
			top: 20px;
			right: 20px;
		}

		a {
			color: #333;
			text-decoration: none;
			margin-right: 10px;
		}

		a:hover {
			text-decoration: underline;
		}
		
		/* Estilização do filtro de chamados */
		#filtro-chamados {
			margin-bottom: 20px;
		}
	</style>
	<title>Sistema de Chamados Comal - Home</title>
</head>
<body>
	<h1>Bem-vindo ao Sistema de Chamados Comal <?php echo $email; ?>!</h1>
	<p>Clique no botão abaixo para abrir um novo chamado:</p>
	<a href="chamados_leo.php" class="botao abrir-manutencao" style="display:none">Abrir Chamado (Manutenção)</a>
	<a href="chamados_ti.php" class="botao abrir-ti" style="display:none">Abrir Chamado (TI)</a>
	<a href="login_leo.php" class="botao">Visualizar Chamados (ADM/Manutenção)</a>
	<a href="login_ti.php" class="botao">Visualizar Chamados (ADM/TI)</a>
	<a href="user_chamados.php" class="botao">Ver Meus Chamados</a>
	<!-- Move o botão de login para o canto superior direito -->
	<!-- Move o botão de sair para o canto superior direito -->
	<a href="logout.php" class="botao login-btn">Sair</a>
  <!-- Filtro de chamados -->
<!-- Filtro de chamados -->
<select id="filtro-chamados" onchange="filtrarChamados()">
  <option value="todos">Todos os Chamados</option>
  <option value="ti">Abrir Chamado TI</option>
  <option value="manutencao">Abrir Chamado Manutenção</option>
</select>

<script>
function filtrarChamados() {
  var filtro = document.getElementById("filtro-chamados").value;

  // Lógica para mostrar/ocultar os botões de abrir chamados de acordo com o valor selecionado no filtro
  var btnAbrirManutencao = document.querySelector(".abrir-manutencao");
  var btnAbrirTI = document.querySelector(".abrir-ti");

  if (filtro === "manutencao") {
    btnAbrirManutencao.style.display = "block";
    btnAbrirTI.style.display = "none";
  } else if (filtro === "ti") {
    btnAbrirManutencao.style.display = "none";
    btnAbrirTI.style.display = "block";
  } else {
    btnAbrirManutencao.style.display = "none";
    btnAbrirTI.style.display = "none";
  }

  console.log("Filtro selecionado: " + filtro);
}
</script>
</body>
</html>