<?php
// menghubungkan ke file konfigurasi database
include("config.php");
// memulai sesi untuk menyimpan notifikasi
session_start();
// proses penambahan kategori baru
if (isset($_POST['simpan'])) {
    // mengambil data nama kategori dari form
    $category_name = $_POST['category_name'];
    
    // query untuk menambahkan data kategori ke dalam database
    $query = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    $exec = mysqli_query($conn, $query);

    // menyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec) {
        $_SESSION['notification'] = ['type' => 'Kategori berhasil di tambahkan!'];
    } else {
        $_SESSION['notification'] = ['type' => 'danger', 'message' => 'Gagal menambahkan ketegori: ' . mysqli_error($conn) ];
    }

    // redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
}