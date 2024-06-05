<?php

define('DATABASE', '../database/perpus.me.json');

function transactionsHandlerJSON()
{
    $book = $_POST['book'];
    $member = $_POST['member'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    $transaction_id = uniqid('t', true);

    $newData = [
        'transaction_id' => $transaction_id,
        'book' => $book,
        'member' => $member,
        'issue_date' => $issue_date,
        'return_date' => $return_date
    ];

    try {
        $fileJson = file_get_contents(DATABASE);
        $data = json_decode($fileJson, true);

        if (!is_array($data)) {
            $data = [];
        }

        $data['transactions'][] = $newData;

        file_put_contents(DATABASE, json_encode($data, JSON_PRETTY_PRINT));
        header('Location: ../transactions/');
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function transactionsHandlerMysql() {
    include '../database/connection.php';
    
    $transaction_id = uniqid('t', true);
    $book_id = $_POST['book'];
    $member_id = $_POST['member'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    try {
        $query = "INSERT INTO transactions (transaction_id, book_id, member_id, issue_date, return_date) VALUES ('$transaction_id', '$book_id', '$member_id', '$issue_date', '$return_date')";
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            header('Location: ../transactions/');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

// transactionsHandlerJSON();
transactionsHandlerMysql();