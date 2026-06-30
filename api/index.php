<?php

/**
 * Vercel PHP Runtime Entry Point untuk Laravel
 *
 * File ini adalah "pintu masuk" yang digunakan Vercel untuk menjalankan
 * Laravel sebagai serverless function. Semua HTTP request akan masuk
 * ke sini dan diteruskan ke Laravel.
 */

// Pindah ke root project (satu level di atas folder api/)
chdir(dirname(__DIR__));

// Set document root ke folder public/ milik Laravel
$_SERVER['DOCUMENT_ROOT'] = dirname(__DIR__) . '/public';

// Teruskan ke index.php Laravel yang asli
require dirname(__DIR__) . '/public/index.php';
