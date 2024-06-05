<?php
require '../vendor/autoload.php';
include '../database/connection.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    // Query to retrieve combined data from transactions, books, and members tables
    $query = "
        SELECT 
            transactions.transaction_id, 
            books.book_title AS book, 
            members.first_name AS member_fname, 
            members.last_name AS member_lname, 
            transactions.issue_date, 
            transactions.return_date 
        FROM 
            transactions 
        INNER JOIN 
            books ON transactions.book_id = books.book_id 
        INNER JOIN 
            members ON transactions.member_id = members.member_id
        ORDER BY transactions.created_at DESC
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($conn));
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set Column Header
    $sheet->setCellValue('A1', 'ID Transaksi');
    $sheet->setCellValue('B1', 'Buku');
    $sheet->setCellValue('C1', 'Anggota');
    $sheet->setCellValue('D1', 'Tanggal Pinjam');
    $sheet->setCellValue('E1', 'Tanggal Kembali');

    $row = 2; // Start row data
    while ($data = mysqli_fetch_assoc($result)) {
        $sheet->setCellValue('A' . $row, $data['transaction_id']);
        $sheet->setCellValue('B' . $row, $data['book']);
        $sheet->setCellValue('C' . $row, $data['member_fname'].' '.$data['member_lname']);
        $sheet->setCellValue('D' . $row, $data['issue_date']);
        $sheet->setCellValue('E' . $row, $data['return_date']);
        $row++;
    }

    // New Object Writer
    $writer = new Xlsx($spreadsheet);
    $tanggal = date('Y_m_d');
    $fileName = 'laporan_' . $tanggal . '.xlsx';
    $writer->save($fileName);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$fileName.'"');
    header('Cache-Control: max-age=0');

    // Reads the file and sends it to the output buffer
    $file = readfile($fileName);
    if ($file === false) {
        die('Gagal membaca file.');
    }

    // Delete files after downloading
    unlink($fileName);
} catch (Exception $e) {
    die('Koneksi gagal: ' . $e->getMessage());
}
