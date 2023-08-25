<?php 
include '../controller/func.php';

// Sesuaikan dengan logika perolehan harga berdasarkan tipe kamar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_class"])) {
    $id_class = $_POST["id_class"];
    $harga = getHargaBasedOnClass($id_class); // Fungsi untuk mengambil harga dari database
    echo $harga;
}





?>