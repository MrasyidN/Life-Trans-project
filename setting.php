<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="reset.css">
    <style>
        body {
            padding: 20px;
            background-color: #00B4D8;
        }
        .btn-back {
            color: #fff;
            font-size: 24px;
        }
        .head-setting {
            margin-top: 30px;
            font-size: 48px;
            color: #fff;
            font-weight: bold;
        }
        .btn {
            width: 320px;
            height: 50px;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            color: #00B4D8;
            font-weight: bold;
            border: none;
        }
    </style>
</head>
<body>
    <a href="home.php" class="btn-back"><i class="fa fa-chevron-left"></i></a>
    <div class="container">
        <h1 class="head-setting text-center mb-4">Settings</h1>
        <div class="d-flex flex-column align-items-center">
            <div class="mb-3">
                <a href="bantuan.php" class="btn btn-primary">Help Center</a>
            </div>
            <div class="mb-3">
                <a href="FaQ.php" class="btn btn-primary">Frequently Asked Questions (FAQ)</a>
            </div>
            <div class="mb-3">
                <a href="kebijakan.php" class="btn btn-primary">Privacy Policy</a>
            </div>
            <div class="mb-3">
                <a href="ketentuan.php" class="btn btn-primary">Terms of Service</a>
            </div>
            <div class="mb-3">
                <a href="logout.php" class="btn btn-danger">logout</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
