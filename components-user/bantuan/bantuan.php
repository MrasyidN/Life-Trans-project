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
            font-family: 'Montserrat', sans-serif;
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
        .accordion-body {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>
<body>
    <a href="../setting/setting.php" class="btn-back"><i class="fa fa-chevron-left"></i></a>
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
                            <li>Check your email for the verification link and click on it to activate your account.</li>
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
                            <li>Follow the instructions sent to your email to reset your password.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHelpThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelpThree" aria-expanded="false" aria-controls="collapseHelpThree">
                        How to contact support?
                    </button>
                </h2>
                <div id="collapseHelpThree" class="accordion-collapse collapse" aria-labelledby="headingHelpThree" data-bs-parent="#accordionHelp">
                    <div class="accordion-body">
                        To contact support, you can use the following methods:
                        <ul>
                            <li>Email us at support@example.com</li>
                            <li>Call our support line at +123 456 7890</li>
                            <li>Use the live chat feature on our website</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHelpFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelpFour" aria-expanded="false" aria-controls="collapseHelpFour">
                        How to update profile information?
                    </button>
                </h2>
                <div id="collapseHelpFour" class="accordion-collapse collapse" aria-labelledby="headingHelpFour" data-bs-parent="#accordionHelp">
                    <div class="accordion-body">
                        To update your profile information, please follow these steps:
                        <ol>
                            <li>Log in to your account.</li>
                            <li>Go to the profile settings page.</li>
                            <li>Update your personal information.</li>
                            <li>Click on the "Save" button to apply the changes.</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHelpFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelpFive" aria-expanded="false" aria-controls="collapseHelpFive">
                        How to delete my account?
                    </button>
                </h2>
                <div id="collapseHelpFive" class="accordion-collapse collapse" aria-labelledby="headingHelpFive" data-bs-parent="#accordionHelp">
                    <div class="accordion-body">
                        To delete your account, please follow these steps:
                        <ol>
                            <li>Log in to your account.</li>
                            <li>Go to the account settings page.</li>
                            <li>Click on the "Delete Account" button.</li>
                            <li>Confirm the deletion by following the instructions.</li>
                        </ol>
                        <p class="text-danger">Note: This action is irreversible. All your data will be permanently deleted.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
