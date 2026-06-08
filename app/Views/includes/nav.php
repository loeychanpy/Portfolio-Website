<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-lg">
        <div class="navbar-brand d-flex align-items-center gap-3">
            <div>
                <div class="brand-name">Janisha Jaya</div>
                <div class="brand-title">Informatics Student</div>
            </div>
        </div>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-2">
                
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'home' ? 'active' : '' ?>" href="<?= $base_url ?>home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'about' ? 'active' : '' ?>" href="<?= $base_url ?>about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'projects' ? 'active' : '' ?>" href="<?= $base_url ?>projects">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'news' ? 'active' : '' ?>" href="<?= $base_url ?>news">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'gallery' ? 'active' : '' ?>" href="<?= $base_url ?>gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'contact' ? 'active' : '' ?>" href="<?= $base_url ?>contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'credit' ? 'active' : '' ?>" href="<?= $base_url ?>credit">Credits</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-sm  rounded-pill px-3" href="<?= $base_url ?>administrator/login">Login</a>
                </li>

                <li class="nav-item ms-lg-2" d-flex align-items-center>
                    <button id="theme-toggle" a class="btn px-3 d-flex align-items-center gap-2" nav-link>
                        <i class="bi bi-moon-fill"></i> 
                   </button>
                </li>
            </ul>
        </div>
    </div>
</nav>