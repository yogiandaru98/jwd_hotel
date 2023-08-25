<?php 
include '../controller/func.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $num_identity = $_POST["num_identity"];
    $id_class = $_POST["id_class"];
    $order_date = $_POST["order_date"];
    $duration = $_POST["duration"];
    $breakfast = $_POST["breakfast"];
    $discount = $duration >=3 ? 0.1 : 0;
    $total_price = totalPrice($id_class, $duration, $breakfast);

    $error = array();
    //nama tidak boleh kosong atau mengandung angka diantara huruf
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $error['name'] = "Nama tidak boleh kosong atau mengandung angka diantara huruf";
    }
    //nomor identitas harus 16 digit
    if (!preg_match("/^[0-9]{16}$/",$num_identity)) {
        $error['num_identity'] = "Nomor identitas harus 16 digit";
    }
    // tanggal pesan tidak boleh kosong
    if (empty($order_date)) {
        $error['order_date'] = "Tanggal pesan tidak boleh kosong";
    }
    //durasi menginap tidak boleh kosong
    if (empty($duration)) {
        $error['duration'] = "Durasi menginap tidak boleh kosong";
    }
    //durasi menginap tidak boleh mengandung huruf
    if (!preg_match("/^[0-9]*$/",$duration)) {
        $error['duration'] = "Durasi menginap tidak boleh mengandung huruf";
    }
    //jenis kelamin tidak boleh kosong
    if (empty($gender)){
        $error['gender'] = "Jenis kelamin tidak boleh kosong";
    }
    //tipe kamar
    if (empty($id_class)){
        $error['id_class'] = "Tipe kamar tidak boleh kosong";
    }
    
    
    //tanggal pesan tidak boleh lebih dari tanggal hari ini
    if ($order_date > date("Y-m-d")) {
        $error['order_date'] = "Tanggal pesan tidak boleh lebih dari tanggal hari ini";
    }
    //durasi menginap tidak boleh 0 atau kurang dari 0
    if ($duration <= 0) {
        $error['duration'] = "Durasi menginap tidak boleh 0 atau kurang dari 0";
    }
    //jika tidak ada error
    if (count($error) == 0) {
        $result = insertOrder($id_class, $name, $gender, $num_identity, $order_date, $duration, $breakfast, $total_price, $discount);
        if ($result) {
            header("Location: ../pages/order.php?status=success");
        } else {
            header("Location: ../pages/order.php?status=failed");
        }
    } else {
        header("Location: ../pages/order.php?status=failed");
    }
}




?>