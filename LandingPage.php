<?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Life Trans</title>
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
      }
      .heading {
        font-weight: 800;
      }
      .lead {
        font-size: 16px;
        text-align: justify;
      }
      .full-height {
        height: 100vh;
      }
      .image img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        border-radius: 10px;
      }
      .btn-custom {
        width: 200px;
        font-size: 16px;
        background-color: #0077b6;
        color: white;
        border: none;
      }
      .btn-custom:hover {
        background-color: #023e8a;
      }
    </style>
</head>
<body>
  <div class="container-fluid full-height d-flex align-items-center">
    <div class="row w-100">
      <div class="col-md-6 d-flex flex-column justify-content-center align-items-start p-5">
        <h1 class="heading display-4">Life Trans</h1>
        <p class="lead">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Praesentium unde, provident quisquam eius itaque dicta optio vero reiciendis obcaecati omnis.</p>
        <button class="btn btn-custom btn-lg" type="button" onclick="login()">Login</button>
      </div>
      <div class="col-md-6 p-0 image">
        <img src="https://images.bisnis.com/posts/2020/11/01/1312122/tol100sah.jpg" alt="Life Trans Image">
      </div>
    </div>
  </div>

  <script>
    function login(){
      window.location.href = "Login.php";
    }
  </script>
  <!-- Bootstrap JS, Popper.js, and jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
