<?php

$upload_directory = dirname(__FILE__).'/uploaded_files/';
if (isset($_POST['upload'])) {
    if (!empty($_FILES['my_file'])) {
        if ($_FILES['my_file']['error'] > 0) {
            echo "Error: " . $_FILES["my_file"]["error"] ;
        } else {
            move_uploaded_file($_FILES['my_file']['tmp_name'],
                $upload_directory . $_FILES['my_file']['name']);
            echo 'Uploaded File.';
        }
    } else {
        die('File not uploaded.');
    }
}

$encoded_file = $_POST['file'];
$decoded_file = base64_decode($encoded_file);

file_put_contents('subins', $decoded_file);