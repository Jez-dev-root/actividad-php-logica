<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/functions.php';

// Manejo de envío del formulario
$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar entrada
    $n = isset($_POST['n']) ? (int)$_POST['n'] : 0;

    if ($n < 0) {
        $error = 'Por favor, ingresa un número entero >= 0.';
    } else {
        $resultado = generarFibonacci($n);
    }
}

// Helper para proteger salidas HTML
function h(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Fibonacci | Actividad PHP - Lógica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="./assets/css/styles.css" rel="stylesheet" />
</head>
<body>
  <main class="container">
    <header class="header">
      <h1>Serie Fibonacci</h1>
      <a class="back" href="./index.html">← Volver</a>
    </header>

    <form method="post" class="card form">
      <label for="n">Cantidad de términos (n):</label>
      <input type="number" id="n" name="n" min="0" step="1" required value="<?= isset($_POST['n']) ? h((string)$_POST['n']) : '7' ?>"/>
      <button type="submit">Generar</button>
    </form>

    <?php if ($error): ?>
      <div class="alert error"><?= h($error) ?></div>
    <?php elseif (is_array($resultado)): ?>
      <div class="card result">
        <h2>Resultado</h2>
        <p><strong>Fibonacci(<?= h((string)($_POST['n'] ?? '')) ?>)</strong></p>
        <pre class="code">[<?= h(implode(', ', $resultado)) ?>]</pre>
      </div>
    <?php endif; ?>

    <section class="card">
      <h2>Lógica utilizada</h2>
      <ul>
        <li><strong>Estructuras de control:</strong> if (validación), for (bucle).</li>
        <li><strong>Lógica:</strong> término <code>i</code> = suma de los dos anteriores.</li>
      </ul>
    </section>
  </main>
</body>
</html>
