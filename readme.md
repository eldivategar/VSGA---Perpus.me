<img src="assets/img/perpus.me.png" width="200" alt="perpus.me" style="margin: 0; padding: 0;">

# VSGA - Perpus.me

Aplikasi sederhana untuk manajemen buku, anggota, transaksi dan laporan di Perpustakaan.


## Membuat Database

1. Masuk ke dalam mysql dengan username dan password
2. Buat database dengan nama **vsga_perpusme**
3. Buat 3 table berikut ↓
> [Optional] Jalankan perintah dibawah menggunakan command prompt agar lebih mudah.
- Perintah untuk login menggunakan command prompt.
    ```sh
        mysql -u username -p database_name < database.sql
    ```
- Perintah membuat table.
    ```sql
        CREATE TABLE members (
        member_id VARCHAR(255) PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        phone VARCHAR(255) NOT NULL,
        address TEXT NOT NULL,
        gender VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE books (
        book_id VARCHAR(255) PRIMARY KEY,
        book_code VARCHAR(255) UNIQUE NOT NULL,
        book_title VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL,
        year INT  NOT NULL,
        description TEXT  NOT NULL,
        image VARCHAR(255)  NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE transactions (
        transaction_id VARCHAR(255) PRIMARY KEY,
        book_id VARCHAR(255),
        member_id VARCHAR(255),
        issue_date DATETIME NOT NULL,
        return_date DATETIME  NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

        FOREIGN KEY (book_id) REFERENCES books(book_id),
        FOREIGN KEY (member_id) REFERENCES members(member_id)
        );
    ```