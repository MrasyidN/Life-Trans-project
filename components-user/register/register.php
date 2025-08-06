<?php
include "../../koneksi/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Sanitasi dan ambil input
    $username       = htmlspecialchars(trim($_POST['username']));
    $email          = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password       = $_POST['password']; // tidak disanitasi karena akan di-hash
    $nama_lengkap   = htmlspecialchars(trim($_POST['nama_lengkap']));
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $no_hp          = htmlspecialchars(trim($_POST['no_hp']));
    $alamat         = htmlspecialchars(trim($_POST['alamat']));

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid.'); window.location.href = '../register/Register.php';</script>";
        exit;
    }

    // Validasi password
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[\W]/', $password)) {
        echo "<script>alert('Password harus minimal 8 karakter dan mengandung huruf besar, huruf kecil, angka, dan simbol.'); window.location.href = '../register/Register.php';</script>";
        exit;
    }

    // Validasi nomor HP
    if (!preg_match('/^[0-9]{10,15}$/', $no_hp)) {
        echo "<script>alert('Nomor HP harus berupa angka 10–15 digit.'); window.location.href = '../register/Register.php';</script>";
        exit;
    }

    // Validasi tanggal lahir
    $date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
    $now = new DateTime();
    if (!$date || $date->format('Y-m-d') !== $tanggal_lahir || $date > $now) {
        echo "<script>alert('Tanggal lahir tidak valid atau berada di masa depan.'); window.location.href = '../register/Register.php';</script>";
        exit;
    }

    // Cek apakah email sudah digunakan
    $stmt = $koneksi->prepare("SELECT email FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('Email sudah digunakan. Silakan gunakan email lain.'); window.location.href = '../register/Register.php';</script>";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Simpan ke database
        $stmt = $koneksi->prepare("INSERT INTO user (role, username, password, email, nama_lengkap, tanggal_lahir, no_hp, alamat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $role = 'pengguna';
        $stmt->bind_param("ssssssss", $role, $username, $hashed_password, $email, $nama_lengkap, $tanggal_lahir, $no_hp, $alamat);

        if ($stmt->execute()) {
            echo "<script>alert('Registrasi berhasil!'); window.location.href = '../login/Login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.'); window.location.href = '../register/Register.php';</script>";
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
      .register-container {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 2rem;
        border-radius: 8px;
        width: 100%;
        max-width: 400px;
      }
      .register-container h2 {
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
      #alamat {
        height: 100px; /* Perbesar tinggi box input alamat */
      }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            
            <div class="mb-3 password-container">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <i class="eye fa fa-eye password-icon" onclick="togglePassword()"></i>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor Handphone</label>
                <input type="text" id="no_hp" name="no_hp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" required></textarea>
            </div>

            <button type="submit" name="register" class="btn btn-custom">Konfirmasi</button>
        </form>
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
