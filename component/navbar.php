<nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #00215E;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/jwd_2024/perpus.me/"><img src="/jwd_2024/perpus.me/assets/img/perpus.me.png" class="logo img-fluid" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] == '/jwd_2024/perpus.me/' ? 'active' : ''; ?>" href="/jwd_2024/perpus.me/">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo preg_match('/\/(books|members)\//', $_SERVER['REQUEST_URI']) ? 'active' : ''; ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Master Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/jwd_2024/perpus.me/books/">Data Buku</a></li>
                        <li><a class="dropdown-item" href="/jwd_2024/perpus.me/members/">Data Anggota</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/transactions/') !== false ? 'active' : ''; ?>" href="/jwd_2024/perpus.me/transactions/">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/reports/') !== false ? 'active' : ''; ?>" href="/jwd_2024/perpus.me/reports/">Laporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
