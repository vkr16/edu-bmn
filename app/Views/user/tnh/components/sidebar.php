<section id="sidebar-section" class="font-nunito">
    <div class="offcanvas-lg offcanvas-start custom-sidebar bg-light text-dark" data-bs-scroll="true" tabindex="-1" id="sidebarPanelOffCanvas" aria-labelledby="sidebarPanelOffCanvasLabel" style=" min-width: 300px;width: 300px;max-width: 300px;">
        <div class="custom-sidebar bg-light text-dark vh-100 scrollable-y hide-scrollbar px-2">
            <a href="#home" class="pt-3 container-fluid d-flex gap-2 align-items-center sticky-top  text-dark border-bottom border-light border-opacity-25 text-decoration-none" id="sidebar-header">
                <img src="<?= IMAGES_URL ?>/sidebar-logo.png" alt="" class="w-100 mx-auto">
            </a>
            <hr class="mx-2 mb-3 mt-0" style="border-color: #235791">
            <ul class="list-unstyled m-0 p-0">
                <li>
                    <a href="<?= HOST_URL ?>/tnh/data/tanah" class="mb-2 ps-4 ms-1 py-2 rounded-1 container-fluid d-flex gap-2 align-items-center sticky-top text-dark sidebar-item  text-decoration-none" id="sidebar-item-tnh">
                        <div class=" m-0"><i class="fa-solid fa-flag fa-fw"></i> &nbsp; Tanah</div>
                    </a>
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