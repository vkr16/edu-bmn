<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
                        <h3>Manajemen Pengguna</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Admin</li>
                                <li class="breadcrumb-item active" aria-current="page">Manajemen Pengguna</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="card rounded-1 bg-light border-0">
                        <div class="card-header bg-blue text-white d-flex justify-content-between align-items-center rounded-1">
                            <p class=" fs-6 mb-0"><i class="fa-solid fa-users-cog"></i>&nbsp; Manajemen Pengguna</p>
                            <span>
                                <button class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#add-user-modal"><i class="fa-solid fa-user-plus"></i>&nbsp; Tambah Pengguna</button>
                            </span>
                        </div>
                        <div class="card-body">
                            <table id="tabel-user" class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Hak Akses / Role</th>
                                    <th>Opsi</th>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($users as $key => $user) {
                                        if ($user['email'] != $_SESSION['dbmn_user_session']) {
                                    ?>
                                            <tr>
                                                <td></td>
                                                <td><?= $user['name']; ?></td>
                                                <td><?= $user['email']; ?></td>
                                                <td><?= $user['role']; ?></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm rounded-1 mb-1" onclick="edituser(<?= $user['id']; ?>,'<?= $user['name']; ?>','<?= $user['email']; ?>','<?= $user['role']; ?>')">
                                                        <i class="fa-solid fa-user-pen"></i>
                                                        &nbsp; Edit
                                                    </button>

                                                    <button class="btn btn-success btn-sm rounded-1 mb-1" onclick="resetpass(<?= $user['id']; ?>,'<?= $user['email']; ?>')">
                                                        <i class="fa-solid fa-unlock"></i>
                                                        &nbsp; Reset Password
                                                    </button>

                                                    <button class="btn btn-danger btn-sm rounded-1 mb-1" onclick="deleteuser(<?= $user['id']; ?>,'<?= $user['name']; ?>')"><i class="fa-solid fa-user-xmark"></i>&nbsp; Hapus</button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>

    <div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="add-user-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-2">
                <form action="user-management/add" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-user-modalLabel">Tambah Akun Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Nama Lengkap</label>
                            <input required type="text" class="form-control rounded-1" id="inputName" placeholder="Nama Lengkap" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input required type="email" class="form-control rounded-1" id="inputEmail" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input required type="password" class="form-control rounded-1" id="inputPassword" placeholder="Password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="selectRole" class="form-label">Hak Akses Pengguna / Role</label>
                            <select class="form-select rounded-1" id="selectRole" required name="role">
                                <option value="">Pilih Hak Akses</option>
                                <option value="admin">Admin</option>
                                <option value="pdb">Peralatan dan Mesin</option>
                                <option value="tnh">Tanah</option>
                                <option value="gdb">Gedung dan Bangunan</option>
                                <option value="jij">Jalan, Irigasi, dan Jaringan</option>
                                <option value="atl">Aset Tetap Lainnya</option>
                                <option value="kdp">Konstruksi Dalam Pengerjaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a role="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-1">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-user-modal" tabindex="-1" aria-labelledby="edit-user-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="user-management/update" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit-user-modalLabel">Edit Data Pengguna </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="hiddenIdUpdate" hidden>
                        <input type="text" name="oldmail" id="hiddenEmailUpdate" hidden>
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Nama Lengkap</label>
                            <input required type="text" class="form-control rounded-1" id="inputNameUpdate" placeholder="Nama Lengkap" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input required type="email" class="form-control rounded-1" id="inputEmailUpdate" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="selectRole" class="form-label">Hak Akses Pengguna / Role</label>
                            <select class="form-select rounded-1" id="selectRoleUpdate" required name="role">
                                <option value="">Pilih Hak Akses</option>
                                <option value="admin">Admin</option>
                                <option value="pdm">Peralatan dan Mesin</option>
                                <option value="tnh">Tanah</option>
                                <option value="gdb">Gedung dan Bangunan</option>
                                <option value="jij">Jalan, Irigasi, dan Jaringan</option>
                                <option value="atl">Aset Tetap Lainnya</option>
                                <option value="kdp">Konstruksi Dalam Pengerjaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a role="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-1">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reset-password-modal" tabindex="-1" aria-labelledby="reset-password-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="user-management/reset-password" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reset-password-modalLabel">Reset Password Pengguna </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="hiddenIdReset" hidden>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input readonly disabled required type="email" class="form-control rounded-1" id="inputEmailReset" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="inputPasswordReset" class="form-label">Password Baru</label>
                            <input required type="password" class="form-control rounded-1" id="inputPasswordReset" placeholder="Password Baru" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a role="button" class="btn btn-secondary rounded-1" data-bs-dismiss="modal">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-1">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?= $this->include('admin/components/scripts'); ?>
    <script>
        $(document).ready(function() {
            var t = $('#tabel-user').DataTable({
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

        function deleteuser(id, name) {
            Notiflix.Confirm.show(
                'Hapus Pengguna',
                'Anda yakin ingin menghapus akun pengguna <strong>' + name + '</strong>?',
                'Ya',
                'Batal',
                () => {
                    Notiflix.Loading.dots('Memproses. . .');
                    $.post("user-management/delete", {
                            id: id
                        })
                        .done(function(data) {
                            Notiflix.Loading.remove(1000);

                            setTimeout(function() {
                                if (data == "deleted") {
                                    Notiflix.Notify.success('Pengguna berhasil di hapus!')
                                } else if (data == "failed") {
                                    Notiflix.Notify.failure('Terjadi kesalahan, Pengguna gagal di hapus!')
                                } else if (data == "not found") {
                                    Notiflix.Notify.warning('Pengguna tidak ditemukan!')
                                }
                            }, 1500);

                            setTimeout(function() {
                                window.location.reload()
                            }, 2500);
                        });
                },
                () => {}, {},
            );
        }

        function edituser(id, name, email, role) {
            $('#edit-user-modal').modal('show')
            $('#hiddenIdUpdate').val(id)
            $('#inputNameUpdate').val(name)
            $('#inputEmailUpdate').val(email)
            $('#hiddenEmailUpdate').val(email)
            $('#selectRoleUpdate').val(role).change()
        }

        function resetpass(id, email) {
            $('#reset-password-modal').modal('show')
            $('#hiddenIdReset').val(id)
            $('#inputEmailReset').val(email)


        }

        <?php
        if (isset($_COOKIE['adduser'])) {
            if ($_COOKIE['adduser'] == 'success') {
                echo "Notiflix.Notify.success('Pengguna berhasil di daftarkan!')";
            } elseif ($_COOKIE['adduser'] == 'failed') {
                echo "Notiflix.Notify.failure('Terjadi kesalahan, Pengguna gagal di daftarkan!')";
            } elseif ($_COOKIE['adduser'] == 'conflict') {
                echo "Notiflix.Notify.warning('Email sudah terdaftar pada akun pengguna lain!')";
            }
        }

        if (isset($_COOKIE['edituser'])) {
            if ($_COOKIE['edituser'] == 'updated') {
                echo "Notiflix.Notify.success('Data pengguna berhasil di perbarui!')";
            } elseif ($_COOKIE['edituser'] == 'failed') {
                echo "Notiflix.Notify.failure('Terjadi kesalahan, data pengguna gagal di perbarui!')";
            } elseif ($_COOKIE['edituser'] == 'conflict') {
                echo "Notiflix.Notify.warning('Email sudah terdaftar pada akun pengguna lain!')";
            }
        }

        if (isset($_COOKIE['reset'])) {
            if ($_COOKIE['reset'] == 'done') {
                echo "Notiflix.Notify.success('Password pengguna berhasil di atur ulang!')";
            } elseif ($_COOKIE['reset'] == 'failed') {
                echo "Notiflix.Notify.failure('Terjadi kesalahan, gagal mengatur ulang password pengguna!')";
            }
        }
        if (isset($_COOKIE['updateemail'])) {
            if ($_COOKIE['updateemail'] == 'success') {
                echo "Notiflix.Notify.success('Email berhasil di perbarui!')";
            } elseif ($_COOKIE['updateemail'] == 'failed') {
                echo "Notiflix.Notify.failure('Terjadi kesalahan, Email gagal di perbarui!')";
            } elseif ($_COOKIE['updateemail'] == 'conflict') {
                echo "Notiflix.Notify.warning('Email sudah terdaftar pada akun pengguna lain!')";
            }
        }
        ?>
    </script>
</body>

</html>