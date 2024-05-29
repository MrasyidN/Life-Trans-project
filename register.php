<?php
    include "koneksi.php";

    if(isset($_POST['register'])){
        $verify = mysqli_query($koneksi, "select email from user where email = '$_POST[email]'");

        if(mysqli_num_rows($verify) != 0){
            echo "<script>alert('This email is already taken. Please try another email');</script>";
            echo '<script>window.location.href = "Register.php";</script>';
        }else{
            $simpan = mysqli_query($koneksi, "insert into user (role, username, password, email) values ('pengguna', '$_POST[username]', '$_POST[password]', '$_POST[email]')");
            echo "<script>alert('Berhasil Mendaftar');</script>";
            echo '<script>window.location.href = "Login.php";</script>';
        }
        
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>register</h1>
    <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">password</label>
            <input type="password" id="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email">      
            
            <button type="submit" name="register">Konfirmasi</button>
        </form>
    </div>
</body>
</html>