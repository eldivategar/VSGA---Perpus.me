<?php 

define('DATABASE', '../database/perpus.me.json');

function editBooksHandlerJSON()
{
    try {
        $jsonData = file_get_contents(DATABASE);
        $data = json_decode($jsonData, true);

        $book_id = $_POST['book_id'];
        $bookCode = $_POST['bookCode'];
        $year = $_POST['year'];
        $bookTitle = $_POST['bookTitle'];
        $author = $_POST['author'];
        $description = $_POST['description'];

        $coverImage = $_FILES['image']['name'];
        $coverTmpName = $_FILES['image']['tmp_name'];

        $newData = [
            'book_id' => $book_id,
            'bookCode' => $bookCode,
            'bookTitle' => $bookTitle,
            'author' => $author,
            'year' => $year,
            'description' => $description
        ];

        $bookIndex = null;
        foreach ($data['books'] as $index => $book) {
            if ($book['book_id'] == $book_id) {
                $bookIndex = $index;
                break;
            }
        }

        if ($coverImage) {
            $coverImageName = time() . '_' . $coverImage;
            move_uploaded_file($coverTmpName, UPLOAD_DIR . $coverImageName);
            $newData['image'] = $coverImageName;
        }

        if ($bookIndex !== null) {
            if (!$coverImage) {
                $newData['image'] = $data['books'][$bookIndex]['image']; // keep old image if new one is not uploaded
            }

            $data['books'][$bookIndex] = $newData;

            $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents(DATABASE, $updatedJsonData);
            header('Location: ../books/');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function editBooksHandlerMysql() {
    include '../database/connection.php';

    $book_id = $_POST['book_id'];
    $bookCode = $_POST['bookCode'];
    $bookTitle = $_POST['bookTitle'];
    $year = $_POST['year'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $coverImage = time() . '_' . $image;
        $query = "UPDATE books SET book_code = '$bookCode', book_title = '$bookTitle', year = '$year', author = '$author', description = '$description', image = '$coverImage' WHERE book_id = '$book_id'";
        move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $coverImage);
    } else {
        $query = "UPDATE books SET book_code = '$bookCode', book_title = '$bookTitle', year = '$year', author = '$author', description = '$description' WHERE book_id = '$book_id'";    
    }
    
    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: ../books/');
    }
}

// editBooksHandlerJSON();
editBooksHandlerMysql();