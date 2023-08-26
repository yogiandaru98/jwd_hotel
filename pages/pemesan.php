<?php $activePage = 'pemesan'; ?>
<?php include 'header.php' ?>
<?php include '../controller/func.php' ?>
<?php $order = getAllOrderWithClass(); ?>

<div class="container mt-5">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>No.Identitas</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Pesanan</th>
              
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($order as $item) : ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo ucfirst($item['name']); ?></td>
                    <td><?php echo $item['num_identity']; ?></td>
                    <td><?php echo $item['gender']; ?></td>
                    <td><?php echo date_format(date_create($item['order_date']), 'd/m/Y'); ?></td>
                   
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailModal<?php echo $no; ?>">
                            Detail
                        </button>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php $no2 = 1; ?>
    <?php foreach ($order as $item) : ?>
        <div class="modal fade" id="detailModal<?php echo $no2; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Detail Pemesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi dengan informasi detail pemesanan -->
                        Nama: <?php echo ucfirst($item['name']); ?><br>
                        No. Identitas: <?php echo $item['num_identity']; ?><br>
                        Jenis Kelamin: <?php echo $item['gender']; ?><br>
                        Tanggal Pesanan: <?php echo date_format(date_create($item['order_date']), 'd/m/Y'); ?><br>
                        Durasi: <?php echo $item['duration']; ?> Hari<br>
                        Tipe Kamar: <?php echo $item['class_name']; ?><br>
                        Sarapan: <?php echo $item['breakfast']; ?><br>
                        Discount: <?php echo ($item['discount'] * 100) . '%'; ?><br>
                        Harga/Malam: Rp. <?php echo number_format($item['class_price'], 0, ',', '.'); ?><br>
                        Total Harga: Rp. <?php echo number_format($item['total_price'], 0, ',', '.'); ?><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $no2++; ?>
    <?php endforeach; ?>

</div>
<?php include 'footer.php' ?>
