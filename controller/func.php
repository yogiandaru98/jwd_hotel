<?php 
/**
 * Establishes a connection to the MySQL database server using the mysqli extension.
 *
 * @param string $host The hostname or IP address of the MySQL server.
 * @param string $username The MySQL user name.
 * @param string $password The MySQL password.
 * @param string $database The name of the MySQL database to use.
 * @return mysqli|false Returns a mysqli object on success, or false on failure.
 */
$conection = mysqli_connect("localhost","root","","hotel_jwd");


/**
 * Retrieves all products with their respective gallery images.
 *
 * @global $conection
 * @return array An array of products with their respective gallery images.
 */
function getProdukWithGallery(){
    global $conection;
    $query = "SELECT class.*, rooms_gallery.* FROM class INNER JOIN rooms_gallery ON class.id = rooms_gallery.id_class";
    $result = mysqli_query($conection, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}

/**
 * Retrieves all data from the 'class' table in the database.
 *
 * @return array An array containing all the data from the 'class' table.
 */
function getProduk(){
    global $conection;
    $query = "SELECT * FROM class";
    $result = mysqli_query($conection, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}

function insertOrder(
    $id_class,
    $name,
    $gender,
    $num_identity,
    $order_date,
    $duration,
    $breakfast = "Tidak",
    $total_price,
    $discount = 0
    ){
    global $conection;
    $query = "INSERT INTO orders VALUES (NULL, '$id_class', '$name', '$gender', '$num_identity', '$order_date', '$duration', '$breakfast', '$total_price', '$discount')";
    $result = mysqli_query($conection, $query);
    return $result;

}

function getHargaBasedOnClass($id_class) {
    global $conection; 

    $query = "SELECT price FROM class WHERE id = '$id_class'";
    $result = mysqli_query($conection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['price'];
    } else {
        return "Error"; 
    }
}



function totalPrice(
    $id_class,
    $duration,
    $breakfast = "Tidak"
)
{
    try {
        $harga=getHargaBasedOnClass($id_class);
        if ($harga && $duration) {
            $breakfastPrice = 80000;
            $discount = $duration >= 3 ? 0.1 : 0;
            $breakfastTotal = $breakfast== "Ya" ? $breakfastPrice * $duration : 0 ;
            $roomTotal = $harga * $duration * (1- $discount);
            $totalPrice = $breakfastTotal + $roomTotal;

            return $totalPrice;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}



?>