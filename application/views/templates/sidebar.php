    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
            <div class="sidebar-brand-icon">
                <i class="fas fa-leaf"></i>
            </div>
            <div class="sidebar-brand-text mx-3">ABSENSI</div>
        </a>


        <!-- Query Menu -->
        <?php foreach ($menu as $mn) : ?>
            <hr class="sidebar-divider mt-3">
            <div class="sidebar-heading">
                <?= $mn['menu']; ?>
            </div>

            <?php
            $menuId = $mn['id'];
            $subMenus = $submenus[$menuId];
            foreach ($subMenus as $sm) :
            ?>
                <li class="nav-item <?= ($title == $sm['title']) ? 'active' : ''; ?>">
                    <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endforeach; ?>


        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->