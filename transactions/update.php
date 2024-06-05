<?php


function editTransactionsHandler()
{
    include '../database/connection.php';

    $transaction_id = $_POST['transaction_id'];
    $book_id = $_POST['book'];
    $member_id = $_POST['member'];
    $issue_date = $_POST['issue_date'];
    $return_date = $_POST['return_date'];

    try {
        $query = "UPDATE transactions SET book_id = '$book_id', member_id = '$member_id', issue_date = '$issue_date', return_date = '$return_date' WHERE transaction_id = '$transaction_id'";
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

editTransactionsHandler();
