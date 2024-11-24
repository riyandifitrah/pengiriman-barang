<style>
    .downloadButton {
        appearance: none;
        /* Menghapus gaya default */
        border: none;
        /* Menghapus border default */
        outline: none;
        /* Menghapus outline klik default */
        width: 120px;
        height: 40px;
        font-size: 14px;
        text-align: center;
        margin-right: 5px;
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid DodgerBlue;
        background-color: DodgerBlue;
        color: white;
        transition: transform 0.2s ease, background-color 0.2s ease;
        border-radius: 12px;
    }

    .downloadButton:hover:active {
        transform: scale(0.98);
        transition: transform 0.1s ease;
        outline: none;
        border: 1px solid white;
    }

    .downloadButton:active {
        outline: none;
        border: 1px solid white;
    }

    .downloadButton:focus {
        outline: none;
    }

    .downloadButton:hover {
        transform: scale(0.94);
        background-color: #1E90FF;
        border: 1px solid white;
    }
</style>

<?php if (!empty($data)): ?>
    <table class="table table-bordered mt-3" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Bill</th>
                <th>Deskripsi</th>
                <th>Tanggal Kirim</th>
                <th>Tanggal Tiba</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            if (is_array($data)):
                foreach ($data as $i => $v):
                    $tgl_kirim = isset($v->created_at) ? date('d-m-Y', strtotime($v->created_at)) : '';
                    $tgl_tiba = isset($v->updated_second_at) ? date('d-m-Y', strtotime($v->updated_second_at)) : '';
                    $status = '';
                    if (isset($v->status)) {
                        switch ($v->status) {
                            case 1:
                                $status = 'In Shipping';
                                break;
                            case 2:
                                $status = 'Arrive at Port';
                                break;
                            case 3:
                                $status = 'Received';
                                break;
                            default:
                                $status = '';
                                break;
                        }
                    }
            ?>
                    <tr>
                        <td width="2%"><?= ++$no ?></td>
                        <td class="bill"><?= $v->bill ?? '' ?></td>
                        <td class="deskripsi"><?= $v->deskripsi ?? '' ?></td>
                        <td class="tgl_kirim"><?= $tgl_kirim ?></td>
                        <td class="tgl_tiba"><?= $tgl_tiba ?></td>
                        <td class="status"><?= $status ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="row mt-4">
        <div class="col-12 text-right">
            <button type="button" class="downloadButton" id="downloadButton">
                <i class="fas fa-file-download"></i>&nbsp;Download
            </button>
        </div>
    </div>


<?php else: ?>
    <table class="table table-bordered mt-3" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Bill</th>
                <th>Deskripsi</th>
                <th>Tanggal Kirim</th>
                <th>Tanggal Tiba</th>
                <th>Status</th>
            </tr>
        </thead>
        <tr>
            <td colspan="6" class="text-center">Data tidak ditemukan</td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>
<script>
    $(document).ready(function() {
        $('#downloadButton').on('click', function(e) {
            e.preventDefault();
            var data = [];
            $('table tbody tr').each(function() {
                var rowData = {
                    bill: $(this).find('.bill').text(),
                    deskripsi: $(this).find('.deskripsi').text(),
                    tgl_kirim: $(this).find('.tgl_kirim').text(),
                    tgl_tiba: $(this).find('.tgl_tiba').text(),
                    status: $(this).find('.status').text(),
                };
                data.push(rowData);
            });
            // Membuat query string
            var queryString = 'data=' + encodeURIComponent(JSON.stringify(data));
            $.ajax({
                url: "<?= base_url('export-data-csv') ?>",
                type: 'GET',
                data: {
                    data: JSON.stringify(data)
                },
                beforeSend: function() {
                    $('#downloadButton').html('<i class="fas fa-spinner fa-spin"></i>');
                },
                success: function(response) {
                    var newWindow = window.open("<?= base_url('export-data-csv') ?>?" + queryString, "_blank");
                    setTimeout(function() {
                        $('#downloadButton').html('<i class="fas fa-check"></i>');
                        newWindow.close();
                    }, 2000);
                }
            });
        });
    });
</script>