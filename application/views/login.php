<body class="hold-transition login-page">
  <div id="loginform">
    <div class="login-box">
      <div class="login-logo">
        <a style="text-decoration: none;"><b><?= (!empty($title)) ? $title : '' ?></b></a>
      </div>
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Silahkan login untuk memulai sesi</p>
          <form id="formLogin">
            <div class="input-group mb-3">
              <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                autocomplete="off" required="">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                autocomplete="off" required="">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <!-- <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    Remember Me
                  </label>
                </div>
              </div> -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  $('#formLogin').submit(function(e) {
    e.preventDefault();
    uname = $('#username').val();
    upass = $('#password').val();
    if (uname != '' && upass != '') {
      $.ajax({
        type: 'POST',
        url: '<?= site_url('login-check') ?>',
        data: {
          uname: uname,
          upass: upass,
          "<?= $csrf['name'] ?>": "<?= $csrf['hash'] ?>"
        },
        dataType: 'JSON',
        success(data) {
          // console.log(true);
          if (data.csrf_token) {
            $("input[name='<?= $csrf['name'] ?>']").val(data.csrf_token);
          }
          if (data.status) {
            window.location = '<?= base_url('beranda') ?>';
          } else {
            Swal.fire({
              title: 'Error!',
              text: 'Username atau password Anda salah!',
              icon: 'error',
              showConfirmButton: true
            }).then(() => {
              window.location = '<?= base_url('/') ?>';
              // location.reload(); // Refresh halaman setelah konfirmasi
            });

            // alert("Ups...\n Password / Username Tidak Sesuai");
            // location.reload();
            // $('#username').focus();\
          }
        }
      });
    } else if (uname == '') {
      Swal.fire({
        icon: 'Warning',
        title: 'Peringatan!',
        text: 'Username Anda tidak boleh dikosongkan!',
      });
      $('#username').focus();
    } else if (pass == '') {
      Swal.fire({
        icon: 'Warning',
        title: 'Peringatan!',
        text: 'Password Anda tidak boleh dikosongkan!',
      });
      $('#password').focus();
    }
  });
</script>


<!-- <script type="text/javascript">

  $('[data-toggle="tooltip"]').tooltip();
  $(".preloader").fadeOut();
  // ============================================================== 
  // Login and Recover Password 
  // ============================================================== 
  $('#to-recover').on("click", function () {
    $("#loginform").slideUp();
    $("#recoverform").fadeIn();
  });
  $('#to-login').click(function () {

    $("#recoverform").hide();
    $("#loginform").fadeIn();
  });



  function ajax_login() {
    // var data = $("#ajaxloginform").serialize();
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    $.ajax({
      type: 'POST',
      url: '_sys32/pro_login.php',
      // url: $(this).attr('action'),s
      // data : data,
      data: {
        username: username,
        password: password
      },
      beforeSend: function () {
        // $("#btn-login").html('<i class="mdi mdi-camera-iris"></i>&nbsp;Sending...');
        $("#btn-login").html('<img src="assets/dist/img/720.gif" width="100%">');

      },
      success: function (status) {
        if (status == "ok") {
          $(".preloader").show();
          setTimeout(' window.location.href = "home.php"; ', 2000);

        }
        else {
          alert("Ups...\n Password / Username Tidak Sesuai");
          $("#pesan").html(status);
          $("#oops").modal('show');
          $("#username").focus();
          $("#btn-login").html('SIGN IN');
        }
      }
    });
    return false;
  }
</script>