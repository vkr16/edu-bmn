<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elektronik Data Terpadu - Barang Milik Negara | IAIN Parepare </title>
    <link rel="shortcut icon" href="<?= IMAGES_URL ?>/logo.png" type="image/x-icon">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css" />
</head>

<body>

    <div class="col-md-6 offset-md-3 mt-4 mb-4 px-3">
        <img src="<?= IMAGES_URL ?>/sidebar-logo.png" style="width: 300px">
    </div>
    <div class="col-md-6 offset-md-3 border rounded-1 shadow-sm p-3">
        <div class="d-flex justify-content-start">
            <span class="fs-4 fw-bold mb-2">Detail Informasi</span>
        </div>
        <div class="row g-3">
            <div class="col-lg-8">
                <p class="text-blue fw-semibold mb-2">Kode Barang</p>
                <div class="rounded-1 border px-2 py-1" id="detail-kodebarang">
                    <?= $pdmdata[0]['kode_barang']; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="text-blue fw-semibold mb-2">NUP</p>
                <div class="rounded-1 border px-2 py-1" id="detail-nup">
                    <?= $pdmdata[0]['nup']; ?>

                </div>
            </div>
            <!-- <div class="col-lg-3">
                <p class="text-blue fw-semibold mb-2">Kuantitas </p>
                <div class="rounded-1 border px-2 py-1" id="detail-kuantitas">

                </div>
            </div> -->
            <div class="col-lg-12">
                <p class="text-blue fw-semibold mb-2">Nama Barang</p>
                <div class="rounded-1 border px-2 py-1" id="detail-namabarang">
                    <?= $pdmdata[0]['nama_barang']; ?>
                </div>
            </div>
            <div class="col-lg-12">
                <p class="text-blue fw-semibold mb-2">Instansi Penerbit SK</p>
                <div class="rounded-1 border px-2 py-1" id="detail-namabarang">
                    <?= $pdmdata[0]['instansi_sk']; ?>
                </div>
            </div>
            <!--  <div class="col-lg-5">
                <p class="text-blue fw-semibold mb-2">Nomor SK</p>
                <div class="rounded-1 border px-2 py-1" id="detail-nomorsk">
                    [ <small>Memuat Data. . . .</small> ]
                </div>
            </div>
            <div class="col-lg-3">
                <p class="text-blue fw-semibold mb-2">Tanggal SK</p>
                <div class="rounded-1 border px-2 py-1" id="detail-tanggalsk">
                    [ <small>Memuat Data. . . .</small> ]
                </div>
            </div>
            <div class="col-lg-4">
                <p class="text-blue fw-semibold mb-2">Instansi Penerbit SK</p>
                <div class="rounded-1 border px-2 py-1" id="detail-instansisk">
                    [ <small>Memuat Data. . . .</small> ]
                </div>
            </div> -->
            <div class="col-lg-4">
                <p class="text-blue fw-semibold mb-2">Digunakan Sesuai Tusi</p>
                <div class="rounded-1 border px-2 py-1" id="detail-sesuai">
                    <?= $pdmdata[0]['sesuai']; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="text-blue fw-semibold mb-2">Digunakan Tidak Sesuai Tusi (Idle)</p>
                <div class="rounded-1 border px-2 py-1" id="detail-tidaksesuai">
                    <?= $pdmdata[0]['tidak_sesuai']; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <p class="text-blue fw-semibold mb-2">Digunakan Pihak Lain</p>
                <div class="rounded-1 border px-2 py-1" id="detail-pihaklain">
                    <?= $pdmdata[0]['pihak_lain']; ?>
                </div>
            </div>
            <div class="col-lg-12">
                <p class="text-blue fw-semibold mb-2">Keterangan</p>
                <div class="rounded-1 border px-2 py-1" id="detail-keterangan">
                    <?= $pdmdata[0]['keterangan']; ?>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center align-items-center">
                <img id="theQR" src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= HOST_URL; ?>/data/<?= $category; ?>?uid=<?= $pdmdata[0]['uid']; ?>" alt="">
            </div>
        </div>
    </div>
    <p class="text-center text-muted mt-4 small">&copy; 2022 Institut Agama Islam Negeri Parepare</p>

</body>

</html>