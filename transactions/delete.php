<?php

define('DATABASE', '../database/perpus.me.json');

function transactionsHandlerJSON($transactionId)
{
    try {
        $jsonData = file_get_contents(DATABASE);
        $data = json_decode($jsonData, true);

        $transactionIndex = null;
        foreach ($data['transactions'] as $index => $transaction) {
            if ($transaction['transaction_id'] == $transactionId) {
                $transactionIndex = $index;
                break;
            }
        }

        if ($transactionIndex !== null) {
            unset($data['transactions'][$transactionIndex]);
            $data['transactions'] = array_values($data['transactions']);

            $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents(DATABASE, $updatedJsonData);

            return true;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function transactionsHandlerMysql($transactionId) {
    include '../database/connection.php';

    try {
        $query = "DELETE FROM transactions WHERE transaction_id = '$transactionId'";
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

// transactionsHandlerJSON($_POST['transaction_id']);
transactionsHandlerMysql($_POST['transaction_id']);