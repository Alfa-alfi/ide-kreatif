<?php
session_start();

$name = $_session["name"];
$role = $_session["role"];
// ambil notifikasi jika ada,kemudian hapus dari sesi
$notification =$_SESSION['notification'] ?? null;
if ($notification) {
    unset($_SESSION['notification']);
}