<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            padding: 20px;
            background-color: #00B4D8;
            font-family: 'Montserrat';
        }
        .btn-back {
            color: #fff;
            font-size: 24px;
        }
        .head-help {
            margin-top: 30px;
            font-size: 48px;
            color: #fff;
            font-weight: bold;
        }
        .accordion-button::after {
            content: '';
            background-image: none;
        }
        .accordion-button.collapsed::after {
            content: '';
            background-image: none;
        }
    </style>
</head>
<body>
    <a href="setting.php" class="btn-back"><i class="fa fa-chevron-left"></i></a>
    <div class="container">
        <h1 class="head-help text-center mb-4">Help Center</h1>

        <div class="accordion" id="accordionHelp">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHelpOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelpOne" aria-expanded="true" aria-controls="collapseHelpOne">
                        How to register?
                    </button>
                </h2>
                <div id="collapseHelpOne" class="accordion-collapse collapse show" aria-labelledby="headingHelpOne" data-bs-parent="#accordionHelp">
                    <div class="accordion-body">
                        To register, please follow these steps:
                        <ol>
                            <li>Go to the registration page.</li>
                            <li>Fill in the required information.</li>
                            <li>Submit the form.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHelpTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelpTwo" aria-expanded="false" aria-controls="collapseHelpTwo">
                        How to reset password?
                    </button>
                </h2>
                <div id="collapseHelpTwo" class="accordion-collapse collapse" aria-labelledby="headingHelpTwo" data-bs-parent="#accordionHelp">
                    <div class="accordion-body">
                        To reset your password, please follow these steps:
                        <ol>
                            <li>Go to the login page.</li>
                            <li>Click on the "Forgot Password?" link.</li>
                            <li>Enter your email address.</li>
                            <li>Follow the instructions sent to your email.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
