<!-- perpus.me -->
<div class="row">
    <?php
    $fileJson = file_get_contents('database/perpus.me.json');
    $data = json_decode($fileJson, true);
    $books = $data['books'];

    if (is_array($books)) {
        foreach ($books as $book => $value) {
    ?>
            <div class="col-sm-6 col-md-4 p-2">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="assets/img/<?= $value['image'] ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value['bookTitle'] ?></h5>
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
    ?>
</div>

<!-- books/index -->
<table class="table table-hover">
    <?php
    $fileJson = file_get_contents('../database/perpus.me.json');
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
                    <td><img src="../assets/img/<?= $value['image'] ?>" class="img-fluid" width="100" alt="cover"></td>
                    <td>
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-outline-info edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal" data-book='<?= json_encode($value) ?>'>Edit</button>
                        </div>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- members/index -->
<table class="table table-hover">
    <?php
    $fileJson = file_get_contents('../database/perpus.me.json');
    $data = json_decode($fileJson, true);
    $members = $data['members'];

    if (is_array($members)) {
        echo "<caption>" . "Total Anggota: " . count($members) . " </caption>";
    }
    ?>
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Alamat</th>
            <th scope="col">Email</th>
            <th scope="col">Telp</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($members)) {
            foreach ($members as $member => $value) {
        ?>
                <tr>
                    <td scope="row"><?= $member + 1 ?></td>
                    <td><?= $value['first_name'] . " " . $value['last_name'] ?></td>
                    <td><?= $value['address'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['phone'] ?></td>
                    <td><?= $value['gender'] ?></td>
                    <td>
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-outline-info edit-btn" type="button" data-bs-toggle="modal" data-bs-target="#myModal" data-member='<?= json_encode($value) ?>'>Edit</button>
                            <!-- <button class="btn btn-outline-danger" type="button">Hapus</button> -->
                        </div>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

<!-- transactions/index -->
<div class="row g-3">
    <input type="hidden" name="transaction_id" id="transaction_id">
    <div class="col-md-12">
        <label for="book" class="form-label">Buku</label>
        <select class="form-select" aria-label="Default select example" name="book" required>
            <option value="" disabled selected>Pilih Buku</option>
            <?php
            $fileJson = file_get_contents('../database/perpus.me.json');
            $data = json_decode($fileJson, true);
            $books = $data['books'];

            if (is_array($books)) {
                foreach ($books as $index => $value) {

            ?>
                    <option value=<?= $value['book_id'] ?>> <?= $value['year'] . " - " . $value['bookTitle'] ?> </option>
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
                    <option value=<?= $value['member_id'] ?>> <?= $value['first_name'] . " " . $value['last_name'] . " [ " . $value['address'] . " ]" ?> </option>
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