<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item"><a href="#"><?= $parse['title'] ?></a></li>
                        <li class="breadcrumb-item active"><?= $parse['content'] ?></li>
                    </ol>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="myCard" class="card shadow fade-scale">
                        <div class="card-header border-0" style="background-color: rgba(0, 20, 80, 0.9); backdrop-filter: blur(8px);">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title text-white">Form Input Barang</h3>
                                <a class="button-32" href="javascript:void(0);">Tambah data&nbsp;<i class="fas fa-plus fa-sm"></i></a>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <form id="formPengiriman">
                                <?php if (!empty($error_message)): ?>
                                    <div class="alert alert-danger mb-4" role="alert">
                                        <?= $error_message; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col col-lg-6">
                                        <input type="text" id="id-barang" class="form-control" value="<?= $id_barang ?>" required>
                                        <label for="id-barang">ID barang</label>
                                    </div>
                                    <div class="form-group col col-lg-6">
                                        <input type="text" id="bill-landing" class="form-control" name="bill_landing" value="<?= !empty($error_message) ? '' : $bill ?>"
                                            required <?= !empty($error_message) ? 'readonly' : '' ?>>
                                        <label for="bill-landing">Bill of landing</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col col-lg-12">
                                        <textarea type="text" id="deskripsi-barang" class="form-control" required></textarea>
                                        <label for="deskripsi-barang">Deskripsi barang</label>
                                    </div>
                                </div>
                                <p>tes</p>
                                <div class="row mt-3">
                                    <div class="form-group col col-lg-6">
                                        <select id="status-barang" class="form-control" required>
                                            <option selected disabled></option>
                                            <option value="1">In Shipping</option>
                                        </select>
                                        <label for="status-barang">Status Barang</label>
                                    </div>
                                    <div class="form-group col col-lg-6">
                                        <input type="text" id="port" class="form-control" required>
                                        <label for="port">Port</label>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-group col col-lg-6">
                                        <input type="date" id="tanggal-barang" class="form-control" required>
                                    </div>
                                    <div class="form-group col col-lg-6">
                                        <input type="time" id="waktu-barang" class="form-control" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn button-primary mt-3"><i class="fas fa-save fa-lg"></i>&nbsp;SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function gatherData() {
        let userData = {
            id_barang: $('#id-barang').val(),
            bill_landing: $('#bill-landing').val(),
            deskripsi_barang: $('#deskripsi-barang').val(),
            status_barang: $('#status-barang').val(),
            port: $('#port').val(),
            tanggal_barang: $('#tanggal-barang').val(),
            waktu_barang: $('#waktu-barang').val(),
            "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
        }
        return userData;
    }

    function sendDataAjax(data) {
        $.ajax({
            url: "<?= site_url('post-pengiriman') ?>",
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function(response) {
                console.log('Response dari server:', response);
                if (response.status === 'success') {
                    Swal.fire(
                        'Berhasil!',
                        'Data telah berhasil disubmit.',
                        'success'
                    ).then(() => {
                        location.reload(); // Refresh halaman setelah konfirmasi
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan: ' + response.message,
                        'error'
                    );
                }
            },
            error: function(ts) {
                console.error('Kesalahan saat submit data:', ts.responseText);
                Swal.fire(
                    'Gagal!',
                    'Terjadi kesalahan saat submit data: ' + ts.responseText,
                    'error'
                );
            }
        });
    }
    $(document).ready(function() {
        $('#formPengiriman').submit(function(e) {
            e.preventDefault();

            var idBarang = $('#id-barang').val();
            var billLanding = $('#bill-landing').val();
            var deskripsiBarang = $('#deskripsi-barang').val();
            var statusBarang = $('#status-barang').val();
            var port = $('#port').val();
            var tanggalBarang = $('#tanggal-barang').val();
            var waktuBarang = $('#waktu-barang').val();

            // Validasi sederhana
            if (idBarang === '' || billLanding === '' || deskripsiBarang === '' || statusBarang === '' || port === '' || tanggalBarang === '' || waktuBarang === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap lengkapi semua field!',
                });
            } else {
                // Mencetak data yang akan disubmit ke console
                console.log('Data yang akan disubmit:', {
                    id_barang: idBarang,
                    bill_landing: billLanding,
                    deskripsi_barang: deskripsiBarang,
                    status_barang: statusBarang,
                    port: port,
                    tanggal_barang: tanggalBarang,
                    waktu_barang: waktuBarang,
                    "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
                });
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin submit data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, submit!',
                    cancelButtonText: 'Batal'
                }).then((isConfirmed) => {
                    if (isConfirmed) {
                        let my_data = gatherData(); // Mengumpulkan data
                        sendDataAjax(my_data); // Mengirim data\
                    }
                    return false;
                });
            }
        });
    });
</script>



<script>
    window.addEventListener('load', function() {
        const card = document.getElementById('myCard'); // Pastikan ini sesuai dengan ID card
        card.classList.add('in'); // Menambahkan class 'in' untuk memicu animasi
    });
</script>

</body>

</html>