<?php $activePage = 'harga'; ?>
<?php include 'header.php' ?>
<?php include '../controller/func.php' ?>
<?php $produk = getProduk() ?>

<div class="container mt-5">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Tipe</th>
            <th>Harga</th>
        </tr>
        <?php foreach ($produk as $item) : ?>
            <tr>
                <td><?php echo ucfirst($item['name']); ?></td>
                <td>Rp. <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
</div>
<?php include 'footer.php' ?>