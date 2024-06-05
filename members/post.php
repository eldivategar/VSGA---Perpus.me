<?php

define('DATABASE', '../database/perpus.me.json');
define('UPLOAD_DIR', '../assets/img/');

function membersHandlerJSON()
{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    $newData = [
        'member_id' => uniqid('m', true),
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
        header('Location: ../members/');
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function membersHandlerMysql() {
    include '../database/connection.php';

    $member_id = uniqid('m', true);
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    try {
        $query = "INSERT INTO members (member_id, email, first_name, last_name, phone, address, gender) VALUES ('$member_id', '$email', '$fname', '$lname', '$phone', '$address', '$gender')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: ../members/');
        } else {
            echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
        }
    } catch (Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

// membersHandlerJSON();
membersHandlerMysql();