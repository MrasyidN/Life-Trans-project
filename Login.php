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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
      body {
        font-family: 'Montserrat', sans-serif;
        color: #fff;
        background-color: #00b4d8;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .login-container {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 2rem;
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
      }
      .login-container h2 {
        margin-bottom: 1.5rem;
      }
      .password-container {
        position: relative;
      }
      .password-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
      }
      .btn-custom {
        background-color: #0077b6;
        color: white;
        border: none;
        width: 100%;
        margin-top: 1rem;
      }
      .btn-custom:hover {
        background-color: #023e8a;
      }
      .eye {
        color: #000;
        position: absolute;
        top: 50px;
      }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username atau Email</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="mb-3 password-container">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <i class="eye fa fa-eye password-icon" onclick="togglePassword()"></i>
            </div>
            
            <button type="submit" name="login" class="btn btn-custom">Konfirmasi</button>
        </form>
        <p class="mt-3">Sudah mempunyai akun? <a href="Register.php" class="text-decoration-none">Register sini</a></p>
    </div>
    
    <script>
      function togglePassword() {
        const passwordInput = document.getElementById('password');
        const passwordIcon = document.querySelector('.password-icon');
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          passwordIcon.classList.remove('fa-eye');
          passwordIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          passwordIcon.classList.remove('fa-eye-slash');
          passwordIcon.classList.add('fa-eye');
        }
      }
    </script>
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
