<style>
    .unbold-text {
        font-weight: normal !important;
    }

    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 0px solid black;
        font-size: 10px;
    }

    table.table-bordered {
        margin: 0;
        padding: 0;
    }

    .content-wrapper .form-group {
        margin-bottom: 1rem;
    }

    .card-header {
        background-color: rgba(0, 20, 80, 0.9);
        backdrop-filter: blur(8px);
    }

    .form-control {
        width: 100%;
    }

    .btn {
        margin-right: 5px;
    }

    #statusButtons .btn {
        width: 120px;
        height: 40px;
        font-size: 14px;
        text-align: center;
        margin-right: 5px;
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid #007bff;
        background-color: white;
        color: #007bff;
        transition: all 0.2s ease;
    }

    #statusButtons .btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    #statusButtons .btn:hover {
        background-color: #0056b3;
        color: white;
    }

    .downloadButton {
        width: 120px;
        height: 40px;
        font-size: 14px;
        text-align: center;
        margin-right: 5px;
        padding: 5px 10px;
        cursor: pointer;
        border: 1px solid #1FA2FF;
        background-color: white;
        color: #1FA2FF;
        transition: all 0.2s ease;
    }

    .downloadButton:active {
        background-color: #1FA2FF;
        color: white;
        border-color: #1FA2FF;
    }

    /* 12D8FA */


    .downloadButton:hover {
        background-color: #12D8FA;
        color: white;
    }
</style>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                        <li class="breadcrumb-item active"><?= $content ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid mb-3 d-none container-loading">
            <div class="progress skill-bar">
                <div id="prog" class="progress-bar progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                    <span class="progress-status"></span>
                    <span id="progress-value" class="pull-right">0%</span>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="myCard" class="card shadow fade-scale">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title text-white">Penarikan Data Pengiriman Barang</h3>
                            </div>
                        </div>
                        <div class="card-body mt-3">
                            <form id="formPengiriman" method="GET">
                                <?php if (!empty($error_message)): ?>
                                    <div class="alert alert-danger mb-4" role="alert">
                                        <?= $error_message; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-2">
                                    <div class="col-md-4">
                                        <label>Select Status: <span class="tx-danger">*</span></label>
                                        <div id="statusButtons" class="btn-group" role="group">
                                            <button type="button" class="btn" data-status="all">All</button>
                                            <button type="button" class="btn" data-status="1">In Shipping</button>
                                            <button type="button" class="btn" data-status="2">Arrive at Port</button>
                                            <button type="button" class="btn" data-status="3">Received</button>
                                        </div>

                                        <input type="hidden" name="statuses" id="statusInput" value="">
                                        <div id="statusError" class="text-danger mt-2" style="display: none;">Please select at least one status.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Pilih Tgl, Bulan, & Tahun: <span class="tx-danger">*</span></label>
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <select id='tgla' name='tgla' class='form-control' style="width: 80px;" required>
                                                        <option value='01' selected>01</option>
                                                        <?php
                                                        for ($tgl = 2; $tgl <= 31; $tgl++) {
                                                            $i = str_pad($tgl, 2, "0", STR_PAD_LEFT);
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="blna" name='blna' class='form-control' style="width: 120px;" required>
                                                        <?php
                                                        $blns = date("m");
                                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            $selected = ($bulan == $blns) ? "selected" : "";
                                                            echo "<option value='$bulan' $selected>{$bln[$bulan]}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="thna" name='thna' class='form-control' style="width: 100px;" required>
                                                        <?php
                                                        $now = date("Y");
                                                        for ($thn = 2019; $thn <= $now; $thn++) {
                                                            $selected = ($thn == $now) ? "selected" : "";
                                                            echo "<option value='$thn' $selected>$thn</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-2 d-flex justify-contenct-center align-item-center">
                                        <table width="100%">
                                            <tr>
                                                <td align="center">
                                                    <i class="fa fa-long-arrow-alt-right fa-2xl"></i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Pilih Tgl, Bulan, & Tahun: <span class="tx-danger">*</span></label>
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <select id="tgli" name='tgli' class='form-control' style="width: 80px;" required>
                                                        <option value='01' selected>01</option>
                                                        <?php
                                                        for ($tgl = 2; $tgl <= 31; $tgl++) {
                                                            $i = str_pad($tgl, 2, "0", STR_PAD_LEFT);
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="blni" name='blni' class='form-control' style="width: 120px;" required>
                                                        <?php
                                                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                                                            $selected = ($bulan == $blns) ? "selected" : "";
                                                            echo "<option value='$bulan' $selected>{$bln[$bulan]}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="thni" name='thni' class='form-control' style="width: 100px;" required>
                                                        <?php
                                                        for ($thn = 2019; $thn <= $now; $thn++) {
                                                            $selected = ($thn == $now) ? "selected" : "";
                                                            echo "<option value='$thn' $selected>$thn</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 text-right">
                                        <!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
                                        <input type="submit" value="View Data" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                            <div id="dataContainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014 - <?= date('Y') ?> <a href="https://adminlte.io">User Not Found</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
<!-- ./wrapper -->

<script>
    window.addEventListener('load', function() {
        const card = document.getElementById('myCard');
        card.classList.add('in');
    });
</script>
<script>
    $(document).ready(function() {
        $('#statusButtons .btn').on('click', function() {
            const status = $(this).data('status');
            if (status === 'all') {
                if ($(this).hasClass('active')) {
                    // Toggle all status buttons
                    $('#statusButtons .btn').removeClass('active');
                } else {
                    // Toggle all status buttons
                    $('#statusButtons .btn').addClass('active');
                }
            } else {
                $(this).toggleClass('active');
            }
            if (
                $('#statusButtons .btn[data-status="1"]').hasClass('active') &&
                $('#statusButtons .btn[data-status="2"]').hasClass('active') &&
                $('#statusButtons .btn[data-status="3"]').hasClass('active')
            ) {
                $('#statusButtons .btn[data-status="all"]').addClass('active');
            } else {
                $('#statusButtons .btn[data-status="all"]').removeClass('active');
            }

            let selectedStatuses = [];
            $('#statusButtons .btn.active').each(function() {
                const status = $(this).data('status');
                if (status !== 'all') {
                    selectedStatuses.push(status);
                }
            });

            $('#statusInput').val(selectedStatuses.join(','));
            console.log(selectedStatuses.join(','));
        });

        $('#formPengiriman').on('submit', function(event) {
            event.preventDefault();
            let isValid = true;

            // Validasi status
            const selectedStatuses = $('#statusButtons .btn.active').length;
            if (selectedStatuses === 0) {
                isValid = false;
                $('#statusError').show(); // Tampilkan pesan error
            } else {
                $('#statusError').hide(); // Sembunyikan pesan error jika valid
            }

            // Validasi tanggal (opsional)
            $('select[name="tgla"], select[name="blna"], select[name="thna"], select[name="tgli"], select[name="blni"], select[name="thni"]').each(function() {
                if ($(this).val() === "") {
                    isValid = false;
                    alert("Please fill in all required fields.");
                    return false;
                }
            });

            if (!isValid) {
                return; // Jangan lanjutkan submit jika ada error
            }
            let data = {
                statuses: $('#statusInput').val(),
                tgla: $('#tgla').val(),
                blna: $('#blna').val(),
                thna: $('#thna').val(),
                tgli: $('#tgli').val(),
                blni: $('#blni').val(),
                thni: $('#thni').val(),
                "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
            };
            $('.container-fluid.mb-3').removeClass('d-none');
            let progress_val = 0;
            $('#prog').css('width', progress_val + '%').attr('aria-valuenow', progress_val);
            $('#progress-value').text(progress_val + '%');

            // Flag to prevent multiple intervals
            let isProgressing = true;
            let progressInterval = setInterval(function() {
                if (progress_val < 100 && isProgressing) {
                    progress_val += 50;
                    $('#prog').css('width', progress_val + '%').attr('aria-valuenow', progress_val);
                    $('#progress-value').text(progress_val + '%');
                } else if (progress_val == 50 && isProgressing) {
                    $('#prog').css('width', progress_val + '%').attr('aria-valuenow', progress_val);
                    $('#progress-value').text(progress_val + '%');
                } else {
                    clearInterval(progressInterval);
                }
            }, 500);

            $.ajax({
                url: '<?= base_url('view-data-csv') ?>',
                type: 'POST',
                data: data,
                beforeSend: function() {
                    
                    if (progress_val === 0) {
                        $('#prog').css('width', progress_val + '%').attr('aria-valuenow', progress_val);
                    }
                },
                success: function(response) {
                    setTimeout(function() {
                        $('#prog').css('width', '100%').attr('aria-valuenow', '100');
                        $('#progress-value').text("100% - Data Sent!");
                        $('#dataContainer').html(response);
                        $('.container-loading').addClass('d-none');
                        isProgressing = false;
                    },2000);
                },
                error: function(xhr, status, error) {
                    clearInterval(progressInterval); // Stop the progress animation
                    $('#prog').css('width', '0%').attr('aria-valuenow', '0');
                    $('#progress-value').text("Error - " + error);
                    alert("Terjadi kesalahan: " + error);
                },
                complete: function() {
                    // Hide the progress bar after request completion
                    setTimeout(function() {
                        
                    }, 500); // Delay hiding to show completion status
                }
            });
        });
    });
</script>