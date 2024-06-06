<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "lifetrans_db";
    
    $koneksi = mysqli_connect($server, $user, $password, $database) or die (mysqli_error($koneksi));
?>