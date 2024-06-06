<?php
include "../../koneksi/koneksi.php";
session_start();

if (!isset($_SESSION['id_user'])) {
    echo "<script>
        alert('Silahkan login terlebih dahulu');
        document.location='../login/login.php';
    </script>";
    exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id_user'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>
        alert('Data profil tidak ditemukan');
        document.location='../login/login.php';
    </script>";
    exit;
}

$res_email = $data['email'];
$res_username = $data['username'];
$res_nama_lengkap = $data['nama_lengkap'];
$res_tanggal_lahir = $data['tanggal_lahir'];
$res_no_hp = $data['no_hp'];
$res_alamat = $data['alamat'];
$res_foto = $data['foto'];
$res_role = $data['role']; // Assuming there is a 'role' field to identify if user is admin or not

if (isset($_POST['ubah'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    
    // Handling the photo upload
    if (!empty($_FILES['foto']['name'])) {
        $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));
        if (!empty($password)) {
            $update_query = "UPDATE user SET email = '$email', username = '$username', password = '$password', nama_lengkap = '$nama_lengkap', tanggal_lahir = '$tanggal_lahir', no_hp = '$no_hp', alamat = '$alamat', foto = '$foto' WHERE id_user = '$id_user'";
        } else {
            $update_query = "UPDATE user SET email = '$email', username = '$username', nama_lengkap = '$nama_lengkap', tanggal_lahir = '$tanggal_lahir', no_hp = '$no_hp', alamat = '$alamat', foto = '$foto' WHERE id_user = '$id_user'";
        }
    } else {
        if (!empty($password)) {
            $update_query = "UPDATE user SET email = '$email', username = '$username', password = '$password', nama_lengkap = '$nama_lengkap', tanggal_lahir = '$tanggal_lahir', no_hp = '$no_hp', alamat = '$alamat' WHERE id_user = '$id_user'";
        } else {
            $update_query = "UPDATE user SET email = '$email', username = '$username', nama_lengkap = '$nama_lengkap', tanggal_lahir = '$tanggal_lahir', no_hp = '$no_hp', alamat = '$alamat' WHERE id_user = '$id_user'";
        }
    }

    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                keyboard: false
            });
            myModal.show();
            
            // Redirect based on user role after showing success modal
            setTimeout(function(){
                window.location.href = '" . ($res_role == 'admin' ? '../../components-admin/homeadmin/homeadmin.php' : '../home/home.php') . "';
            }, 2000); // Delay for 2 seconds before redirecting
        });
    </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('failureModal'), {
                    keyboard: false
                });
                myModal.show();
            });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | LifeTrans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .nav-edit {
            background-color: #00B4D8;
            padding: 5px 25px;
        }
        .btn-icon {
            width: 24px;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-link {
            font-size: 1.1rem;
            margin-right: 15px;
        }
        .nav-link i {
            margin-right: 5px;
        }
        .offcanvas-header {
            background-color: #00B4D8;
        }
        .offcanvas-title {
            font-size: 1.25rem;
        }
        .btn-close-white {
            filter: invert(1);
        }
        .offcanvas-body {
            background-color: #00B4D8;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid #00B4D8; /* Border color matching navbar */
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007BFF;
            border: none;
            border-radius: 10px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .modal-dialog-centered {
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-dark fixed-top nav-edit">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LifeTrans</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon btn-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">LifeTrans</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../home/Home.php"><i class="fa fa-user"></i> home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../setting/setting.php"><i class="fa fa-cog"></i> Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../ulasan/ulasan.php"><i class="fa fa-star"></i> Kritik dan Saran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <h1 class="text-center">Profile</h1>
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <!-- Kolom Menampilkan Profil -->
            <div class="text-center">
                <h3>Informasi Profil</h3>
                <?php if (!empty($res_foto)): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($res_foto); ?>" class="profile-image" alt="Profile Photo">
                <?php else: ?>
                    <img src="default-profile.png" class="profile-image" alt="Default Profile Photo">
                <?php endif; ?>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($res_email); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($res_username); ?></p>
                <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($res_nama_lengkap); ?></p>
                <p><strong>Tanggal Lahir:</strong> <?php echo htmlspecialchars($res_tanggal_lahir); ?></p>
                <p><strong>Nomor Handphone:</strong> <?php echo htmlspecialchars($res_no_hp); ?></p>
                <p><strong>Alamat:</strong> <?php echo htmlspecialchars($res_alamat); ?></p>
            </div>
        </div>
        <!-- Kolom Mengubah Profil -->
        <div class="col-md-6 form-container">
            <h3>Ubah Profil</h3>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($res_email); ?>" placeholder="Enter new email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($res_username); ?>" placeholder="Enter new username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter new password">
                </div>
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="<?php echo htmlspecialchars($res_nama_lengkap); ?>" placeholder="Enter new full name" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($res_tanggal_lahir); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor Handphone</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control" value="<?php echo htmlspecialchars($res_no_hp); ?>" placeholder="Enter new phone number" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea id="alamat" name="alamat" class="form-control" placeholder="Enter new address" required><?php echo htmlspecialchars($res_alamat); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Profil</label>
                    <input type="file" id="foto" name="foto" class="form-control">
                </div>
                <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Profil berhasil diubah.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="failureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="failureModalLabel">Failure</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Gagal mengubah profil.
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
