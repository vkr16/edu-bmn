<div class="bg-light text-dark d-flex justify-content-between align-items-center w-100 font-nunito" style="height: 62px">
    <span type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarPanelOffCanvas" aria-controls="sidebarPanelOffCanvas" class="text-decoration-none text-dark h2 m-0 ms-3 d-lg-none">
        <i class="fa-solid fa-bars"></i>
    </span>
    <div class="ms-auto me-4 dropdown-center ">
        <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" role="button">
            <i class="fa-solid fa-user-tie me-1"></i> <?= $session[0]['name'] . ' (' . $session[0]['email'] . ')'; ?>
        </span>
        <ul class="dropdown-menu bg-light mt-2 border-0">
            <li><a class="dropdown-item text-dark" role="button" data-bs-toggle="modal" data-bs-target="#account-setting-modal"><i class="fa-solid fa-user-gear"></i> &nbsp; Pengaturan Akun</a></li>
            <li><a class="dropdown-item text-dark" href="<?= HOST_URL ?>/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> &nbsp; Logout </a></li>
        </ul>
    </div>
</div>


<div class="modal fade" id="account-setting-modal" tabindex="-1" aria-labelledby="account-setting-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-1">
            <div class="modal-header">
                <h5 class="modal-title" id="account-setting-modalLabel">Pengaturan Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="account/update/email" method="POST">
                    <input type="text" hidden value="<?= $session[0]['id']; ?>" name="id">
                    <div class="mb-3">
                        <label for="changeEmail" class="form-label">Email</label>
                        <input required type="email" class="form-control" id="changeEmail" value="<?= $session[0]['email']; ?>" disabled name="email">
                    </div>
                    <span class="btn btn-primary rounded-1" id="a-editemail" onclick="triggersetting('a')"><i class="fa-solid fa-pen"></i> &nbsp; Edit</span>
                    <span class="btn btn-secondary rounded-1" id="b-editemail" onclick="triggersetting('b')" style="display: none"><i class="fa-solid fa-xmark"></i> &nbsp; Batal</span>
                    <button type="submit" id="submit-email" class="btn btn-primary rounded-1" style="display: none">Perbarui</button>
                </form>

                <br>
                <hr>
                <br>

                <div class="mb-3">
                    <label for="inputPasswordBaru" class="form-label">Password Baru</label>
                    <input required type="password" class="form-control" id="inputPasswordBaru" placeholder="Password Baru">
                </div>
                <div class="mb-3">
                    <label for="ulangPasswordBaru" class="form-label">Ulangi Password</label>
                    <input required type="password" class="form-control" id="ulangPasswordBaru" placeholder="Ulangi Password">
                </div>

                <button class="btn btn-primary" onclick="setNewPass()">Perbarui</button>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #347A4B !important;
    }
</style>

<script>
    function triggersetting(code) {
        if (code == 'a') {
            $('#a-editemail').hide()
            $('#b-editemail').show()
            $('#changeEmail').removeAttr('disabled')
            $('#submit-email').show()

        } else if (code == 'b') {
            $('#b-editemail').hide()
            $('#a-editemail').show()
            $('#changeEmail').val('<?= $session[0]['email']; ?>')
            $('#changeEmail').attr('disabled', 'disabled')
            $('#submit-email').hide()
        }
    }

    function setNewPass() {
        var a = $('#inputPasswordBaru').val()
        var b = $('#ulangPasswordBaru').val()

        if (a !== b) {
            $('#ulangPasswordBaru').addClass('is-invalid')
        } else {
            $('#ulangPasswordBaru').removeClass('is-invalid')
            Notiflix.Loading.dots('Memproses. . .');

            $.post("account/update/password", {
                    password: a,
                    id: <?= $session[0]['id']; ?>
                })
                .done(function(data) {
                    Notiflix.Loading.remove(1000);

                    setTimeout(function() {
                        if (data == "success") {
                            Notiflix.Notify.success('Password telah diperbarui')
                        } else if (data == "failed") {
                            Notiflix.Notify.failure('Terjadi kesalahan, gagal memperbarui data!')
                        }
                    }, 1500);

                    setTimeout(function() {
                        window.location.reload()
                    }, 2500);
                });
        }
    }
</script>