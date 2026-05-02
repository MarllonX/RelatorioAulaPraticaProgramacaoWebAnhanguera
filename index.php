<!-- index.php — Página de formulário para consulta de signo zodiacal -->
<!doctype html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consulta de Signo</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<main class="page page-form">
		<section class="card">
			<h1>Descubra seu signo</h1>
			<p class="subtitle">Informe sua data de nascimento para consultar seu signo zodiacal.</p>

			<form action="resultado.php" method="post" class="form-signo">
				<label for="data_nascimento">Data de nascimento</label>
				<input type="date" id="data_nascimento" name="data_nascimento" required>

				<button type="submit">Consultar signo</button>
			</form>
		</section>
	</main>
</body>
</html>