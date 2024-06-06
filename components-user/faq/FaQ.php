<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
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
        .head-Faq {
            font-size: 48px;
            color: #fff;
            font-weight: bold;
        }
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .faq-question {
            cursor: pointer;
        }
        .faq-answer {
            display: none;
        }
    </style>
</head>
<body>
    <a href="../setting/setting.php" class="btn-back"><i class="fa fa-chevron-left"></i></a>  
    <div class="container faq-container">
        <h1 class="head-Faq text-center mb-4">FAQ</h1>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What is Life-Trans?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil culpa expedita dicta aperiam totam minus?
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How do I get started with Life-Trans?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                       Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde rem impedit quibusdam commodi maxime culpa recusandae numquam, tempore laudantium cumque?
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Can I use Life-Trans on multiple devices?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt vero expedita illum sapiente nulla perspiciatis repellat laborum eum error optio, voluptates quas minus tempore ipsam animi placeat rerum? Enim voluptatum, similique perspiciatis, corporis dolores nulla assumenda distinctio blanditiis placeat numquam natus dolorum perferendis minus odit.
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Is Life-Trans free to use?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                       Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel aut perferendis ducimus soluta, vitae corrupti odio iste temporibus illo optio quae repudiandae itaque earum incidunt eius obcaecati tempora blanditiis eum veritatis, quam illum ad! Numquam itaque temporibus quasi. Minima assumenda, quam reiciendis temporibus fugit voluptatum unde rerum nobis porro alias?
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Bootstrap JS, Popper.js, and jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </div>
</body>
</html>
