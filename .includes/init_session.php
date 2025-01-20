<?php
session_start();

$name = $_SESSION["name"];
$role = $_SESSION["role"];
// Ambil notifikasi jika ada, kemudian hapus dari sesi
$notifikasi = $_SESSION['notifikasi'] ?? null;
if ($notifikasi) {
    unset($_SESSION['notifikasi']);
}