<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/functions.php';

$respuesta = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = isset($_POST['num']) ? (int)$_POST['num'] : 0;
    $respuesta = esPrimo($num);
}

function h(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Número Primo | Actividad PHP - Lógica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="./assets/css/styles.css" rel="stylesheet" />
</head>
<body>
  <main class="container">
    <header class="header">
      <h1>Verificar número primo</h1>
      <a class="back" href="./index.html">← Volver</a>
    </header>

    <form method="post" class="card form">
      <label for="num">Número entero:</label>
      <input type="number" id="num" name="num" step="1" required value="<?= isset($_POST['num']) ? h((string)$_POST['num']) : '29' ?>"/>
      <button type="submit">Verificar</button>
    </form>

    <?php if ($respuesta !== null): ?>
      <div class="card result">
        <h2>Resultado</h2>
        <p>El número <strong><?= h((string)$_POST['num']) ?></strong>
          <?= $respuesta ? ' <span class="ok">SÍ</span> es primo.' : ' <span class="bad">NO</span> es primo.' ?>
        </p>
      </div>
    <?php endif; ?>

    <section class="card">
      <h2>Lógica utilizada</h2>
      <ul>
        <li><strong>Estructuras de control:</strong> if/else y for hasta <code>sqrt(n)</code>.</li>
        <li><strong>Lógica:</strong> descartar pares y dividir solo por impares.</li>
      </ul>
    </section>
  </main>
</body>
</html>
