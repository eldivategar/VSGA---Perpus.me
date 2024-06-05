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
            <button type="submit" class="btn btn-labeled btn-outline-success" onclick="window.location='export.php'">
                <span class="btn-label"><i class="fa fa-print"></i></span>
                 | Cetak
            </button>
        </div>

        <div class="card mt-4">
            <div class="card-header text-center" style="background-color: #0E46A3;">
                <h5 class="text-white">Laporan Perpus.me</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php
                        $q1 = "SELECT * FROM books";
                        $books = mysqli_query($conn, $q1);

                        $q2 = "SELECT * FROM members";
                        $members = mysqli_query($conn, $q2);

                        $q3 = "SELECT * FROM transactions";
                        $transactions = mysqli_query($conn, $q3);

                        if (mysqli_num_rows($transactions) > 0) {
                            $rowCount = mysqli_num_rows($transactions);
                            echo "<caption>" . "Total Laporan: " . $rowCount . " </caption>";
                        ?>
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Buku</th>
                                    <th scope="col">Nama Anggota</th>
                                    <th scope="col">Email Anggota</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Kembali</th>
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
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<caption>" . "Total Laporan: 0 </caption>";
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
</body>

</html>