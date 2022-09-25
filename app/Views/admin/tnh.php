<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tanah</title>
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
                        <h3>Manajemen Data Tanah</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Admin</li>
                                <li class="breadcrumb-item">Manajemen Data</li>
                                <li class="breadcrumb-item active" aria-current="page">Tanah</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="card rounded-1 bg-light border-0" hidden>
                        <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center rounded-1">
                            <p class=" fs-6 mb-0"><i class="fa-solid fa-toolbox"></i>&nbsp; Data Tanah</p>
                            <span>
                                <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#data-upload-modal"><i class="fa-solid fa-upload"></i>&nbsp; Upload Data</button>
                            </span>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="tabel-tnh" class="table">
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
                                    foreach ($tnhdata as $key => $tnh) {
                                    ?>
                                        <tr>
                                            <td><?= $key + 1; ?></td>
                                            <td><?= $tnh['kode_barang']; ?></td>
                                            <td><?= $tnh['nup']; ?></td>
                                            <td><?= $tnh['nama_barang']; ?></td>
                                            <td><?= $tnh['kuantitas']; ?></td>
                                            <td hidden><?= $tnh['perolehan']; ?></td>
                                            <td><?= $tnh['no_sk']; ?></td>
                                            <td hidden><?= $tnh['tanggal_sk']; ?></td>
                                            <td hidden><?= $tnh['instansi_sk']; ?></td>
                                            <td hidden><?= $tnh['sesuai']; ?></td>
                                            <td hidden><?= $tnh['tidak_sesuai']; ?></td>
                                            <td hidden><?= $tnh['pihak_lain']; ?></td>
                                            <td><?= $tnh['keterangan']; ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-blue" style="white-space: nowrap;" onclick="tnhdetail(<?= $tnh['id']; ?>)"><i class=" fa-solid fa-circle-info"></i>&nbsp; Detail</button>
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

    <div class="modal fade" id="tnh-detail-modal" tabindex="-1" aria-labelledby="tnh-detail-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-1">
                <div class="modal-header">
                    <h5 class="modal-title" id="tnh-detail-modalLabel">UID : <span id="detail-uid">[ <small>Memuat Data. . . .</small> ]</span> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="tnh-detail-body">
                    <div class="d-flex justify-content-start">
                        <span class="fs-4 fw-bold mb-2">Detail Informasi</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <p class="text-blue fw-semibold mb-2">Kode Barang</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-kodebarang">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <p class="text-blue fw-semibold mb-2">NUP</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-nup">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <p class="text-blue fw-semibold mb-2">Kuantitas </p>
                            <div class="rounded-1 border px-2 py-1" id="detail-kuantitas">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <p class="text-blue fw-semibold mb-2">Nama Barang</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-namabarang">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <p class="text-blue fw-semibold mb-2">Nilai Perolehan</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-nilaiperolehan">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-5">
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
                        </div>
                        <div class="col-lg-4">
                            <p class="text-blue fw-semibold mb-2">Sesuai Tusi</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-sesuai">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="text-blue fw-semibold mb-2">Tidak Sesuai Tusi (Idle)</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-tidaksesuai">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <p class="text-blue fw-semibold mb-2">Digunakan Pihak Lain</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-pihaklain">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <p class="text-blue fw-semibold mb-2">Keterangan</p>
                            <div class="rounded-1 border px-2 py-1" id="detail-keterangan">
                                [ <small>Memuat Data. . . .</small> ]
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-start align-items-center">
                            <img id="theQR" src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= HOST_URL ?>" alt="">
                            <button class="btn btn-blue rounded-1" id="qrdownload"><i class="fa-solid fa-qrcode"></i> &nbsp; Download QR Code</button>
                        </div>
                    </div>
                    <p class="text-blue fw-semibold mb-2">Perubahan terakhir pada <span id="detail-lastedited">[ <small>Memuat Data. . . .</small> ]</span> oleh <span id="detail-lasteditor">[ <small>Memuat Data. . . .</small> ]</span></p>
                    <hr>
                    <div class="d-flex justify-content-start gap-3">
                        <button class="btn btn-danger rounded-1" id="tnhdata-delete-btn"><i class="fa-solid fa-trash-can"></i>&nbsp; Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('admin/components/scripts'); ?>
    <script src="<?= ASSETS_URL ?>/js/dom-to-image/src/dom-to-image.js"></script>
    <script>
        // Activate the sidebar item
        $('#sidebar-item-tnh').addClass('sidebar-active').removeClass('sidebar-item');
        $('#sidebar-item-userman').addClass('sidebar-item').removeClass('sidebar-active');
        $('#management-collapse').addClass('show');
        $('#management-collapse-toggle').attr('aria-expanded', 'true');

        $(document).ready(function() {
            var t = $('#tabel-tnh').DataTable({
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
        });

        function tnhdetail(id) {
            Notiflix.Block.dots('#tnh-detail-body', 'Memuat Data');
            $('#tnh-detail-modal').modal('show')

            $.post("peralatan-dan-mesin/detail", {
                    id: id
                })
                .done(function(data) {
                    Notiflix.Block.remove('#tnh-detail-body', 500);
                    console.log(data)
                    const tnhdetail = JSON.parse(data)
                    $('#detail-uid').html(tnhdetail.uid)
                    $('#detail-kodebarang').html(tnhdetail.kode_barang)
                    $('#detail-nup').html(tnhdetail.nup)
                    $('#detail-kuantitas').html(tnhdetail.kuantitas)
                    $('#detail-namabarang').html(tnhdetail.nama_barang)
                    $('#detail-nilaiperolehan').html(tnhdetail.perolehan)
                    $('#detail-nomorsk').html(tnhdetail.no_sk)
                    $('#detail-tanggalsk').html(tnhdetail.tanggal_sk)
                    $('#detail-instansisk').html(tnhdetail.instansi_sk)
                    $('#detail-sesuai').html(tnhdetail.sesuai)
                    $('#detail-tidaksesuai').html(tnhdetail.tidak_sesuai)
                    $('#detail-pihaklain').html(tnhdetail.pihak_lain)
                    $('#detail-keterangan').html(tnhdetail.keterangan)
                    $('#detail-lastedited').html(tnhdetail.last_update)
                    $('#detail-lasteditor').html(tnhdetail.last_editor)

                    // QR LINK TO EDIT
                    $('#theQR').attr('src', 'https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=<?= HOST_URL ?>/data/tnh?uid=' + tnhdetail.uid)

                    $('#qrdownload').attr('onclick', 'downloadqr(' + tnhdetail.uid + ')')
                    $('#tnhdata-delete-btn').attr('onclick', 'deletetnhdata(' + tnhdetail.id + ',' + tnhdetail.uid + ')')
                });
        }

        function deletetnhdata(id, uid) {
            Notiflix.Confirm.show(
                'Hapus Data',
                'Anda yakin ingin menghapus data dengan uid ' + uid + '?',
                'Yes',
                'No',
                function okCb() {
                    Notiflix.Loading.dots('Memproses. . .');
                    $.post("peralatan-dan-mesin/delete", {
                            id: id
                        })
                        .done(function(data) {
                            Notiflix.Loading.remove(1000);

                            setTimeout(function() {
                                if (data == "deleted") {
                                    Notiflix.Notify.success('Data berhasil dihapus!')
                                } else if (data == "failed") {
                                    Notiflix.Notify.failure('Terjadi kesalahan, data gagal dihapus!')
                                } else if (data == "not found") {
                                    Notiflix.Notify.warning('Data tidak ditemukan!')
                                }
                            }, 1500);

                            setTimeout(function() {
                                window.location.reload()
                            }, 2500);
                        });
                },
                function cancelCb() {}, {},
            );
        }

        function downloadqr(uid) {
            domtoimage.toPng(document.getElementById('theQR'), {
                    quality: 0.95
                })
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = uid + '.png';
                    link.href = dataUrl;
                    link.click();
                });
        }

        <?php
        if (isset($_COOKIE['updateemail'])) {
            if ($_COOKIE['updateemail'] == 'success') {
                echo "Notiflix.Notify.success('Email berhasil di perbarui!')";
            } elseif ($_COOKIE['updateemail'] == 'failed') {
                echo "Notiflix.Notify.failure('Terjadi kesalahan, Email gagal di perbarui!')";
            } elseif ($_COOKIE['updateemail'] == 'conflict') {
                echo "Notiflix.Notify.warning('Email sudah terdaftar pada akun pengguna lain!')";
            }
        }
        if (isset($_COOKIE['uploaddata'])) {
            if ($_COOKIE['uploaddata'] == 'success') {
                echo "Notiflix.Notify.success('Data berhasil di upload')";
            } elseif ($_COOKIE['uploaddata'] == 'unsupported') {
                echo "Notiflix.Notify.failure('Jenis file tidak didukung')";
            }
        }
        ?>
    </script>

</body>

</html>