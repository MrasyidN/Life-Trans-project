<?php
    include "../../koneksi/koneksi.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Home</title>
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
        .offcanvas-header, .offcanvas-body {
            background-color: #00B4D8;
        }
        .offcanvas-title {
            font-size: 1.25rem;
        }
        .btn-close-white {
            filter: invert(1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark fixed-top nav-edit">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LifeTrans - Admin</a>
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
                            <a class="nav-link" aria-current="page" href="../../components-user/profile/profile.php"><i class="fa fa-user"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../components-user/setting/setting.php"><i class="fa fa-cog"></i> Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../components-user/logout/logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Akun yang Ada di Database</h3>
            </div>
            <div class="card-body">
                <h3>Data Akun</h3>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $tampil = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user ASC");
                    while($data = mysqli_fetch_array($tampil)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['role']?></td>
                            <td><?= $data['username']?></td>
                            <td><?= $data['password']?></td>
                            <td><?= $data['email']?></td>
                            <td>
                                <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $no ?>">Ubah</a>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                            </td>
                        </tr>

                        <!-- Modal Ubah -->
                        <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalUbahLabel<?= $no ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalUbahLabel<?= $no ?>">Form Akun</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="../akun/Akun.php">
                                        <input type="hidden" name="id_user" value="<?= $data['id_user']?>">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Role</label>
                                                <select class="form-select" name="trole">
                                                    <option value="<?=$data['role']?>"><?=$data['role']?></option>
                                                    <option value="admin">Admin</option>
                                                    <option value="pengguna">Pengguna</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" name="tusername" value="<?=$data['username']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="text" class="form-control" name="tpassword" value="<?=$data['password']?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" name="temail" value="<?=$data['email']?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="bubah">Ubah</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Ubah -->

                        <!-- Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalHapusLabel<?= $no ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalHapusLabel<?= $no ?>">Konfirmasi Hapus Akun</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="../akun/Akun.php">
                                        <input type="hidden" name="id_user" value="<?= $data['id_user']?>">
                                        <div class="modal-body">
                                            <h5 class="text-center">Apa anda yakin akan menghapus data ini?</h5>
                                            <span class="text-danger"><?= $data['username'] ?></span>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="bhapus">Hapus</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Hapus -->
                    <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Akun
                </button>

                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahLabel">Form Akun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="../akun/Akun.php">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-select" name="trole">
                                            <option value="admin">Admin</option>
                                            <option value="pengguna">Pengguna</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" name="tusername">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="text" class="form-control" name="tpassword">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="temail">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Modal Tambah -->
            </div>
        </div>
    </div>

    <!-- Kritik dan Saran -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Kritik dan Saran Pengguna</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Ulasan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $ulasan = mysqli_query($koneksi, "SELECT user.id_user, user.username, review_rating.ulasan FROM user RIGHT JOIN review_rating ON user.id_user = review_rating.id_review ");
                    while($data = mysqli_fetch_array($ulasan)) :
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['username']?></td>
                            <td><?= $data['ulasan']?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
