<?php
    session_start();
    include("koneksi.php");

    if(isset($_POST['login'])){

        $username = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password = mysqli_real_escape_string($koneksi, $_POST['password']);

        $result = mysqli_query($koneksi, "SELECT * from user WHERE username = '$username' AND password = '$password'");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $result_user = mysqli_query($koneksi, "SELECT id_user FROM user WHERE username = '$username' AND password = '$password'");
            $data_user = mysqli_fetch_assoc($result_user);
            $id_user = $data_user['id'];

            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['id'] = $row['id'];

            if($row['role'] == 'pengguna'){
                echo '<script>window.location.href = "Home.php";</script>';
            }else if($row['role'] == 'admin'){
                echo '<script>window.location.href = "HomeAdmin.php";</script>';
            }
        }else{
            echo '<script>window.location.href = "Login.php";</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="kotak login">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Username atau Email</label>
            <input type="text" id="username" name="username" required>
            
            <div class="password-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <img class="password-icon">
            </div>
            
            <button type="submit" name="login">Konfirmasi</button>
        </form>
        <h7>Sudah mempunyai akun? <a href="Register.php">register sini</a></h7>

    </div>
    
</body>
</html>
