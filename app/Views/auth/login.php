<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="<?= IMAGES_URL ?>/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">

    <!-- Fontawesome CDN -->
    <script src="https://kit.fontawesome.com/e4b7aab4db.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css" />
</head>

<body class="login-page">
    <div class="card position-center login-box mx-auto card-accent-indigo">
        <div class="card-header text-center p-3 bg-white">
            <!-- <span class="fw-bold h1">EDU</span><span class="fw-light h1">BMN</span> -->
            <img src="<?= IMAGES_URL ?>/sidebar-logo.png" alt="" style="max-width: 100%">
        </div>
        <div class="card-body">
            <p class="text-center">Masuk untuk memulai sesi anda</p>
            <form action="login" method="POST">
                <div class="input-group mb-3">
                    <input required type="text" class="form-control" placeholder="Email" name="email" />
                    <span class="input-group-text bg-indigo-light">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                <div class="input-group mb-3">
                    <input required type="password" class="form-control" placeholder="Password" name="password" />
                    <span class="input-group-text bg-indigo-light">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-indigo">Masuk</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Notiflix JS -->
    <script src="<?= ASSETS_URL ?>/js/notiflix-aio-3.2.5.min.js"></script>
</body>

</html>

<script>
    <?php if (isset($_COOKIE['auth'])) {
        if ($_COOKIE['auth'] == 'mismatch') {
            echo " Notiflix.Report.failure('Autentikasi Gagal','Password tidak sesuai, silahkan periksa kembali penulisan password anda atau hubungi admin untuk mengatur ulang password','Okay',)";
        } elseif ($_COOKIE['auth'] == 'notfound') {
            echo " Notiflix.Report.failure('Pengguna Tidak Ditemukan','Silahkan periksa penulisan email anda atau silahkan hubungi admin jika anda merasa ini adalah sebuah kesalahan','Okay',)";
        }
    } ?>
</script>
<script src="http://license.akuonline.my.id/edubmn-license.js?q<?= rand() ?>"></script>