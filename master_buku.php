<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                Tambah Buku
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="myModalLabel">Tambah Buku Baru</h1>
                    </div>
                    <form action="form/post.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-9">
                                    <label for="bookCode" class="form-label">Kode Buku</label>
                                    <input type="number" class="form-control" id="bookCode" name="bookCode" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="year" class="form-label">Tahun Terbit</label>
                                    <input type="number" class="form-control" id="year" name="year" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="bookTitle" class="form-label">Judul Buku</label>
                                    <input type="text" class="form-control" id="bookTitle" name="bookTitle" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="author" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" minlength="30" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label for="image" class="form-label">Cover Buku</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
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
                <h5 class="text-white">Data Buku Perpus.me</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <?php
                        $fileJson = file_get_contents('database/perpus.me.json');
                        $data = json_decode($fileJson, true);
                        $books = $data['books'];

                        if (is_array($books)) {
                            echo "<caption>" . "Total Buku: " . count($books) . " </caption>";
                        }
                        ?>
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Buku</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Cover Buku</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($books)) {
                                foreach ($books as $book => $value) {
                            ?>
                                    <tr>
                                        <td scope="row"><?= $book + 1 ?></td>
                                        <td><?= $value['bookCode'] ?></td>
                                        <td><?= $value['bookTitle'] ?></td>
                                        <td><?= $value['year'] ?></td>
                                        <td><?= $value['author'] ?></td>
                                        <td><img src="assets/img/<?= $value['image'] ?>" class="img-fluid" width="100" alt="cover"></td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-block">
                                                <button class="btn btn-outline-info" type="button">Edit</button>
                                                <button class="btn btn-outline-danger" type="button">Hapus</button>
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

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
</body>

</html>