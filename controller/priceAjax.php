<?php 
include '../controller/func.php';

// Sesuaikan dengan logika perolehan harga berdasarkan tipe kamar
/**
 * This script is responsible for handling AJAX requests related to hotel room prices.
 * It checks if the request method is POST and if the "id_class" parameter is set in the request.
 * If both conditions are met, it retrieves the price based on the class ID using the "getHargaBasedOnClass" function and returns it as a response.
 * 
 * @param int $_POST["id_class"] The ID of the hotel room class.
 * @return int The price of the hotel room class.
 */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id_class"])) {
    $id_class = $_POST["id_class"];
    $harga = getHargaBasedOnClass($id_class); // Fungsi untuk mengambil harga dari database
    echo $harga;
}





?>