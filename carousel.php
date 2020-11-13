<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>El Original Online</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

  <body>

    <div class="container">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="assets/carousel/promo1.png" alt="First slide" width="350">
      <div class="carousel-caption d-none d-md-block">
         <h5>...</h5>
         <p>aaaaa</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/carousel/promo2.png" alt="Second slide"  width="350">
      <div class="carousel-caption d-none d-md-block">
         <h5>...</h5>
         <p>aaaaa</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="assets/carousel/promo3.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
         <h5>...</h5>
         <p>aaaaa</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
</div>


<?php
  include_once('scriptJs.php')
 ?>

 <script type="text/javascript">
 $('.carousel').carousel({
interval: 2000
})
 </script>
  </body>
</html>
