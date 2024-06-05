<?php
include 'database/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSGA - Perpus.me</title>

    <!-- Site Icon -->
    <link rel="icon" href="assets/img/perpus.me.ico" type="image/x-icon">

    <!-- Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- Custom Style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Top Navbar -->
    <?php
    include 'component/navbar.php';
    ?>


    <!-- Header-->
    <header style="background-color: #00215E; padding-top: 4.7rem;">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">Selamat Datang di Perpustakaan.me</h1>

                        <p class="lead text-white-50 mb-4">Temukan banyak koleksi digital yang dapat Anda akses kapan
                            saja dan di mana saja.</p>
                    </div>
                </div>
                <!-- <img src="assets/img/book.svg" style="width: 100%;" alt=""> -->
            </div>
        </div>

        <div class="position-relative custom-shape-divider-bottom-1717508694">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M1200,0H0V120H281.94C572.9,116.24,602.45,3.86,602.45,3.86h0S632,116.24,923,120h277Z" class="shape-fill"></path>
            </svg>
        </div>

    </header>

    <!-- List Books Section -->
    <section class="m-4">
        <h2 class="text-center pb-3">List Buku <span style="color: #FF6C22;">Perpus.me</span></h2>
        
        <div class="row">
            <?php
            $q1 = "SELECT * FROM books";
            $result = mysqli_query($conn, $q1);
            if ($result) {
                if ($result->num_rows > 0) {
                    while ($value = $result->fetch_assoc()) {
            ?>
                        <div class="col-sm-6 col-md-4 p-2">
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-6">
                                        <img src="assets/img/<?= $value['image'] ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $value['book_title'] ?></h5>
                                            <p class="card-text"><?= substr($value['description'], 0, 25) ?>...</p>
                                            <p class="card-text"><small class="text-muted">Author: <?= $value['author'] ?></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                }
            } else {
                echo "<p class='fs-5 text-center'>Data tidak ditemukan</p>";
            }
            ?>

        </div>
        
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>