<?php $activePage = 'pesan'; ?>
<?php include 'header.php'; ?>
<?php include '../controller/func.php'; ?>
<?php $produk = getProduk(); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h1>Reservasi Kamar</h1>
            <?php if (isset($_GET["status"])) : ?>
                <?php if ($_GET["status"] === "success") : ?>
                    <div class="alert alert-success" role="alert">
                        Order berhasil! Terima kasih atas pesanannya.
                    </div>
                <?php elseif ($_GET["status"] === "failed") : ?>
                    <div class="alert alert-danger" role="alert">
                        Order gagal! Mohon periksa kembali data yang Anda masukkan.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form id="reservationForm" action="/controller/create_order.php" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Nama Pemesan</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <?php if (isset($error["name"])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error["name"]; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="pria" value="pria" required>
                        <label class="form-check-label" for="pria">Laki-laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="wanita" value="wanita" required>
                        <label class="form-check-label" for="wanita">Perempuan</label>
                    </div>
                    <?php if (isset($error["gender"])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error["gender"]; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="num_identity">Nomor Identitas (16 Digit)</label>
                    <input type="text" class="form-control" id="num_identity" name="num_identity" required>
                </div>
                <div class="form-group">
                    <label for="id_class">Tipe Kamar</label>
                    <select class="form-control" id="id_class" name="id_class" required>
                        <option value="new" selected disabled>Pilih tipe kamar</option>
                        <?php foreach ($produk as $item) : ?>
                            <option value="<?php echo $item['id']; ?>"><?php echo ucfirst($item['name']); ?></option>
                        <?php endforeach; ?>

                    </select>
                    <?php if (isset($error["id_class"])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error["id_class"]; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" readonly>
                </div>
                <div class="form-group">
                    <label for="order_date">Tanggal Pesan</label>
                    <input type="date" class="form-control" id="order_date" name="order_date" required>
                    <?php if (isset($error["order_date"])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error["order_date"]; ?>
                        </div>
                </div>
                <div class="form-group">
                    <label for="duration">Durasi Menginap</label>
                    <input type="number" class="form-control" id="duration" name="duration" min="1" value="1" required>
                    <?php if (isset($error["duration"])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error["duration"]; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="breakfast" name="breakfast" value="yes">
                        <label class="form-check-label" for="breakfast">Termasuk Breakfast</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="total_price">Total Bayar</label>
                    <input type="text" class="form-control" id="total_price" name="total_price" readonly>
                </div>
                <button type="button" class="btn btn-success" onclick="calculateTotal()">Hitung Total Bayar</button>
                <button type="submit" class="btn btn-primary">Pesan Kamar</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>

            </form>
        </div>
    </div>


</div>

<script>
    /**
     * This function validates the form data submitted by the user in the order page.
     * It checks if the name, gender, identity number, room type, order date, and duration of stay are valid.
     * If any of the data is invalid, it displays an alert message and returns false.
     * If all data is valid, it returns true.
     *
     * @return bool Returns true if all form data is valid, otherwise false.
     */
    function validateForm() {
        // Validasi nama pemesan
        const name = document.getElementById('name').value;
        if (!name || name.trim() === '' || !isNaN(name) || /\d/.test(name)) {
            alert('Silakan isi nama pemesan dengan benar.');
            return false;
        }

        // Validasi jenis kelamin
        const pria = document.getElementById('pria');
        const wanita = document.getElementById('wanita');
        if (!pria.checked && !wanita.checked) {
            alert('Silakan pilih jenis kelamin.');
            return false;
        }

        // Validasi nomor identitas
        const numIdentity = document.getElementById('num_identity').value;
        if (numIdentity.length !== 16 || isNaN(numIdentity)) {
            alert('Isian salah, data harus 16 digit angka.');
            return false;
        }

        // Validasi tipe kamar
        const idClass = document.getElementById('id_class').value;
        if (idClass === 'new') {
            alert('Silakan pilih tipe kamar.');
            return false;
        }

        // Validasi tanggal pesan
        const orderDate = document.getElementById('order_date').value;
        if (!orderDate) {
            alert('Silakan isi tanggal pesan.');
            return false;
        }

        // Validasi durasi menginap
        const duration = document.getElementById('duration').value;
        if (isNaN(duration) || duration <= 0) {
            alert('Harap isi durasi menginap dengan angka yang valid.');
            return false;
        }

        return true;
    }
</script>
<script>
    /**
     * This script fetches the price of a selected hotel room class using AJAX.
     * It listens to the change event of the room class select element and sends a POST request to the server.
     * The server responds with the price of the selected room class, which is then displayed in the hargaField input element.
     */
    document.addEventListener("DOMContentLoaded", function() {
        const idClassSelect = document.getElementById("id_class");
        const hargaField = document.getElementById("harga");

        idClassSelect.addEventListener("change", function() {
            const selectedValue = this.value;
            if (selectedValue !== "") {
                fetchPrice(selectedValue);
            } else {
                hargaField.value = "";
            }
        });

        function fetchPrice(selectedValue) {
            fetch("/controller/priceAjax.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "id_class=" + selectedValue,
                })
                .then((response) => response.text())
                .then((data) => {
                    const price = parseInt(data);
                    const formattedPrice = price.toLocaleString("id-ID", {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0,
                    });

                    hargaField.value = "Rp " + formattedPrice;
                })

                .catch((error) => {
                    console.error("Error fetching price:", error);
                });
        }
    });
</script>
<script>
    /**
     * Resets the reservation form by calling the reset() method on the HTML element with the ID 'reservationForm'.
     *
     * @return void
     */
    function resetForm() {
        document.getElementById('reservationForm').reset();
    }
</script>
<script>
    /**
     * Calculates the total price of a hotel room reservation based on the room price, duration of stay, and breakfast option.
     *
     * @return void
     */
    function calculateTotal() {
        if (!validateForm()) {
            document.getElementById('total_price').value = "Isi Data Dengan Benar";
        } else {
            const harga = parseInt(document.getElementById('harga').value.replace(/[^\d]/g, ''));
            const duration = parseInt(document.getElementById('duration').value);
            const breakfast = document.getElementById('breakfast').checked;

            if (harga && duration) {
                const breakfastPrice = 80000;
                const discount = duration >= 3 ? 0.1 : 0;
                const breakfastTotal = breakfast ? breakfastPrice * duration : 0;
                const roomTotal = harga * duration * (1 - discount);
                const total = roomTotal + breakfastTotal;

                const formattedTotal = total.toLocaleString("id-ID", {
                    style: "currency",
                    currency: "IDR",
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                });

                document.getElementById('total_price').value = formattedTotal;
            }
        }
    }
</script>

<?php include 'footer.php'; ?>