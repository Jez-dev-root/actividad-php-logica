<?php
declare(strict_types=1);
require_once __DIR__ . '/../src/functions.php';

$respuesta = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir texto crudo
    $texto = $_POST['texto'] ?? '';
    // Evaluar palíndromo
    $respuesta = esPalindromo($texto);
}

function h(?string $s): string {
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Palíndromo | Actividad PHP - Lógica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="./assets/css/styles.css" rel="stylesheet" />
</head>
<body>
  <main class="container">
    <header class="header">
      <h1>Verificar palíndromo</h1>
      <a class="back" href="./index.html">← Volver</a>
    </header>

    <form method="post" class="card form">
      <label for="texto">Texto:</label>
      <input type="text" id="texto" name="texto" required
             value="<?= isset($_POST['texto']) ? h($_POST['texto']) : '¿Acaso hubo búhos acá?' ?>" />
      <button type="submit">Verificar</button>
    </form>

    <?php if ($respuesta !== null): ?>
      <div class="card result">
        <h2>Resultado</h2>
        <p>El texto <strong>"<?= h((string)($_POST['texto'] ?? '')) ?>"</strong>
          <?= $respuesta ? ' <span class="ok">SÍ</span> es palíndromo.' : ' <span class="bad">NO</span> es palíndromo.' ?>
        </p>
      </div>
    <?php endif; ?>

    <section class="card">
      <h2>Lógica utilizada</h2>
      <ul>
        <li><strong>Estructuras de control:</strong> if, uso de funciones auxiliares.</li>
        <li><strong>Lógica:</strong> normalizar (minúsculas, quitar acentos y no alfanuméricos) y comparar con su inversa.</li>
      </ul>
    </section>
  </main>
</body>
</html>
