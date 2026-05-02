<?php
// resultado.php — Lê a data do POST, consulta o XML e exibe o signo correspondente
$signoEncontrado = null;
$erro            = null;
$dataInformada = $_POST['data_nascimento'] ?? '';

if ($dataInformada === '') {
    $erro = 'Informe uma data de nascimento para consultar o signo.';
} else {
    $timestamp = strtotime($dataInformada);

    if ($timestamp === false) {
        $erro = 'A data informada é inválida.';
    } else {
        $diaMesNascimento = (int) date('md', $timestamp);

        if (!file_exists('data.xml')) {
            $erro = 'Arquivo de signos não encontrado.';
        } else {
            $xml = simplexml_load_file('data.xml');

            if ($xml === false) {
                $erro = 'Não foi possível ler o arquivo de signos.';
            } else {
                foreach ($xml->signo as $signo) {
                    $inicio = (int) str_replace('-', '', (string) $signo->inicio);
                    $fim    = (int) str_replace('-', '', (string) $signo->fim);

                    if ($inicio <= $fim) {
                        $estaNoIntervalo = $diaMesNascimento >= $inicio && $diaMesNascimento <= $fim;
                    } else {
                        $estaNoIntervalo = $diaMesNascimento >= $inicio || $diaMesNascimento <= $fim;
                    }

                    if ($estaNoIntervalo) {
                        $signoEncontrado = [
                            'nome'      => (string) $signo->nome,
                            'descricao' => (string) $signo->descricao,
                        ];
                        break;
                    }
                }

                if ($signoEncontrado === null && $erro === null) {
                    $erro = 'Não foi possível identificar o signo para a data informada.';
                }
            }
        }
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado da Consulta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="page page-result">
        <section class="card">
            <h1>Resultado da consulta</h1>

            <?php if ($erro !== null): ?>
                <p class="message error"><?php echo htmlspecialchars($erro, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php else: ?>
                <p class="message ok">Data informada: <?php echo htmlspecialchars(date('d/m/Y', strtotime($dataInformada)), ENT_QUOTES, 'UTF-8'); ?></p>
                <h2><?php echo htmlspecialchars($signoEncontrado['nome'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="description"><?php echo htmlspecialchars($signoEncontrado['descricao'], ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <a class="back-link" href="index.php">Nova consulta</a>
        </section>
    </main>
</body>
</html>
