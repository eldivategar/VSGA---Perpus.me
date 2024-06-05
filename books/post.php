<?php

define('DATABASE', '../database/perpus.me.json');

function booksHandlerJSON()
{
    $file_upload_dir = '../assets/img/';
    $file_upload_name = basename($_FILES['image']['name']);
    $file_upload_path = $file_upload_dir . $file_upload_name;


    $bookCode = $_POST['bookCode'];
    $bookTitle = $_POST['bookTitle'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $image = $file_upload_name;

    $newData = [
        'book_id' => uniqid('b', true),
        'bookCode' => $bookCode,
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
        header('Location: ../books/');
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function bookHandlesMysql() {
    include '../database/connection.php';

    $book_id = uniqid('b', true);
    $bookCode = $_POST['bookCode'];
    $bookTitle = $_POST['bookTitle'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $image = time() . '_' . $_FILES['image']['name'];

    try {
        $q1 = "INSERT INTO books (book_id, book_code, book_title, year, author, description, image) VALUES ('$book_id', '$bookCode', '$bookTitle', '$year', '$author', '$description', '$image')";
        $result = mysqli_query($conn, $q1);
    
        if ($result) {
            move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $image);
            header('Location: ../books/');
        } else {
            echo 'Data gagal disimpan';
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

// booksHandlerJSON();
bookHandlesMysql();