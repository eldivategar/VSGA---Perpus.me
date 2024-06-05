<?php

define ('DATABASE', '../database/perpus.me.json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['book_id'])) {
        booksHandler();
    } elseif (isset($_POST['member_id'])) {
        membersHandler();
    } elseif (isset($_POST['transaction_id'], $_POST['member'], $_POST['date'])) {
        transactionsHandler();
    }
}


function booksHandler()
{
    $file_upload_dir = '../assets/img/';
    $file_upload_name = basename($_FILES['image']['name']);
    $file_upload_path = $file_upload_dir . $file_upload_name;


    if (isset($_POST['bookCode'], $_POST['bookTitle'], $_POST['author'], $_POST['description'])) {
        $bookCode = $_POST['bookCode'];
        $bookTitle = $_POST['bookTitle'];
        $year = $_POST['year'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $image = $file_upload_name;

        $newData = [
            'book_id' => uniqid(),
            'bookCode' => 'book_'.$bookCode,
            'bookTitle' => $bookTitle,
            "year" => $year,
            'author' => $author,
            'description' => $description,
            'image' => $image
        ];

        try {
            $fileJson = file_get_contents(DATABASE);
            $data = json_decode($fileJson, true);

            if (!is_array($data)) {
                $data = [];
            }

            $data['books'][] = $newData;

            move_uploaded_file($_FILES['image']['tmp_name'], $file_upload_path);

            file_put_contents(DATABASE, json_encode($data, JSON_PRETTY_PRINT));
            header('Location: ../master_buku.php');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}




