<?php
include "koneksi.php";
session_start();

if(isset($_POST['submit_ulasan'])){
    $ulasan = mysqli_real_escape_string($koneksi, $_POST['ulasan']);
    $simpan = mysqli_query($koneksi, "INSERT INTO review_rating (ulasan) VALUES ('$ulasan')");
    if($simpan){
        echo "<script>alert('Berhasil memberi saran');</script>";
        echo '<script>window.location.href = "home.php";</script>';
    } else {
        echo "<script>alert('Gagal memberi saran');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Menyertakan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="reset.css">
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
                            <a class="nav-link" href="Home.php"><i class="fa fa-star"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="setting.php"><i class="fa fa-cog"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="container mt-5">
    <h2>Saran dan Kritik</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="ulasan" class="form-label">Kasih kami beberapa saran untuk mengembangkan untuk mengembangkan web ini</label>
            <textarea id="ulasan" name="ulasan" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" name="submit_ulasan" class="btn btn-primary">Konfirmasi</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
