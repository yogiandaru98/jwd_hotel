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


function getProdukWithGallery(){
    global $conection;
    $query = "SELECT class.*, rooms_gallery.* FROM class INNER JOIN rooms_gallery ON class.id = rooms_gallery.id_class";
    $result = mysqli_query($conection, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    // return var_dump($data);
    return $data;
}


?>