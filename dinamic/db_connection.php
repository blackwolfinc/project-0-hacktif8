<?php
    // $db_host = "localhost" //host database
    $db_host = "localhost"; // host database
    $db_username = "root";
    $db_password = "";
    $db_name = "chalange-satu";

    // buat koneksi ke server mysql
    $koneksi = new mysqli($db_host, $db_username, $db_password, $db_name);

    if ($koneksi->connect_error){
        die("Koneksi ke database gagal");
    }
?>
