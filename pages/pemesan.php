<?php $activePage = 'pemesan'; ?>
<?php include 'header.php' ?>
<?php include '../controller/func.php' ?>
<?php $order = getAllOrderWithClass(); ?>

<div class="container mt-5">
    <table class="table table-striped table-bordered table-responsive">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>No.Identitas</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Pesanan</th>
            <th>Durasi</th>
            <th>Tipe Kamar</th>
            <th>Sarapan</th>
            <th>discount</th>
            <th>Harga/Malam</th>
            <th>Total Harga</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($order as $item) : ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo ucfirst($item['name']); ?></td>
                <td><?php echo $item['num_identity']; ?></td>
                <td><?php echo $item['gender']; ?></td>
                <td><?php echo $item['order_date']; ?></td>
                <td><?php echo $item['duration']; ?> Hari</td>
                <td><?php echo $item['class_name']; ?></td>
                <td><?php echo $item['breakfast']; ?></td>
                <td><?php echo $item['discount']; ?></td>
                <td><?php echo $item['class_price']; ?></td>
                <td>Rp. <?php echo number_format($item['total_price'], 0, ',', '.'); ?></td>
            </tr>
            <?php $no++; ?>
        <?php endforeach; ?>
    </table>

</div>
<?php include 'footer.php' ?>