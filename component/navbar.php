<nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #00215E;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="assets/img/perpus.me.png" class="logo img-fluid" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), array('master_buku.php', 'master_anggota.php')) ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Master Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="master_buku.php">Data Buku</a></li>
                        <li><a class="dropdown-item" href="master_anggota.php">Data Anggota</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'active' : ''; ?>" href="transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>" href="laporan.php">Laporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>