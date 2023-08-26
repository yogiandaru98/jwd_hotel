<!DOCTYPE html>
<html>
<head>
    <title>Hotel XYZ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="produk.php">Hotel JWD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if ($activePage == 'produk') echo 'active'; ?>" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($activePage == 'harga') echo 'active'; ?>" href="price_list.php">Daftar Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($activePage == 'tentang') echo 'active'; ?>" href="about.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($activePage == 'pesan') echo 'active'; ?>" href="order.php">Pesan Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($activePage == 'pemesan') echo 'active'; ?>" href="pemesan.php">Pemesan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
