<?php
session_start();

$name = $_session["name"];
$role = $_session["role"];
// ambil notifikasi jika ada,kemudian hapus dari sesi
$notification =$_session['notification'] ?? null;
if ($notification) {
    unset($_session['notification']);
}