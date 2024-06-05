<?php
include '../utils/dateIndo.php';
include '../database/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSGA - Perpus.me</title>

    <!-- Site Icon -->
    <link rel="icon" href="../assets/img/perpus.me.ico" type="image/x-icon">

    <!-- Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Style -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- Top Navbar -->
    <?php
    include '../component/navbar.php';
    ?>

    <section class="m-4" style="padding-top: 5rem;">
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" id="addTransactionButton" class="btn create-btn" data-bs-toggle="modal" data-bs-target="#myModal">
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
                    <form id="transactionForm" action="post.php" method="post">
                        <div class="modal-body">
                            <div class="row g-3">
                                <input type="hidden" name="transaction_id" id="transaction_id">
                                <div class="col-md-12">
                                    <label for="book" class="form-label">Buku</label>
                                    <select class="form-select" aria-label="Default select example" name="book" id="book" required>
                                        <option value="" disabled selected>Pilih Buku</option>
                                        <?php
                                        $q1 = "SELECT * FROM books";
                                        $books = mysqli_query($conn, $q1);


                                        if (mysqli_num_rows($books) > 0) {
                                            foreach ($books as $book => $value) {

                                        ?>
                                                <option value=<?= $value['book_id'] ?>> <?= $value['year'] . " - " . $value['book_title'] ?> </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="member" class="form-label">Anggota</label>
                                    <select class="form-select" aria-label="Default select example" name="member" id="member" required>
                                        <option value="" disabled selected>Pilih Anggota</option>
                                        <?php
                                        $q2 = "SELECT * FROM members";
                                        $members = mysqli_query($conn, $q2);

                                        if (mysqli_num_rows($members) > 0) {
                                            foreach ($members as $member => $value) {

                                        ?>
                                                <option value=<?= $value['member_id'] ?>> <?= $value['first_name'] . " " . $value['last_name'] . " - [ " . $value['address'] . " ]" ?> </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="issue_date" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="return_date" class="form-label">Tanggal Kembali</label>
                                    <input type="date" class="form-control" id="return_date" name="return_date" required>
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

                        $q3 = "SELECT * FROM transactions";
                        $transactions = mysqli_query($conn, $q3);

                        if (mysqli_num_rows($transactions) > 0) {
                            $rowCount = mysqli_num_rows($transactions);
                            echo "<caption>" . "Total Transaksi: " . $rowCount . " </caption>";
                        ?>
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Buku</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Email Anggota</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $bookCode = '';
                                $memberName = '';
                                $memberEmail = '';

                                foreach ($transactions as $transaction => $tvalue) {
                                ?>
                                    <?php foreach ($books as $book => $bvalue) {
                                        if ($tvalue['book_id'] == $bvalue['book_id']) {
                                            $bookCode = $bvalue['book_code'];
                                        }
                                    } ?>

                                    <?php foreach ($members as $member => $mvalue) {
                                        if ($tvalue['member_id'] == $mvalue['member_id']) {
                                            $memberName = $mvalue['first_name'] . " " . $mvalue['last_name'];
                                            $memberEmail = $mvalue['email'];
                                        }
                                    } ?>
                                    <tr>
                                        <td scope="row"><?= $transaction + 1 ?></td>
                                        <td><?= $bookCode ?></td>
                                        <td><?= $memberName ?></td>
                                        <td><?= $memberEmail ?></td>
                                        <td><?= tgl_indo($tvalue['issue_date']) ?></td>
                                        <td><?= tgl_indo($tvalue['return_date']) ?></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-outline-info edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal" data-transaction='<?= json_encode($tvalue) ?>'>Edit</button>
                                                <button class="btn btn-outline-danger" type="button" onclick="deleteTransaction('<?= $tvalue['transaction_id'] ?>')">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<caption>" . "Total Transaksi: 0 </caption>";
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
    <script src="../assets/js/script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            const modalTitle = document.getElementById('myModalLabel');
            const transactionForm = document.getElementById('transactionForm');

            const addTransactionButton = document.getElementById('addTransactionButton');
            addTransactionButton.addEventListener('click', () => {
                modalTitle.textContent = 'Tambah Transaksi Baru';
                transactionForm.reset();
                transactionForm.action = 'post.php';
            });

            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const transaction = JSON.parse(button.getAttribute('data-transaction'));
                    modalTitle.textContent = 'Edit Data Transaksi';
                    transactionForm.action = '../transactions/update.php';

                    document.getElementById('transaction_id').value = transaction.transaction_id;
                    document.getElementById('book').value = transaction.book_id;
                    document.getElementById('member').value = transaction.member_id;
                    document.getElementById('issue_date').value = transaction.issue_date;
                    document.getElementById('return_date').value = transaction.return_date;
                });
            });
        });
    </script>
</body>

</html>