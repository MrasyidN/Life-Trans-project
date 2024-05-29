<?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>life trans </title>
</head>
<body>
<div class="LANDING-PAGE">
      <div class="div">
        <div class="text-wrapper">LIFE TRANS</div>
        <p class="lorem-ipsum-dolor">Lorem ipsum dolor sit amet consectetur<br />. 
        Feugiat duis ultrices lectus vel.</p>
        <div>
            <button class="lesgo" type="button" onclick="login()">hayu</button>
        </div>
        </div>
      </div>

      <script>
        function login(){
            window.location.href = "Login.php";
        }
      </script>
    
</body>
</html>


<style>
.LANDING-PAGE {
  background-color: #00b4d8;
  display: flex;
  flex-direction: row;
  justify-content: center;
  width: 100%;
}

.LANDING-PAGE .div {
  background-color: #00b4d8;
  width: 1440px;
  height: 1024px;
  position: relative;
}

.LANDING-PAGE .text-wrapper {
  position: absolute;
  top: 327px;
  left: 150px;
  font-family: "Montserrat-Bold", Helvetica;
  font-weight: 700;
  color: #ffffff;
  font-size: 64px;
  letter-spacing: 0;
  line-height: normal;
}

.LANDING-PAGE .lorem-ipsum-dolor {
  position: absolute;
  top: 480px;
  left: 150px;
  font-family: "Montserrat-Bold", Helvetica;
  font-weight: 700;
  color: #ffffff;
  font-size: 24px;
  letter-spacing: 0;
  line-height: normal;
}

.LANDING-PAGE .lesgo {
  position: absolute;
  width: 124px;
  height: 40px;
  top: 600px;
  left: 150px;
  background-color: #ade8f4;
  border-radius: 10px;
}

</style>
