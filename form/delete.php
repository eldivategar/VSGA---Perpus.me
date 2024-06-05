<?php

define ('DATABASE', '../database/perpus.me.json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bookCode'])) {
        booksHandler();
    } elseif (isset($_POST['fname'])) {
        membersHandler();
    } elseif (isset($_POST['transaction_id'])) {
        transactionsHandler($_POST['transaction_id']);
    }
}

function transactionsHandler($transactionId) { 
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
    }  catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    } 
}