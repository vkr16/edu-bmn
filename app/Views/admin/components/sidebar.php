<section id="sidebar-section" class="font-nunito">
    <div class="offcanvas-lg offcanvas-start custom-sidebar bg-light text-dark" data-bs-scroll="true" tabindex="-1" id="sidebarPanelOffCanvas" aria-labelledby="sidebarPanelOffCanvasLabel" style=" min-width: 300px;width: 300px;max-width: 300px;">
        <div class="custom-sidebar bg-light text-dark vh-100 scrollable-y hide-scrollbar px-2">
            <a href="#home" class="pt-3 container-fluid d-flex gap-2 align-items-center sticky-top  text-dark border-bottom border-light border-opacity-25 text-decoration-none" id="sidebar-header">
                <img src="<?= IMAGES_URL ?>/sidebar-logo.png" alt="" class="w-100 mx-auto">
            </a>
            <hr class="mx-2 mb-3 mt-0" style="border-color: #235791">
            <ul class="list-unstyled m-0 p-0">
                <li>
                    <a href="<?= HOST_URL ?>/admin/" class="mb-2 px-3 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-active text-decoration-none" id="sidebar-item-dashboard">
                        <div class=" m-0"> <i class="fa-solid fa-users-cog fa-fw"></i> &nbsp; Manajemen Pengguna</div>
                    </a>
                </li>
                <li>
                    <a href="#management-collapse" class="mb-2 px-3 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item btn-toggle collapsed justify-content-between text-decoration-none" data-bs-toggle="collapse" aria-expanded="false" id="management-collapse-toggle">
                        <div class=" m-0"> <i class="fa-solid fa-clipboard fa-fw"></i> &nbsp; Manajemen Data</div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                    <div class="collapse" id="management-collapse">
                        <ul class="btn-toggle-nav list-unstyled">
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-toolbox fa-fw"></i> &nbsp; Peralatan & Mesin</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-flag fa-fw"></i> &nbsp; Tanah</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-building fa-fw"></i> &nbsp; Gedung & Bangunan</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-road fa-fw"></i> &nbsp; Jalan, Irigasi & jaringan</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-thumbtack fa-fw"></i> &nbsp; Aset Tetap Lainnya</div>
                                </a>
                            </li>
                            <li>
                                <a href="<?= HOST_URL ?>/admin/pos" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-pos">
                                    <div class=" m-0"> <i class="fa-solid fa-person-digging fa-fw"></i> &nbsp; Konstruksi Dalam Pengerjaan </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<style>
    .btn-toggle[aria-expanded="true"]>i {
        transform: rotate(90deg);
    }

    .sidebar-item:hover {
        background-color: rgba(209, 166, 31, 0.1) !important;
    }

    .sidebar-active {
        background-color: rgba(14, 97, 41, 1);
        color: #f8f9fa !important;
    }
</style>