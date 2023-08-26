
<?php 

/**
 * FILEPATH: c:\laragon\www\jwd_hotel\controller\create_order.php
 * This file contains the code for creating a new order in the hotel booking system.
 * It receives data from a form submission via POST method and validates the input data.
 * If there are no errors, it inserts the order into the database and redirects to the order page with a success message.
 * If there are errors, it redirects to the order page with a failed message.
 *
 * @param string $name The name of the customer.
 * @param string $gender The gender of the customer.
 * @param string $num_identity The identity number of the customer.
 * @param int $id_class The ID of the room class.
 * @param string $order_date The date of the order.
 * @param int $duration The duration of the stay.
 * @param enum $breakfast Whether the customer wants breakfast or not.
 * @param float $discount The discount applied to the total price.
 * @param array $error An array containing error messages for invalid input data.
 * @param float $total_price The total price of the order.
 * @param bool $result The result of the insert query.
 * @return void
    */
include '../controller/func.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $num_identity = $_POST["num_identity"];
    $id_class = $_POST["id_class"];
    $order_date = $_POST["order_date"];
    $duration = $_POST["duration"];
    $breakfast = $_POST["breakfast"]??'Tidak';
    $discount = $duration >=3 ? 0.1 : 0;
    $total_price = totalPrice($id_class, $duration, $breakfast);


    $error = array();
    //nama tidak boleh kosong atau mengandung angka diantara huruf
    if (empty($name)) {
        $error[] = "Nama tidak boleh kosong";
    } elseif (preg_match("/[0-9]/", $name)) {
        $error[] = "Nama tidak boleh mengandung angka";
    }
    if(empty($gender)){
        $error[] = "Jenis kelamin tidak boleh kosong";
    }elseif(!in_array($gender, ['pria', 'wanita'])){
        $error[] = "Jenis kelamin tidak valid";
    }
    if(empty($num_identity)){
        $error[] = "Nomor identitas tidak boleh kosong";
    }//16 digit
    elseif(strlen($num_identity) != 16){
        $error[] = "Nomor identitas harus 16 digit";
    }
    if(empty($id_class)){
        $error[] = "Tipe kamar tidak boleh kosong";
    }
    elseif(preg_match("/[a-zA-Z]/", $id_class)){
        $error[] = "Tipe kamar tidak valid";
    }
    if(empty($order_date)){
        $error[] = "Tanggal pesan tidak boleh kosong";
    } //format tanggal
    elseif(!preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $order_date)){
        $error[] = "Format tanggal pesan tidak valid";
    }

    if(empty($duration)){
        $error[] = "Durasi tidak boleh kosong";
    } //durasi minimal 1 hari
    elseif($duration < 1){
        $error[] = "Durasi minimal 1 hari";
    }
    if(empty($breakfast)){
        $error[] = "Sarapan tidak boleh kosong";
    } //sarapan hanya boleh ya atau tidak
    elseif(!in_array($breakfast, ['Ya', 'Tidak'])){
        $error[] = "Sarapan tidak valid";
    }
    //jika tidak ada error
    if (count($error) > 0) {
        // Encode the error messages as a URL parameter
        $errorMessages = implode(',', $error);
        header("Location: ../pages/order.php?status=failed&errors=$errorMessages");
        exit(); // Terminate the script after redirection
    }
    
    // If there are no errors
    $result = insertOrder($id_class, $name, $gender, $num_identity, $order_date, $duration, $total_price, $breakfast, $discount);
    if ($result) {
        header("Location: ../pages/order.php?status=success");
    } else {
        header("Location: ../pages/order.php?status=failed");
    }
}

?>