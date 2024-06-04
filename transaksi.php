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

    <section class="m-4" style="padding-top: 5rem;">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn create-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah Transaksi
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">Transaksi Baru</h1>
                    </div>
                    <form action="form/post.php" method="post">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="book" class="form-label">Buku</label>
                                    <select class="form-select" aria-label="Default select example" name="book" required>
                                        <option value="" disabled selected>Pilih Buku</option>
                                        <?php
                                        $fileJson = file_get_contents('database/perpus.me.json');
                                        $data = json_decode($fileJson, true);
                                        $books = $data['books'];

                                        if (is_array($books)) {
                                            foreach ($books as $index => $value) {

                                        ?>
                                                <option value=<?= $value['bookCode'] ?>> <?= $value['year'] . " - " . $value['bookTitle'] ?> </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="member" class="form-label">Anggota</label>
                                    <select class="form-select" aria-label="Default select example" name="member" required>
                                        <option value="" disabled selected>Pilih Anggota</option>
                                        <?php
                                        $members = $data['members'];

                                        if (is_array($members)) {
                                            foreach ($members as $member => $value) {

                                        ?>
                                                <option value=<?= $value['email'] ?>> <?= $value['first_name'] . " " . $value['last_name'] . " [ " . $value['address'] . " ]" ?> </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="date" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header text-center" style="background-color: #0E46A3;">
                <h5 class="text-white">Transaksi Perpus.me</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php
                        $fileJson = file_get_contents('database/perpus.me.json');
                        $data = json_decode($fileJson, true);
                        $transactions = $data['transactions'];

                        if (is_array($transactions)) {
                            echo "<caption>" . "Total Transaksi: " . count($transactions) . " </caption>";
                        }
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Buku</th>
                                <th scope="col">Anggota</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($transactions)) {
                                foreach ($transactions as $transaction => $value) {
                            ?>
                                    <tr>
                                        <td scope="row"><?= $transaction + 1 ?></td>
                                        <td><?= $value['book'] ?></td>
                                        <td><?= $value['member'] ?></td>
                                        <td><?= $value['date'] ?></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-outline-info" type="button">Edit</button>
                                                <button class="btn btn-outline-danger" type="button" onclick="deleteTransaction('<?= $value['transaction_id'] ?>')">Hapus</button>
                                            </div>
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

    </section>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>