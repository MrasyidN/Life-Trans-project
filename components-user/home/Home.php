<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solusi Transportasi Publik | Life-Trans</title>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <style>
        .nav-edit {
            background-color: #00B4D8;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-link {
            font-size: 1.1rem;
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
        .directions li span.arrow {
            display: inline-block;
            min-width: 28px;
            min-height: 28px;
            background-position: 0px;
            background-image: url("../../assets/arrows.png");
            position: relative;
            top: 8px;
        }
        .directions li span.depart {
            background-position: -28px;
        }
        .directions li span.rightturn {
            background-position: -224px;
        }
        .directions li span.leftturn {
            background-position: -252px;
        }
        .directions li span.arrive {
            background-position: -1288px;
        }
        /* Custom Styles */
        .container-custom {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        #mapContainer {
            border-radius: 15px;
            overflow: hidden;
            border: 3px solid #00B4D8;
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
    </style>
</head>
<body>
<nav class="navbar navbar-dark fixed-top nav-edit">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">LifeTrans</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">LifeTrans</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../profile/profile.php"><i class="fa fa-user"></i> Profile</a>
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
    <div class="container-custom">
        <h1 class="text-center text-primary">Mau Kemana Anda Hari Ini?</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <div id="mapContainer" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card card-custom">
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="text" id="origin" name="origin" class="form-control" placeholder="Asal">
                        </div>
                        <div class="mb-3">
                        <input type="text" id="destination" name="destination" class="form-control" placeholder="Tujuan">
                        </div>
                        <div class="mb-3">
                            <label for="mode" class="form-label">Moda Transportasi:</label>
                            <select id="mode" name="mode" class="form-select">
                                <option value="car">Mobil</option>
                                <option value="bicycle">Sepeda</option>
                                <option value="pedestrian">Jalan Kaki</option>
                                <option value="publicTransport">Transportasi Umum</option>
                            </select>
                        </div>
                        <button class="btn btn-primary w-100 mb-3" onclick="calculateRoute()">Calculate Route</button>
                        <div class="text-center">
                            <div id="travelTime" class="d-block mb-2"></div>
                            <div id="distance" class="d-block"></div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-8">
                                <div id="panel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="map.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

