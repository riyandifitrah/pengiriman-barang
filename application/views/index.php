</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div id="myCard" class="card shadow fade-scale">
            <div class="card-header border-0" style="background-color: rgba(0, 20, 80, 0.9); backdrop-filter: blur(8px);">
              <div class="d-flex justify-content-between">
                <h3 class="card-title text-white">Data Pengiriman</h3>
                <a class="button-32" href="<?= site_url('form-input-barang') ?>">Tambah data&nbsp;<i class="fas fa-plus fa-sm"></i></a>
              </div>
            </div>
            <div class="card-body mt-3">
              <table id="myTable" class="display table-responsive" style="width:100%">
                <thead>
                  <tr class="text-center">
                    <th width="1%">No</th>
                    <th>ID Barang</th>
                    <th>Bill</th>
                    <th>Status</th>
                    <th>Port</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header mb-2 bg-info" >
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-diagram-next"></i>&nbsp;Data Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm">
          <div class="row">
            <div class="form-group col col-lg-6">
              <input type="text" id="id-barang" class="form-control">
              <label for="id-barang">ID barang</label>
            </div>
            <div class="form-group col col-lg-6">
              <input type="text" id="bill-landing" class="form-control" name="bill_landing">
              <label for="bill-landing">Bill of landing</label>
            </div>
          </div>
          <div class="row mt-3">
            <div class="form-group col col-lg-12">
              <textarea type="text" id="deskripsi-barang" class="form-control" required></textarea>
              <label for="deskripsi-barang">Deskripsi barang</label>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
</body>
<script>
$(document).ready(function() {
  $(document).on('click', '#btn-update', function(e) {
    e.preventDefault(); 
    var id_barang = $(this).data('id');
    console.log(id_barang);
    Swal.fire({
      title: 'Konfirmasi',
      text: 'Apakah Anda ingin mengupdate status barang ?' ,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#ffc107',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, update!',
      cancelButtonText: 'Batal'
    }).then((isConfirmed) => {
      if (isConfirmed) {
        $.ajax({
          url: '<?= site_url('update-pengiriman') ?>', 
          type: 'POST',
          dataType: 'json',
          data: {
            id_barang: id_barang,
            "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
          },
          success: function(response) {
            console.log(response);
            if (response.status === 'success') {
              Swal.fire(
                        'Berhasil!',
                        'Data telah berhasil diupdate.',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
            } else {
                    Swal.fire(
                        'Gagal!',
                        'Terjadi kesalahan: ' + response.message,
                        'error'
                    );
                }
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error: ' + error);
            Swal.fire("Error!", "Terjadi kesalahan saat mengupdate status.", "error");
          }
        });
      }
    });
  });
});
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '#btn-view', function(e) {
      e.preventDefault(); 
      var id_barang = $(this).data('id');
      $.ajax({
        url: '<?= site_url('fetch-pengiriman') ?>',
        type: 'GET',
        dataType: 'json',
        data: {
          id_barang: id_barang
        },
        success: function(response) {
          console.log(response);
          $('#id-barang').val(response.id_barang);
          $('#bill-landing').val(response.bill);
          $('#deskripsi-barang').val(response.deskripsi);

          
          $('#exampleModal').modal('show');
        },
        error: function(xhr, status, error) {
          console.error('AJAX Error: ' + error);
        }
      });
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '#btn-x', function(e) {
      e.preventDefault(); 
      alert('Unknown');
      $('#exampleModal').modal('show');
    });
  });
</script>


<!-- <script>
  $(document).ready(function() {
    $(document).on('click', '#btn-view', function(e) {
      e.preventDefault(); 
      var id_barang = $(this).data('id'); 
      console.log(id_barang); 
      $('#id-barang').text(id_barang); 
      $('#exampleModal').modal('show'); 
    });
  });
</script> -->

<script>
  window.addEventListener('load', function() {
    const card = document.getElementById('myCard'); 
    card.classList.add('in');
  });
</script>
<script>
  $(document).ready(function() {
    
    $('#myTable').DataTable({
      processing: true, 
      serverSide: true, 
      paging: true, 
      lengthChange: true, 
      searching: true, 
      ordering: true, 
      info: true, 
      autoWidth: false, 
      responsive: true, 
      pageLength: 10,
      lengthMenu: [10, 15, 20, 35, 50, 100, 200, 500],
      ajax: {
        url: "<?= base_url('get-pengiriman') ?>", 
        type: "GET" 
      },
      columns: [{
          data: "no"
        },
        {
          data: "id_barang"
        },
        {
          data: "bill"
        },
        {
          data: "status"
        },
        {
          data: "port"
        },
        {
          data: "tgl"
        },
        {
          data: "waktu"
        },
        {
          data: "deskripsi"
        },
        {
          data: "action"
        }
      ],
      // // Jika ingin menambahkan tombol export dan fitur lain
      // dom: 'Bfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'      // Ekspor data ke berbagai format
      // ]
    });
  });
</script>


</html>