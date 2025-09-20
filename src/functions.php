<?php
declare(strict_types=1);

/**
 * Funciones de lógica para la actividad.
 * - generarFibonacci(int $n): array<int>
 * - esPrimo(int $num): bool
 * - esPalindromo(string $texto): bool
 */

function generarFibonacci(int $n): array {
    // Validación: n <= 0 no genera términos
    if ($n <= 0) return [];

    // Caso base: n == 1 → [0]
    if ($n === 1) return [0];

    // Inicial: 0, 1
    $serie = [0, 1];

    // Bucle for: cada término = suma de los dos anteriores
    for ($i = 2; $i < $n; $i++) {
        $serie[] = $serie[$i - 1] + $serie[$i - 2];
    }
    return $serie;
}

function esPrimo(int $num): bool {
    // 0, 1 y negativos no son primos
    if ($num <= 1) return false;

    // 2 es primo
    if ($num === 2) return true;

    // Pares > 2 no son primos
    if ($num % 2 === 0) return false;

    // Verificar solo impares hasta sqrt(num)
    $lim = (int)floor(sqrt($num));
    for ($i = 3; $i <= $lim; $i += 2) {
        if ($num % $i === 0) return false;
    }
    return true;
}

function esPalindromo(string $texto): bool {
    // Normalizar minúsculas (multibyte si está disponible)
    $texto = function_exists('mb_strtolower') ? mb_strtolower($texto, 'UTF-8') : strtolower($texto);

    // Reemplazar acentos comunes para comparación más justa
    $busca  = ['á','é','í','ó','ú','ü','ñ','Á','É','Í','Ó','Ú','Ü','Ñ'];
    $reempl = ['a','e','i','o','u','u','n','a','e','i','o','u','u','n'];
    $texto = str_replace($busca, $reempl, $texto);

    // Quitar todo lo que no sea alfanumérico (mantener Unicode)
    $solo = preg_replace('/[^[:alnum:]]/u', '', $texto);
    if ($solo === null) $solo = $texto; // fallback si preg falla

    // Invertir (soporte básico para Unicode)
    $invertido = invertirUnicode($solo);

    return $solo === $invertido;
}

function invertirUnicode(string $s): string {
    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        $len = mb_strlen($s, 'UTF-8');
        $rev = '';
        for ($i = $len - 1; $i >= 0; $i--) {
            $rev .= mb_substr($s, $i, 1, 'UTF-8');
        }
        return $rev;
    }
    return strrev($s);
}
