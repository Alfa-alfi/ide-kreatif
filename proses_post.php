<?php
// menghubungkan file konfigurasi database
include 'config.php';

// memulai sesi php
session_start();

// mendapatkan ID pengguna dari sesi();
$userId = $_SESSION["user_id"];

// menangani form untuk menambahkan potingan baru
if (isset($_POST['simpan'])) {
    // mendapatkan data dari form
    $postTittle = $_POST["post_title"]; // judul postingan
    $content = $_POST["content"]; // konten postingan
    $categoryId = $_POST["category_id"]; // ID kategori

    // mengatur direktori penyimpanan file gaambar
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES["image"]["name"]; // nama file gambar
    $imagePath = $imageDir . basename($imageName); // path lengkap gambar

    // memindahkan file gambar yang diunggah ke derektori tujuan
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        // jika unggahan berhasil, masukkan 
        // data postingan ke dalam database
        $query = "INSERT INTO posts (posts_title, content,
        created_at, category_id, user_id, image_path) VALUES
        ('$postTittle', '$content', NOW(), $categoryId, $userId, '$imagePath')";

        if ($conn->query($query) === TRUE) {
            // notifikasi berhasil jika postinngan berhasil ditambahkan
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post successfully added.'
            ];
        } else {
            // notifikasi error jika gagal menambahkan postingan
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
    } else {
        // notifikasi  error jika unggahan gambar gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload image.'
        ];
    }
    
    // arahkan ke halaman dashboard setelah selesai
    header('Location: dashboard.php');
    exit();
}

// proses penghapusan postingan
if (isset($_POST['delete'])) {
    // mengambil ID post dari paramenter URL
    $postID =$_POST['postID'];

    // query untuk menghapus post berdasarkan ID
    $exec = mysqli_query($conn, "DELETE FROM posts WHERE id_post='$postID'");

    // menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Post successfully deleted.'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger', 
            'message' => 'Error deleting post: ' . mysqli_query($conn)
        ];
    }

    // redirect kembali ke halaman dashboard
    header('Location: dashboard.php');
    exit();
}

// menangani pembaruan data postingan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // mendapatkan data dari form
}