<!DOCTYPE html>
  <!--
    Part of this template was developed by https://blackrockdigital.github.io 
  -->
<html lang="en" class="gr__blackrockdigital_github_io"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Steal The Steel CTF</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://bootswatch.com/4/lumen/bootstrap.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

  </head>

  <body data-gr-c-s-loaded="true">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Break it until you make it</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="https://twitter.com/WiCySorg" target="_blank">Twitter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.instagram.com/wicys/" target="_blank">Instagram</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://www.facebook.com/wicys" target="_blank">Facebook</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="masthead text-center text-white" style="padding-top: 6.5em; padding-bottom: 2.5em; background: linear-gradient(0deg,#C2CEAF 0,#B1D34A 100%);">
      <div class="masthead-content">
        <div class="container">
          <h1 class="masthead-heading mb-0" style="color: #231F20;">Steal The Steel CTF</h1>
          <h2 class="masthead-subheading mb-0">Will Rock Your Socks Off</h2>
        </div>
      </div>
      <div class="bg-circle-1 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-2 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-3 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
      <div class="bg-circle-4 bg-circle" style="background: linear-gradient(0deg,#B1D34A 0,#C2CEAF 100%);"></div>
    </header>

    <section>
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-2">
            <div class="p-5">
              <img class="img-fluid rounded-circle" src="https://raw.githubusercontent.com/StartBootstrap/startbootstrap-one-page-wonder/master/img/01.jpg" alt="">
              <blockquote style="padding-top: 20px;">
                <p>To hack, or not to hack.</p>
                <footer>&mdash; <cite>That is the question</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-8 order-lg-1">
            <div class="p-5">
              <h2 class="display-4" style="color: #812990;">Data Server</h2>


              This is my storage of sensitive data<br/>
              Only way to retrieve it is to enter the correct password</br>
              <form method="get" class="form-inline">
                <div class="form-group mb-2">
                  <input class="form-control" type="text" name='password'></input>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                  <button class="btn btn-primary" type=submit>Retrieve</button>
                </div>
              </form>
              <?php
              if(isset($_GET['password'])){
                $pass=$_GET['password'];
                $pass=preg_replace("/\||&|;|`|\n/"," ",$pass);
                $output=shell_exec("./main $pass");
                echo $output;
                }
              ?>

              
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Steal The Steal CTF&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-dragon"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Because We Care</p>
        <p class="m-0 text-center text-white">Developed by<br>Amela Gjishti | Daniel Tyler | Konstantin Menako | Vitaly Ford</p>
      </div>
      <!-- /.container -->
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body><span class="gr__tooltip"><span class="gr__tooltip-content"></span><i class="gr__tooltip-logo"></i><span class="gr__triangle"></span></span></html>