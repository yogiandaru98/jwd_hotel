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

/**
 * Inserts a new order into the database.
 *
 * @param int $id_class The ID of the room class.
 * @param string $name The name of the customer.
 * @param string $gender The gender of the customer.
 * @param string $num_identity The identity number of the customer.
 * @param string $order_date The date of the order.
 * @param int $duration The duration of the stay.
 * @param string $breakfast The breakfast option. Default is "Tidak".
 * @param float $total_price The total price of the order.
 * @param float $discount The discount amount. Default is 0.
 * @return bool Returns true on success, false on failure.
 */
function insertOrder(
    $id_class,
    $name,
    $gender,
    $num_identity,
    $order_date,
    $duration,
    $total_price, // Parameter required
    $breakfast = "Tidak", // Parameter opsional
    $discount = 0 // Parameter opsional
) {
    global $conection;
    $classExist = id_classExist($id_class);
    if (!$classExist) {
        return false;
    }

    $query = "INSERT INTO `order` (`id_class`, `name`, `gender`, `num_identity`, `order_date`, `duration`, `breakfast`, `total_price`, `discount`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conection, $query);
    mysqli_stmt_bind_param($stmt, "issssisdd", $id_class, $name, $gender, $num_identity, $order_date, $duration, $breakfast, $total_price, $discount);
    
    $result = mysqli_stmt_execute($stmt);
    if (!$result) {
        echo "Error: " . mysqli_error($conection); // Print the error message for debugging
    }

    return $result;
}



/**
 * Checks if a class with the given ID exists in the database.
 *
 * @param int $id_class The ID of the class to check.
 * @return mixed Returns an associative array containing the class information if it exists, or false otherwise.
 */
function id_classExist($id_class){
    global $conection;
    $query = "SELECT * FROM class WHERE id = '$id_class'";
    $result = mysqli_query($conection, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return false;
    }
}

/**
 * Returns the price of a hotel room based on its class ID.
 *
 * @param int $id_class The ID of the hotel room class.
 * @return mixed Returns the price of the hotel room if successful, otherwise returns "Error".
 */
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



/**
 * Calculates the total price of a hotel room based on its class, duration of stay, and breakfast option.
 *
 * @param int $id_class The ID of the hotel room class.
 * @param int $duration The duration of stay in days.
 * @param string $breakfast The breakfast option, either "Ya" or "Tidak". Defaults to "Tidak".
 * @return float The total price of the hotel room.
 */
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

/**
 * Retrieves all orders with their corresponding class information.
 *
 * @return array An array of orders with their corresponding class information.
 */
function getAllOrderWithClass(){
    global $conection;
    $sql = "SELECT `order`.*, class.name as class_name, class.price as class_price
    FROM `order`
    INNER JOIN class ON `order`.id_class = class.id";
    $result = mysqli_query($conection, $sql);
    $rows = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}






?>