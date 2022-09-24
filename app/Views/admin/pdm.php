<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peralatan Dan Mesin</title>
    <?= $this->include('admin/components/links'); ?>
</head>

<body class="font-nunito">
    <div class="d-flex">
        <?= $this->include('admin/components/sidebar'); ?>
        <section class="vh-100 w-100 scrollable-y">
            <?= $this->include('admin/components/topbar'); ?>
            <div class="w-100 mb-5 pb-5 mt-4">
                <div class="container-lg px-4">
                    <!-- main content here-->
                    <div id="breadcrumb" class="mb-3">
                        <h3>Manajemen Data Peralatan Dan Mesin</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Admin</li>
                                <li class="breadcrumb-item">Manajemen Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Peralatan Dan Mesin</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="card rounded-1 bg-light border-0">
                        <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center rounded-1">
                            <p class=" fs-6 mb-0"><i class="fa-solid fa-toolbox"></i>&nbsp; Data Peralatan Dan Mesin</p>
                            <span>
                                <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#data-upload-modal"><i class="fa-solid fa-upload"></i>&nbsp; Upload Data</button>
                            </span>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="tabel-pdm" class="table">
                                <thead>
                                    <th style="white-space: nowrap;">No</th>
                                    <th style="white-space: nowrap;">Kode Barang</th>
                                    <th style="white-space: nowrap;">NUP</th>
                                    <th style="white-space: nowrap;">Nama/Jenis Barang</th>
                                    <th style="white-space: nowrap;">Kuantitas<br>(m2 /unit)</th>
                                    <th style="white-space: nowrap;" hidden>Nilai Perolehan (Rp)</th>
                                    <th style="white-space: nowrap;">Nomor SK</th>
                                    <th style="white-space: nowrap;" hidden>Tanggal SK</th>
                                    <th style="white-space: nowrap;" hidden>Instansi Penerbit SK</th>
                                    <th style="white-space: nowrap;" hidden>Dipergunakan Sesuai Tusi</th>
                                    <th style="white-space: nowrap;" hidden>Dipergunakan Tidak Sesuai Tusi (Idle)</th>
                                    <th style="white-space: nowrap;" hidden>Digunakan Pihak Lain</th>
                                    <th style="white-space: nowrap;">Keterangan</th>
                                    <th style="white-space: nowrap;">Opsi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($pdmdata as $key => $pdm) {
                                    ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $pdm['kode_barang']; ?></td>
                                            <td><?= $pdm['nup']; ?></td>
                                            <td><?= $pdm['nama_barang']; ?></td>
                                            <td><?= $pdm['kuantitas']; ?></td>
                                            <td hidden><?= $pdm['perolehan']; ?></td>
                                            <td><?= $pdm['no_sk']; ?></td>
                                            <td hidden><?= $pdm['tanggal_sk']; ?></td>
                                            <td hidden><?= $pdm['instansi_sk']; ?></td>
                                            <td hidden><?= $pdm['sesuai']; ?></td>
                                            <td hidden><?= $pdm['tidak_sesuai']; ?></td>
                                            <td hidden><?= $pdm['pihak_lain']; ?></td>
                                            <td><?= $pdm['keterangan']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-blue" style="white-space: nowrap;" onclick="pdmdetail(<?= $pdm['id']; ?>)"><i class=" fa-solid fa-circle-info"></i>&nbsp; Detail</button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="data-upload-modal" tabindex="-1" aria-labelledby="data-upload-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-1">
                <div class="modal-header">
                    <h5 class="modal-title" id="data-upload-modalLabel">Upload Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="peralatan-dan-mesin/upload" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload File CSV</label>
                            <input class="form-control" type="file" id="formFile" name="file">
                        </div>
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-blue"><i class="fa-solid fa-upload"></i>&nbsp; Upload</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pdm-detail-modal" tabindex="-1" aria-labelledby="pdm-detail-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-1">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdm-detail-modalLabel">UID : 30201010011 </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="pdm-detail-body">
                    <div class="d-flex justify-content-start">
                        <span class="fs-4 fw-bold mb-2">Detail Informasi</span>
                    </div>
                    <dl class="row">
                        <dt class="col-sm-3">Kode Barang</dt>
                        <dd class="col-sm-9">3.02.01.01.001</dd>

                        <dt class="col-sm-3">NUP</dt>
                        <dd class="col-sm-9">1</dd>

                        <dt class="col-sm-3">Kuantitas (m<sup>2</sup> / unit)</dt>
                        <dd class="col-sm-9">1</dd>

                        <dt class="col-sm-3">Nama / Jenis Barang</dt>
                        <dd class="col-sm-9">Mini Bus (Penumpang 14 Orang Kebawah)</dd>

                        <dt class="col-sm-3">Nilai Perolehan (Rp)</dt>
                        <dd class="col-sm-9">Rp 393,775,000</dd>

                        <dt class="col-sm-3">Nomor SK</dt>
                        <dd class="col-sm-9">55/KM.6/WKN.15/KNL.03/2017</dd>

                        <dt class="col-sm-3">Tanggal SK</dt>
                        <dd class="col-sm-9">13/02/2018</dd>

                        <dt class="col-sm-3">Instansi Penerbit SK</dt>
                        <dd class="col-sm-9">Fake Instance For Dummy Data</dd>

                        <dt class="col-sm-3">Digunakan Sesuai Tusi</dt>
                        <dd class="col-sm-9">Ya</dd>

                        <dt class="col-sm-3">Digunakan Tidak Sesuai Tusi</dt>
                        <dd class="col-sm-9">-</dd>

                        <dt class="col-sm-3">Digunakan Pihak Lain</dt>
                        <dd class="col-sm-9">-</dd>

                    </dl>
                    <div class="text-center">
                        <img id="theQR" src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=https://demo.akuonline.my.id/pdm?uid=30201010011" alt=""><br>

                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <?= $this->include('admin/components/scripts'); ?>
    <script src="<?= ASSETS_URL ?>/js/dom-to-image/src/dom-to-image.js"></script>
    <script>
        // Activate the sidebar item
        $('#sidebar-item-pdm').addClass('sidebar-active').removeClass('sidebar-item');
        $('#sidebar-item-userman').addClass('sidebar-item').removeClass('sidebar-active');
        $('#management-collapse').addClass('show');
        $('#management-collapse-toggle').attr('aria-expanded', 'true');

        $(document).ready(function() {
            var t = $('#tabel-pdm').DataTable({
                "ordering": false,
                "language": {
                    "search": "Cari : ",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang cocok ditemukan.",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Data tidak tersedia",
                    "infoFiltered": "(Difilter dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": '<i class="fa-solid fa-angle-right"></i>',
                        "previous": '<i class="fa-solid fa-angle-left"></i>'
                    },
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": 0,
                }, ],
            });

            t.on('order.dt search.dt', function() {
                let i = 1;

                t.cells(null, 0, {
                    search: 'applied',
                    order: 'applied'
                }).every(function(cell) {
                    this.data(i++);
                });
            }).draw();

            $('#pdm-detail-modal').modal('show')
        });

        function pdmdetail(id) {
            Notiflix.Block.dots('#pdm-detail-body', 'Memuat Data');
            $('#pdm-detail-modal').modal('show')

            $.post("peralatan-dan-mesin/detail", {
                    id: id
                })
                .done(function(data) {
                    Notiflix.Block.remove('#pdm-detail-body', 500);
                    console.log(data)
                });
        }

        function downloadqr() {
            domtoimage.toPng(document.getElementById('theQR'), {
                    quality: 0.95
                })
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = 'qrCode.png';
                    link.href = dataUrl;
                    link.click();
                });
        }
    </script>

</body>

</html>