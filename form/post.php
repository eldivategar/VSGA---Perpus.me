<?php

define ('DATABASE', '../database/perpus.me.json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bookCode'])) {
        booksHandler();
    } elseif (isset($_POST['fname'])) {
        membersHandler();
    } elseif (isset($_POST['book'], $_POST['member'], $_POST['date'])) {
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
            header('Location: ../master_buku.php');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}

function membersHandler()
{
    if (isset($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['gender'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];

        $newData = [
            'first_name' => $fname,
            'last_name' => $lname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender
        ];

        try {
            $fileJson = file_get_contents(DATABASE);
            $data = json_decode($fileJson, true);

            if (!is_array($data)) {
                $data = [];
            }

            $data['members'][] = $newData;

            file_put_contents(DATABASE, json_encode($data, JSON_PRETTY_PRINT));
            header('Location: ../master_anggota.php');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}

function transactionsHandler()
{
    $book = $_POST['book'];
    $member = $_POST['member'];
    $date = $_POST['date'];

    $transaction_id = uniqid();

    $newData = [
        'transaction_id' => $transaction_id,
        'book' => $book,
        'member' => $member,
        'date' => $date
    ];

    try {
        $fileJson = file_get_contents(DATABASE);
        $data = json_decode($fileJson, true);

        if (!is_array($data)) {
            $data = [];
        }

        $data['transactions'][] = $newData;

        file_put_contents(DATABASE, json_encode($data, JSON_PRETTY_PRINT));
        header('Location: ../transaksi.php');
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
