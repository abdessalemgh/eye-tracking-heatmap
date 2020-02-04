<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.php"><img src="templates/assets/images/icon/eye_logo.png" alt="eye tracker"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="<?php if ($action == 'dashboard') echo "active" ?>">
                        <a href="index.php"><i class="ti-map-alt"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="<?php if ($action == 'users') echo "active" ?>">
                        <a href="index.php?action=users"><i class="ti-user"></i> <span>Sujets</span></a>
                    </li>
                    <li class="<?php if ($action == 'images') echo "active" ?>">
                        <a href="index.php?action=images"><i class="ti-receipt"></i> <span>Images</span></a>
                    </li>
                    <li class="<?php if ($action == 'tests') echo "active" ?>">
                        <a href="index.php?action=test"><i class="ti-receipt"></i> <span>Test</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>