<?php
include "../../koneksi/koneksi.php";

if (isset($_POST['ulasan'])) {
    // Ambil data ulasan dari formulir
    $ulasan = $_POST['ulasan'];

    // Simpan ulasan ke tabel review_rating
    $simpan = mysqli_query($koneksi, "INSERT INTO review_rating (ulasan) VALUES ('$_POST[ulasan]')");

    if ($simpan) {
        // Jika penyimpanan berhasil, arahkan ke home.php
        echo "<script>alert('Ulasan berhasil disimpan');</script>";
        echo '<script>window.location.href = "../home/Home.php";</script>';
    } else {
        // Jika penyimpanan gagal, tampilkan pesan kesalahan
        echo "<script>alert('Gagal menyimpan ulasan');</script>";
    }
}



/*
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



*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review and Rating</title>
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
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
      }
      .review-container {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 2rem;
        border-radius: 8px;
        width: 100%;
        max-width: 600px;
      }
      .review-container h2 {
        margin-bottom: 1.5rem;
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
      .rating {
        display: flex;
        justify-content: space-around;
        margin-bottom: 1rem;
      }
      .rating input {
        display: none;
      }
      .rating label {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
      }
      .rating input:checked ~ label,
      .rating input:hover ~ label,
      .rating input:hover ~ label ~ label {
        color: #ffdd00;
      }
    </style>
</head>
<body>
    <div class="review-container">
        <h2>Leave a Review</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="review" class="form-label">Your Review</label>
                <input type="ulasan" id="ulasan" name="ulasan" rows="5" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rating</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5" class="fa fa-star"></label>
                    <input type="radio" id="star4" name="rating" value="4" required>
                    <label for="star4" class="fa fa-star"></label>
                    <input type="radio" id="star3" name="rating" value="3" required>
                    <label for="star3" class="fa fa-star"></label>
                    <input type="radio" id="star2" name="rating" value="2" required>
                    <label for="star2" class="fa fa-star"></label>
                    <input type="radio" id="star1" name="rating" value="1" required>
                    <label for="star1" class="fa fa-star"></label>
                </div>
            </div>

            <button type="submit" name="ulasan" class="btn btn-custom">Submit Review</button>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
