<body class="hold-transition sidebar-mini">

  <body>
    <div class="loading-animation" id="loading">
      <div class="spinner"></div> <!-- Spinner -->
      <p class="loading-text">Please wait<span id="dots">...</span></p> <!-- Teks Loading -->
    </div>
    <!-- Konten halaman lainnya -->

    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">PENGIRIMAN PELABUHAN</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <span class="dropdown-item dropdown-header">15 Notifications</span>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> 4 new messages
                <span class="float-right text-muted text-sm">3 mins</span>
              </a>
              <!-- <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-users mr-2"></i> 8 friend requests
                <span class="float-right text-muted text-sm">12 hours</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-file mr-2"></i> 3 new reports
                <span class="float-right text-muted text-sm">2 days</span>
              </a> -->
              <!-- <div class="dropdown-divider">

              </div> -->
              <!-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
            </div>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" data-widget="fullscreen" href="#" data-widget="fullscreen" data-toggle="modal" data-target="#profileModal" role="button">
              <i class="fas fa-user"></i>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
              <i class="fas fa-th-large"></i>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Modal Profile-->
      <div class="modal fade slide" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="profileModalLabel">My Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>This is the profile modal.</p>
            </div>
            <div class="modal-body">
              <div class="card mt-3" id="addUserCard" style="display: none;">
                <div class="card-header">
                  Form Add User
                </div>
                <div class="card-body">
                  <form id="addUserForm">
                    <div class="form-group">
                      <input type="text" class="form-control" id="username" required>
                      <label for="username">Username</label>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" required>
                      <label for="password">Password</label>
                    </div>
                    <div class="form-group">
                      <select name="role" id="role">
                        <option selected disabled>--:--</option>
                        <option value="1">Admin</option>
                        <option value="2">Sender</option>
                        <option value="3">Harbor</option>
                        <option value="4">Receiver</option>
                      </select>
                    </div>
                    <!-- <div class="card-footer"> -->
                    <button type="submit" class="btn btn-primary">Save</button>
                    <!-- </div> -->
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="btn-add">
                <i id="icon-toggle" class="fas fa-user-plus"></i>
              </button>
              <button type="button" class="btn btn-danger" id="btn-logout"><i class="fa-solid fa-power-off"></i>&nbsp;Log Out</button>
            </div>
          </div>
        </div>
      </div>



      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-light-secondary elevation-4">
        <!-- Brand Logo -->
        <!-- <a href="index3.html" class="brand-link">
        <img src="<?= base_url('public/assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a> -->

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="<?= base_url('public/assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <?php foreach ($main_menu as $user ) {?>
                <a href="#" class="d-block">
                  <?= $user['username'] ?? '' ?>
                  </a>
                <?php } ?>
            </div>
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <?php foreach ($main_menu as $menu): ?>
                
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon <?= $menu['icon'] ?>"></i>
                    <p>
                      <?= $menu['title'] ?>
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php foreach ($menu['sub_menus'] as $sub_menu): ?>
                      <li class="nav-item">
                        <a href="<?= $sub_menu['url'] ?>" class="nav-link">
                          <i class="<?= $sub_menu['icon'] ?>"></i>
                          <p><?= $sub_menu['title'] ?></p>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <script>
        window.addEventListener('beforeunload', function() {
          document.getElementById('loading').style.display = 'flex';
        });
        window.addEventListener('load', function() {
          document.getElementById('loading').style.display = 'none';
        });
      </script>
      <script>
        // Trigger the slide-out animation before closing the modal
        $('#profileModal').on('hide.bs.modal', function(e) {
          $(this).addClass('slide-out');
        });

        // Remove slide-out class when the modal is completely hidden
        $('#profileModal').on('hidden.bs.modal', function(e) {
          $(this).removeClass('slide-out');
        });
      </script>
      <script>
        $('#btn-logout').on('click', function(e) {
          e.preventDefault(); // Prevent default link action
          Swal.fire({
            title: 'Are you sure?',
            text: "You will be logged out!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, log out!',
            cancelButtonText: 'Cancel'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: '<?= site_url("log-out") ?>', // URL to logout function
                type: 'POST',
                data: {
                  "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
                },
                success: function(response) {
                  Swal.fire({
                    title: 'Logged Out!',
                    text: 'You have been successfully logged out.',
                    icon: 'success',
                    focusConfirm: true,
                    confirmButtonColor: '#3085d6'
                  }).then(() => {
                    window.location.href = "<?= base_url('login') ?>"; // Redirect after logout
                  });
                },
                error: function() {
                  Swal.fire({
                    title: 'Error!',
                    text: 'Logout failed. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                  });
                }
              });
            }
          });
        });
      </script>
      <script>
        document.getElementById('btn-add').addEventListener('click', function() {
          const addUserCard = document.getElementById('addUserCard');
          const iconToggle = document.getElementById('icon-toggle');
          // Toggle antara menampilkan dan menyembunyikan card
          if (addUserCard.style.display === 'none') {
            addUserCard.style.display = 'block';
            iconToggle.classList.remove('fa-user-plus'); // Hapus ikon user-plus
            iconToggle.classList.add('fa-xmark'); // Tambah ikon user-minus
          } else {
            addUserCard.style.display = 'none';
            iconToggle.classList.remove('fa-xmark'); // Hapus ikon user-minus
            iconToggle.classList.add('fa-user-plus'); // Tambah ikon user-plus
          }
        });
      </script>
      <script>
        function gatherUserData() {
          let userData = {
            username: $('#username').val(),
            password: $('#password').val(),
            role: $('#role').val(),
            "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
          };
          return userData;
        }

        function sendUserDataAjax(data) {
          $.ajax({
            url: "<?= site_url('add-user') ?>", // Ganti dengan URL endpoint yang sesuai
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: function(response) {
              console.log('Response dari server:', response);
              if (response.status === 'success') {
                Swal.fire(
                  'Berhasil!',
                  'User telah berhasil ditambahkan.',
                  'success'
                ).then(() => {
                  // $('#addUserCard').hide(); 
                  location.reload();
                  // Reset form jika diperlukan
                  // $('#addUserForm')[0].reset();
                });
              } else {
                Swal.fire(
                  'Gagal!',
                  'Terjadi kesalahan: ' + response.message,
                  'error',
                ).then(()=>{
                  location.reload();
                });
                
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
          $('#addUserForm').submit(function(e) {
            e.preventDefault();

            // Ambil data dari form
            var username = $('#username').val();
            var password = $('#password').val();
            var role = $('#role').val();

            if (username === '' || password === '' || role === null) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Harap lengkapi semua field!',
              });
            } else {
              // console.log('Data yang akan disubmit:', {
              //   username: username,
              //   password: password,
              //   role: role,
              // });
              Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan user ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambah user!',
                cancelButtonText: 'Batal',
              }).then((result) => {
                if (result.value) {
                  let my_data = gatherUserData(); // Mengumpulkan data
                  sendUserDataAjax(my_data); // Mengirim data
                  
                }
              });
            }
          });
        });
      </script>

<!-- <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      \
                      <i class="right fas fa-angle-left"></i>
                    </p>

                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Barang</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Form Input Barang</p>
                      </a>
                    </li>
                     <li class="nav-item">
                  <a href="./index3.html" 
                  class="nav-link"
                  >
                  class="nav-link active"
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dashboard v3</p>
                  </a>
                </li> 
                  </ul>
                </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Check Package
                    <i class="fas fa-angle-left right"></i>
                     <span class="badge badge-info right">6</span> 
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Arrived Data</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Received Data </p>
                    </a>
                  </li>
                </ul>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Widgets
                    <span class="right badge badge-danger">New</span>
                  </p>
                </a>
              </li> -->