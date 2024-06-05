<?php

define('DATABASE', '../database/perpus.me.json');

function editMembersHandlerJSON()
{
    try {
        $jsonData = file_get_contents(DATABASE);
        $data = json_decode($jsonData, true);


        $member_id = $_POST['member_id'];
        $email = $_POST['email'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $newData = [
            'member_id' => $member_id,
            'email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender
        ];

        $memberIndex = null;
        foreach ($data['members'] as $index => $member) {
            if ($member['member_id'] == $member_id) {
                $memberIndex = $index;
                break;
            }
        }

        if ($memberIndex !== null) {
            $data['members'][$memberIndex] = $newData;

            $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents(DATABASE, $updatedJsonData);
            header('Location: ../members/');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function editMembersHandlerMysql()
{
    include '../database/connection.php';

    $member_id = $_POST['member_id'];
    $email = $_POST['email'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    try {
        $query = "UPDATE members SET email = '$email', first_name = '$first_name', last_name = '$last_name', address = '$address', phone = '$phone', gender = '$gender' WHERE member_id = '$member_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: ../members/');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

// editMembersHandlerJSON();
editMembersHandlerMysql();   
