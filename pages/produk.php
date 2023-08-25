<?php $activePage = 'produk'; ?>
<?php include 'header.php' ?>
<?php include '../controller/func.php' ?>

<?php 
/**
 * Retrieves the product data along with its gallery.
 *
 * @return array An array containing the product data along with its gallery.
 */
$produkData = getProdukWithGallery(); ?>
<div class="container mt-5">
    <div class="d-flex align-content-start d-flex justify-content-between flex-wrap">
        <!-- /**
         * This code block loops through the $produkData array and checks if the current $produk['id_class'] is different from the previous one.
         * If it is different, it assigns the current $produk['id_class'] to $prevIdClass variable.
         * This is useful for grouping the products by class in the HTML output.
         */ -->
        <?php $prevIdClass = null; ?>
        <?php foreach ($produkData as $produk) : ?>
            <?php if ($prevIdClass !== $produk['id_class']) : ?>
                <?php $prevIdClass = $produk['id_class']; ?>

                <div class="card m-2" style="width: 300px; height: 310px;">
                    <div id="myCarousel-<?php echo $produk['id_class']; ?>" class="carousel slide" data-ride="carousel" style="width: 300px; height: 200px;">

                        <div class="carousel-inner">
                            <?php $firstImage = true; ?>
                            <?php foreach ($produkData as $item) : ?>
                                <?php if ($item['id_class'] == $produk['id_class']) : ?>
                                    <div class="carousel-item <?php if ($firstImage && $item['type'] == 'image') echo 'active'; ?>">
                                        <?php if ($item['type'] == 'image') : ?>
                                            <img width="300" height="200" src="<?php echo $item['file']; ?>" alt="<?php echo $item['name']; ?>">
                                            <?php $firstImage = false; ?>
                                        <?php elseif ($item['type'] == 'video') : ?>
                                            <iframe width="300" height="200" src="<?php echo $item['file']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>


                        <a class="carousel-control-prev" href="#myCarousel-<?php echo $produk['id_class']; ?>" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel-<?php echo $produk['id_class']; ?>" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                    <div class="ml-2">
                        <h1><?php echo ucfirst($produk['name']); ?></h1>
                        <h3>Rp. <?php echo number_format($produk['price'], 0, ',', '.'); ?></h3>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php include 'footer.php' ?>